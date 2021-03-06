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
    $keywords = 'православная, лавка, изделия, крестики, бухвицы, браслеты, ручная работа, освещенные';
    $description = '';
    $title = 'Контакты';
    $callback = Session::get('callback') ?: Session::get('callback');
    $cart_count = 0;

    if (is_array(Session::get('items'))) {
      foreach (Session::get('items') as $category) {
        $cart_count += $category['count'];
      }
    }

    $canonical = $this->canonical;

    return view('contacts', compact('keywords', 'description', 'title', 'cart_count', 'callback', 'canonical'));
  }
}
