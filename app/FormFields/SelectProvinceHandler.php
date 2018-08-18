<?php
/**
 * Created by PhpStorm.
 * User: peyman
 * Date: 8/18/18
 * Time: 11:06 PM
 */

namespace App\FormFields;


use App\Models\Province;
use TCG\Voyager\FormFields\AbstractHandler;

class SelectProvinceHandler extends AbstractHandler
{
	protected $codename = 'select_province';

	public function createContent($row, $dataType, $dataTypeContent, $options)
	{
		return view('formfields.select', [
			'row' => $row,
			'options' => $options,
			'dataType' => $dataType,
			'dataTypeContent' => $dataTypeContent,
			'items' => Province::select(['id', 'title'])->where('country_id', 1)->get(),
		]);
	}
}