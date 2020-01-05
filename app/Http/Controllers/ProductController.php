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
      
      $keywords = $items->meta_keywords;
      $description = $items->meta_description;
      $title = $items->meta_title;
      $callback = Session::get('callback') ?: Session::get('callback');
      $buy = Session::get('buy') ?: Session::get('buy');
      $cart_count = 0;

      $items->image_path = explode(';', $items->image_path);

      $in_cart = false;

      $canonical = $this->canonical;

      if (is_array(Session::get('items'))) {
        foreach (Session::get('items') as $item) {
          $cart_count += $item['count'];
        }

        if (parent::inArray(Session::get('items'), $items->id)) {
          $in_cart = true;
        }
      }
      
      return view('product', compact('items', 'subcategory', 'subcategory_plug', 'keywords', 'description', 'title', 'cart_count', 'in_cart', 'callback', 'buy', 'canonical'));
    } else {
      abort('404');
    }

  }
}
