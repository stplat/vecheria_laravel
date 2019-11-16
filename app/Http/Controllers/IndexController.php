<?php

namespace App\Http\Controllers;


use Session;
use DB;


//use App\Http\Controllers\Controller;


class IndexController extends Controller {
  
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    Session::forget('callback');
    $menu = $this->menu;
    $keywords = 'православная, лавка, изделия, крестики, бухвицы, браслеты, ручная работа, освещенные';
    $description = 'Покупка недорогих освещенных православных ювелирных изделий ручной работы по низким ценам';
    $title = 'Интернет-магазин православных изделий "Вечерия"';
    $callback = Session::get('callback') ?: Session::get('callback');
    $cart_count = 0;

    if (is_array(Session::get('items'))) {
      foreach (Session::get('items') as $category) {
        $cart_count += $category['count'];
      }
    }

    $items = DB::table('items')
      ->join('categories', 'items.subcategory_id', '=', 'categories.id')
      ->select('items.*', 'categories.plug as subcategory_plug', 'subcategory')
      ->inRandomOrder()->limit('4')->get();
    
    return view('index', compact('menu', 'items', 'keywords', 'description', 'title', 'cart_count', 'callback'));
  }
}
