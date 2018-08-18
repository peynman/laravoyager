<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int    $id
 * @property string $name
 * @property string $title
 * @property Province[]  $provinces
 */
class Country extends Model
{
	protected $table = 'countries';
	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'title',
	];

	/**
	 * @return HasMany
	 */
	public function provinces()
	{
		return $this->hasMany(Province::class, 'country_id', 'id');
	}


	public static function tree($name) {
		$country = Country::with(['provinces', 'provinces.cities'])->where("name", $name)->first();
		if (is_null($country)) {
			return [];
		}
		return $country->provinces;
	}
}
