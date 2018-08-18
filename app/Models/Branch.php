<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int            $id
 * @property string         $title
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property Location|null  $location
 * @property Phone[]        $phones
 */
class Branch extends Model
{
	protected $table = 'branches';

	public $timestamps = true;

	public $fillable = [
		'title',
		'location_id',
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function location() {
		return $this->belongsTo(Location::class, 'location_id', 'id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function phones() {
		return $this->belongsToMany(Phone::class, 'branch_phone_pivot', 'branch_id', 'phone_id');
	}
}
