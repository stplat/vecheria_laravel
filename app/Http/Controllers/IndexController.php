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
    $meta_keywords = 'православная, лавка, изделия, крестики, бухвицы, браслеты, ручная работа, освещенные';
    $meta_description = 'Покупка недорогих освещенных православных ювелирных изделий ручной работы. Большой выбор образков, крестиков и бусин. Звоните +7 (495) 203-96-96';
    $title = '«ВЕЧЕРИЯ» - интернет магазин православных изделий';

    $items = DB::table('product')->leftJoin('product_to_category', 'product.product_id', '=', 'product_to_category.product_id')
      ->select('product.*')->inRandomOrder()->limit('4')->get();
    
    $canonical = $this->canonical;
    
    return view('index', compact('items', 'meta_keywords', 'meta_description', 'title', 'canonical'));
  }

  public function sitemap(\Request $request) {
    return response()->view('sitemap', [

    ])->header('Content-Type', 'text/xml');
  }
  
  public function route() {
  
  }
}
