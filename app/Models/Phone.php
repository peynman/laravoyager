<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int            $id
 * @property string         $number
 * @property Country        $country
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Phone extends Model
{
    protected $table = 'phones';

    public $timestamps = true;

    public $fillable = [
    	'number',
	    'country_id',
    ];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function country() {
    	return $this->belongsTo(Country::class, 'country_id', 'id');
    }
}
