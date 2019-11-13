<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use DB;
use Session;

class ContactsController extends Controller {
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
    
    return view('contacts', compact('menu', 'keywords', 'description', 'title', 'cart_count', 'callback'));
  }
}
