<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int   $id
 * @property int   $name
 * @property int   $title
 * @property Province $province
 */
class City extends Model
{
	protected $table = 'cities';
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
	public function province()
	{
		return $this->belongsTo(Province::class, 'province_id', 'id');
	}
}
