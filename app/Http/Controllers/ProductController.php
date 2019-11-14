<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Session;

class ProductController extends Controller {
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

  public function index($category_plug, $item_plug) {
    global $flag;
    $flag = false;

    foreach ($this->categoryQuery->toArray() as $category) {
      if ($category->subcategory_plug == $category_plug) {
        $flag = true;
      }
    }

    $items = DB::table('items')->join('categories', 'items.subcategory_id', '=', 'categories.id')
      ->select('items.*', 'categories.plug as subcategory_plug', 'category', 'subcategory')
      ->where('categories.plug', $category_plug)
      ->where('items.plug', $item_plug)
      ->get();

    if (!count($items)) {
      $flag = false;
    }

    if ($flag) {
      $items = $items[0];

      $subcategory_plug = $items->subcategory_plug;
      $subcategory = $items->subcategory;

      $menu = $this->menu;
      $keywords = 'православная, лавка, изделия, крестики, бухвицы, браслеты, ручная работа, освещенные';
      $description = 'Покупка недорогих освещенных православных ювелирных изделий ручной работы по низким ценам';
      $title = 'Интернет-магазин православных изделий "Вечерия"';
      $callback = Session::get('callback') ?: Session::get('callback');
      $cart_count = 0;

      $in_cart = false;

      if (is_array(Session::get('items'))) {
        foreach (Session::get('items') as $item) {
          $cart_count += $item['count'];
        }

        if (parent::inArray(Session::get('items'), $items->id)) {
          $in_cart = true;
        }
      }

      return view('product', compact('menu', 'items', 'subcategory', 'subcategory_plug', 'keywords', 'description', 'title', 'cart_count', 'in_cart', 'callback'));
    } else {
      abort('404');
    }

  }
}
