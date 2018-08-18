<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $id
 * @property mixed $country_id
 * @property mixed $province_id
 * @property mixed $city_id
 * @property City|null $city
 * @property Province|null $province
 * @property Country|null $country
 */
class Location extends Model
{
    protected $table = 'locations';

    public $timestamps = false;

    public $fillable = [
    	'country_id',
	    'province_id',
	    'city_id',
    ];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function country() {
	    return $this->belongsTo(Country::class, 'country_id', 'id');
    }

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function province() {
		return $this->belongsTo(Province::class, 'province_id', 'id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function city() {
		return $this->belongsTo(City::class, 'city_id', 'id');
	}
}
