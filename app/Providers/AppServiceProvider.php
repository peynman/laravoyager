<?php

namespace App\Providers;

use App\FormFields\SelectProvinceHandler;
use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Laravel\Horizon\Horizon;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
	    Horizon::routeMailNotificationsTo(config('admin.email'));
	    Horizon::auth(function ($request) {
	    	/** @var User $user */
	    	$user = Auth::user();
	    	return !is_null($user) && ($user->hasRole('admin') || $user->hasPermission('brows_horizon'));
	    });
	    Voyager::useModel('MenuItem', MenuItem::class);
	    Voyager::useModel('Menu', Menu::class);

	    Voyager::addFormField(SelectProvinceHandler::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
