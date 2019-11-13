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
    $menu = $this->menu;
    $cart_count = $this->cart_count;
    $keywords = 'православная, лавка, изделия, крестики, бухвицы, браслеты, ручная работа, освещенные';
    $description = 'Покупка недорогих освещенных православных ювелирных изделий ручной работы по низким ценам';
    $title = 'Интернет-магазин православных изделий "Вечерия"';
    $callback = $this->callback;
  
    $items = [];
  
    $rand_id = array_rand($this->itemsQuery->toArray(), 4);
    foreach ($rand_id as $id) {
      array_push($items, $this->itemsQuery->toArray()[$id]);
    }
    
    return view('index', compact('menu', 'items', 'keywords', 'description', 'title', 'cart_count', 'callback'));
  }
}
