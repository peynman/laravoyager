<?php

use Illuminate\Database\Seeder;
use Intuxicated\PersianChar\PersianChar;

class BranchesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
	public function run()
	{
		/** @var \App\Models\Country $iran */
		$iran = \App\Models\Country::firstOrNew([
			'name' => 'iran',
			'title' => \Intuxicated\PersianChar\PersianChar::letters('ایران'),
		]);
		if (!$iran->exists) {
			$iran->save();
		}

		/** @var \App\Models\Province[] $provinces */
		$provinces = [];
		self::csv_walk(resource_path('assets/csv/province.csv'), function ($row) use($iran, &$provinces) {
			$title = self::safeStr($row[2]);
			$name = str_replace(' ', '', $title);
			$province_id = self::safeInt($row[0]);

			$province = \App\Models\Province::firstOrNew([
				'name' => $name,
				'title' => $title,
			]);
			if (!$province->exists) {
				$iran->provinces()->save($province);
			}
			$provinces[$province_id] = $province;
		});

		self::csv_walk(resource_path('assets/csv/city.csv'), function ($row) use($iran, $provinces) {
			$title = self::safeStr($row[2]);
			$name = str_replace(' ', '', $title);
			/** @var \App\Models\Province $province */
			$province = $provinces[self::safeInt($row[1])];

			$city = \App\Models\City::firstOrNew([
				'province_id' => $province->id,
				'name' => $name,
				'title' => $title,
			]);
			if (!$city->exists) {
				$city->fill([
					'country_id' => $iran->id,
				]);
				$province->cities()->save($city);
			}
		});

		$last_province_title = null;
		self::csv_walk(resource_path('assets/csv/branches.csv'), function ($row) use (&$last_province_title) {
			$province_name = str_replace(' ', '', self::safeStr($row[0]));
			if (!empty($province_name)) {
				$last_province_title = $province_name;
				$province = \App\Models\Province::where('name', $province_name)->first();
			} else {
				$province_name = $last_province_title;
			}

			$city_name = str_replace(' ', '', self::safeStr($row[1]));
			$city = \App\Models\City::where('name', 'LIKE', '%'.$city_name.'%')->first();
			if (is_null($city)) {
				throw new Exception($city_name);
			}
		});
	}

	protected static function csv_walk($file, $pass) {
		$handle = fopen($file, 'r');
		if ($handle) {
			while ($content = fgetcsv($handle, 0, ',', '\'', "\n")) {
				$pass($content);
			}
			fclose($handle);
		}
	}
	protected static function safeStr($val) {
		return trim(PersianChar::letters($val), " \\\"\t");
	}
	protected static function safeInt($val) {
		return intval(PersianChar::ar_numbers(self::safeStr($val)));
	}

}
