<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Facades\Voyager;

/**
 * @property mixed          $relatives
 * @property \Carbon\Carbon $created_at
 * @property int            $id
 * @property \Carbon\Carbon $updated_at
 * @property object         $data
 */
class MenuItem extends \TCG\Voyager\Models\MenuItem
{
	public $casts = [
		'data' => 'object',
	];

	public function relatives() {
		return $this->belongsToMany(MenuItem::class, 'menu_items_relations', 'parent_id', 'child_id');
	}

	public static function getLink($item, $options) {
		$listItemClass = [];
		$styles = null;
		$linkAttributes = null;
		$transItem = $item;
		$break = false;

		if (Voyager::translatable($item)) {
			$transItem = $item->translate($options->locale);
		}

		$href = $item->link();

		// Current page
		if(url($href) == url()->current()) {
			array_push($listItemClass, 'active');
		}

		$permission = '';
		$hasChildren = false;

		// With Children Attributes
		if(!$item->children->isEmpty())
		{
			foreach($item->children as $child)
			{
				$hasChildren = $hasChildren || Auth::user()->can('browse', $child);

				if(url($child->link()) == url()->current())
				{
					array_push($listItemClass, 'active');
				}
			}
			if (!$hasChildren) {
				$break = true;
			}

			if (!$break) {
				$linkAttributes = 'href="#' . $transItem->id .'-dropdown-element" data-toggle="collapse" aria-expanded="'. (in_array('active', $listItemClass) ? 'true' : 'false').'"';
				array_push($listItemClass, 'dropdown');
			}
		}
		else
		{
			$linkAttributes =  'href="' . url($href) .'"';

			if(!Auth::user()->can('browse', $item)) {
				$break = true;
			}
		}

		return [
			$listItemClass,
			$styles,
			$linkAttributes,
			$transItem,
			$hasChildren,
			$break,
		];
	}
}
