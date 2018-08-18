<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Permission;

class AdminPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $keys = [
		    'browse_horizon',
	    ];

	    foreach ($keys as $key) {
		    Permission::firstOrCreate([
			    'key'        => $key,
			    'table_name' => null,
		    ]);
	    }
    }
}
