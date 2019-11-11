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

  public function index($category_plug, $item_plug, Request $request) {
    $categories = DB::table('categories')->where('available', '1')->get();
    $subcategories = DB::table('categories')->select('subcategory')->where('plug', $category_plug)->get();

    $itemsQuery = DB::table('items')->where('plug', $item_plug)->get();
    $items = '';

    foreach ($itemsQuery as $obj) {
      $items = $obj;
    }

    $menu = [];
    $subcategory = '';

    function inArray($array, $needle) {
      $result = 0;

      foreach ($array as $key => $value) {
        if (is_array($value) && in_array($needle, $value)) {
          $result = in_array($needle, $value);
        }
      }

      return $result;
    }

    foreach ($categories as $row) {
      $menu_item['category'] = '';
      $menu_item['subcategory'] = [];

      if (!inArray($menu, $row->category)) {
        $menu_item['category'] = $row->category;
        $menu_item['subcategory'][$row->plug] = $row->subcategory;

        array_push($menu, $menu_item);
      } else {
        foreach ($menu as $key => $value) {
          if ($value['category'] == $row->category) {
            $menu[$key]['subcategory'][$row->plug] = $row->subcategory;
          }
        }
      }
    }

    foreach ($subcategories as $subcategory_name) {
      $subcategory = $subcategory_name->subcategory;
    }

    $cart_count = 0;
    $in_cart = false;

    if (is_array(Session::get('items'))) {
      foreach (Session::get('items') as $item) {
        $cart_count += $item['count'];
      }

      if (inArray(Session::get('items'), $items->id)) {
        $in_cart = true;
      }
    }

    $keywords = 'православная, лавка, изделия, крестики, бухвицы, браслеты, ручная работа, освещенные';
    $description = 'Покупка недорогих освещенных православных ювелирных изделий ручной работы по низким ценам';
    $title = 'Интернет-магазин православных изделий "Вечерия"';

    if ($request->ajax()) {

    } else {
      if (count($itemsQuery)) {
        return view('product', compact('menu', 'items', 'category_plug', 'subcategory', 'keywords', 'description', 'title', 'cart_count', 'in_cart'));
      } else {
        abort('404');
      }
    }
  }

}
