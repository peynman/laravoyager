<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int    $id
 * @property string $name
 * @property string $title
 * @property City[]  $cities
 * @property Country  $country
 */
class Province extends Model
{
	protected $table = 'provinces';
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
	 * @return BelongsTo
	 */
	public function country()
	{
		return $this->belongsTo(Country::class, 'country_id', 'id');
	}

	/**
	 * @return HasMany
	 */
	public function cities()
	{
		return $this->hasMany(City::class, 'province_id', 'id');
	}

}
