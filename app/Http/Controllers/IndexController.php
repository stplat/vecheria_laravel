<?php

namespace App\Http\Controllers;

use Session;
use DB;

class IndexController extends Controller {
  
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    $keywords = 'православная, лавка, изделия, крестики, бухвицы, браслеты, ручная работа, освещенные';
    $description = 'Покупка недорогих освещенных православных ювелирных изделий ручной работы. Большой выбор образков, крестиков и бусин. Звоните +7 (495) 203-96-96';
    $title = '«ВЕЧЕРИЯ» - интернет магазин православных изделий';
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

    $canonical = $this->canonical;
    
    return view('index', compact('items', 'keywords', 'description', 'title', 'cart_count', 'callback', 'canonical'));
  }

  public function sitemap(\Request $request) {
    return response()->view('sitemap', [

    ])->header('Content-Type', 'text/xml');
  }
}
