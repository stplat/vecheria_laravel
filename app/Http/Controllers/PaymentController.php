<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use DB;
use Session;

class PaymentController extends Controller {
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

  public function index() {
    $meta_keywords = 'православная, лавка, изделия, крестики, бухвицы, браслеты, ручная работа, освещенные';
    $meta_description = 'Безналичный и наличный расчет';
    $title = 'Способы оплаты в интернет-магазине православных изделий "Вечерия"';
    $callback = Session::get('callback') ?: Session::get('callback');
    $cart_count = 0;

    if (is_array(Session::get('items'))) {
      foreach (Session::get('items') as $category) {
        $cart_count += $category['count'];
      }
    }

    $canonical = $this->canonical;

    return view('payment', compact('meta_keywords', 'meta_description', 'title', 'cart_count', 'callback', 'canonical'));
  }
}
