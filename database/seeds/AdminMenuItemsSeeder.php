<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Menu;
use TCG\Voyager\Models\MenuItem;

class AdminMenuItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $menu = Menu::where('name', 'admin')->firstOrFail();
	    ////////////////////   //////////////////// //////////////////// Dashboard
	    $this->reorder([
		    'menu_id' => $menu->id,
		    'title'   => __('voyager::seeders.menu_items.dashboard'),
		    'url'     => '',
		    'route'   => 'voyager.dashboard',
	    ], 10);
	    ////////////////////   //////////////////// //////////////////// Contents
	    $contentMenuItem = $this->save([
		    'menu_id' => $menu->id,
		    'title'   => __('seeders.menu_items.contents'),
		    'url'     => '',
	    ], [
		    'target'     => '_self',
		    'icon_class' => 'voyager-pizza',
		    'color'      => null,
		    'parent_id'  => null,
		    'order'      => 30,
	    ]);
	    ////////////////////   //////////////////// //////////////////// Storage
	    $storageMenuItem = $this->save([
		    'menu_id' => $menu->id,
		    'title'   => __('seeders.menu_items.storage'),
		    'url'     => '',
	    ], [
		    'target'     => '_self',
		    'icon_class' => 'voyager-harddrive',
		    'color'      => null,
		    'parent_id'  => null,
		    'order'      => 40,
	    ]);
	    ////////////////////   //////////////////// //////////////////// Accounts
	    $accountsMenuItem = $this->save([
		    'menu_id' => $menu->id,
		    'title'   => __('seeders.menu_items.accounts'),
		    'url'     => '',
	    ], [
		    'target'     => '_self',
		    'icon_class' => 'voyager-people',
		    'color'      => null,
		    'parent_id'  => null,
		    'order'      => 20,
	    ]);
	    ////////////////////   //////////////////// //////////////////// Tools
	    $toolsMenuItem = $this->reorder([
		    'menu_id' => $menu->id,
		    'title'   => __('voyager::seeders.menu_items.tools'),
		    'url'     => '',
	    ], 50);
	    ////////////////////   //////////////////// //////////////////// Horizon
	    $this->save([
		    'menu_id' => $menu->id,
		    'title'   => __('seeders.menu_items.horizon'),
		    'url'     => '',
		    'route'   => 'laravel.horizon',
	    ], [
		    'target'     => '_self',
		    'icon_class' => 'voyager-ship',
		    'color'      => null,
		    'parent_id'  => $toolsMenuItem->id,
		    'order'      => 40,
	    ]);
	    ////////////////////   //////////////////// //////////////////// Settings
	    $this->reorder([
		    'menu_id' => $menu->id,
		    'title'   => __('voyager::seeders.menu_items.settings'),
		    'url'     => '',
		    'route'   => 'voyager.settings.index',
	    ], 60);
	    ////////////////////   //////////////////// //////////////////// Users
	    $this->reorder([
		    'menu_id' => $menu->id,
		    'title'   => __('voyager::seeders.menu_items.users'),
		    'url'     => '',
		    'route'   => 'voyager.users.index',
	    ], 20, $accountsMenuItem);
	    ////////////////////   //////////////////// //////////////////// Roles
	    $this->reorder([
		    'menu_id' => $menu->id,
		    'title'   => __('voyager::seeders.menu_items.roles'),
		    'url'     => '',
		    'route'   => 'voyager.roles.index',
	    ], 10, $accountsMenuItem);
	    ////////////////////   //////////////////// //////////////////// Media
	    $this->reorder([
		    'menu_id' => $menu->id,
		    'title'   => __('voyager::seeders.menu_items.media'),
		    'url'     => '',
		    'route'   => 'voyager.media.index',
	    ], 20, $storageMenuItem);
	    ////////////////////   //////////////////// //////////////////// Pages
	    $this->title($this->reorder([
		    'menu_id' => $menu->id,
		    'title'   => 'Pages',
		    'url'     => '',
		    'route'   => 'voyager.pages.index',
	    ], 10, $contentMenuItem), [
	    	'title' => __('seeders.menu_items.pages')
	    ]);
	    ////////////////////   //////////////////// //////////////////// Posts
	    $this->title($this->reorder([
		    'menu_id' => $menu->id,
		    'title' => 'Posts',
		    'url' => '',
		    'route' => 'voyager.blog_posts.index',
	    ], 20, $contentMenuItem), [
		    'title' => __('seeders.menu_items.posts')
	    ]);
	    ////////////////////   //////////////////// //////////////////// Categories
	    $this->title($this->reorder([
		    'menu_id' => $menu->id,
		    'title' => 'Categories',
		    'url' => '',
	    ], 30, $contentMenuItem), [
	    'title' => __('seeders.menu_items.post_categories')
        ]);
	    ////////////////////   //////////////////// //////////////////// Form Management
	    $this->title($this->reorder([
		    'menu_id' => $menu->id,
		    'title' => 'Form Management',
		    'url' => '',
		    'route' => 'voyager.forms.index',
	    ], 40, $contentMenuItem), [
		    'title' => __('seeders.menu_items.forms')
	    ]);
	    ////////////////////   //////////////////// //////////////////// Enquiries
	    $this->title($this->reorder([
		    'menu_id' => $menu->id,
		    'title' => 'Enquiries',
		    'url' => '',
		    'route' => 'voyager.enquiries.index',
	    ], 30, $accountsMenuItem), [
		    'title' => __('seeders.menu_items.enquiries')
	    ]);
	    ////////////////////   //////////////////// //////////////////// Menu Builder
	    $this->title($this->reorder([
		    'menu_id' => $menu->id,
		    'title'   => __('voyager::seeders.menu_items.menu_builder'),
		    'url'     => '',
		    'route'   => 'voyager.menus.index',
	    ], 40, $contentMenuItem), [
		    'title' => __('seeders.menu_items.menus')
	    ]);

	    $this->remove([
		    'menu_id' => $menu->id,
		    'title'   => 'Blog',
		    'url'     => '',
		    'route'   => null,
	    ]);
	    $this->remove([
		    'title' => 'Forms',
		    'menu_id' => $menu->id,
		    'url' => '',
		    'parent_id'   => null,
	    ]);
    }

	/**
	 * @param array     $data
	 *
	 * @return MenuItem
	 */
    protected function remove($data) {
	    $blog = MenuItem::firstOrNew($data);
	    if ($blog->exists) {
		    $blog->delete();
	    }
	    return $blog;
    }

	/**
	 * @param array     $data
	 * @param int       $order
	 * @param MenuItem  $parent
	 *
	 * @return MenuItem
	 */
    protected function reorder($data, $order, $parent = null) {
	    $menuItem = MenuItem::firstOrNew($data);
	    $new_data = [
	    	'order' => $order,
	    ];
	    if (!is_null($parent)) {
	    	$new_data['parent_id'] = $parent->id;
	    }
	    if ($menuItem->exists) {
		    $menuItem->update($new_data);
	    }
	    return $menuItem;
    }

    protected function save($data, $fill) {
	    $accountsMenuItem = MenuItem::firstOrNew($data);
	    if (!$accountsMenuItem->exists) {
		    $accountsMenuItem->fill($fill)->save();
	    } else {
		    $accountsMenuItem->update($fill);
	    }
	    return $accountsMenuItem;
    }

    protected function title($menuItem, $new) {
	    if ($menuItem->exists) {
		    $menuItem->update($new);
	    }
	    return $menuItem;
    }
}
