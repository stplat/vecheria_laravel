<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use DB;
use Session;

class ShippingController extends Controller {
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

  public function index() {
    $meta_keywords = 'православная, лавка, изделия, крестики, бухвицы, браслеты, ручная работа, освещенные';
    $meta_description = 'Курьерская доставка православных ювелирных изделий в Москве и МО';
    $title = 'Способы доставки в интернет-магазине православных изделий "Вечерия"';
    $callback = Session::get('callback') ?: Session::get('callback');
    $cart_count = 0;

    if (is_array(Session::get('items'))) {
      foreach (Session::get('items') as $category) {
        $cart_count += $category['count'];
      }
    }

    $canonical = $this->canonical;

    return view('shipping', compact('meta_keywords', 'meta_description', 'title', 'cart_count', 'callback', 'canonical'));
  }
}
