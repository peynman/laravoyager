<?php
/**
 * Created by PhpStorm.
 * User: peyman
 * Date: 8/18/18
 * Time: 10:57 PM
 */

namespace App\Listeners;


use Illuminate\Support\Facades\Log;

class RegisterBranchForm
{
	public static function onFormSubmitted($form) {
		Log::info("form submitted");
		Log::info(json_encode($form));
	}
}