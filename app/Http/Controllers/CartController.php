<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class CartController extends Controller {
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
    $callback = Session::get('callback') ?: Session::get('callback');

    if (is_array(Session::get('items'))) {
      foreach (Session::get('items') as $array) {
        array_push($id, $array['id']);
      }

      $items_query = $this->show($id);

      foreach ($items_query as $obj) {
        $item = $obj;
        foreach (Session::get('items') as $array) {
          if ($array['id'] == $obj->id) {
            $item->count = $array['count'];
            $item->total = $array['count'] * $obj->price;
          }
        }
        array_push($items, $item);
      }
    }

    return view('cart', compact('menu', 'keywords', 'description', 'title', 'cart_count', 'items', 'callback'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function addSession(Request $request) {

    //Session::forget('items');

    $array = Session::get('items');
    $items = [];

    if (!empty($array)) {
      $items = $array;
    }

    function inArray($array, $needle) {
      $result = 0;

      foreach ($array as $key => $value) {
        if (is_array($value) && in_array($needle, $value)) {
          $result = in_array($needle, $value);
        }
      }

      return $result;
    }

    $id = $request->input('id');
    $count = $request->input('count');
    $price = $request->input('price');
    $total = (int)$request->input('count') * (int)$request->input('price');

    if (!inArray($items, $id)) {
      array_push($items, [
        'id' => $id,
        'count' => $count,
        'price' => $price,
        'total' => $total,
      ]);
    } else {
      foreach ($items as $key => $value) {
        if ($value['id'] == $id) {
          $items[$key]['count'] = $count;
          $items[$key]['total'] = (int)$request->input('count') * (int)$value['price'];
        }
      }
    }

    Session::put('items', $items);

    $cart_count = 0;
    $cart_total = 0;

    foreach (Session::get('items') as $item) {
      $cart_count += $item['count'];
    }

    foreach (Session::get('items') as $item) {
      $cart_total += $item['total'];
    }

    return compact('cart_count', 'cart_total', 'items');
  }

  public function removeSession(Request $request) {
    $array = Session::get('items');
    $id = $request->input('id');

    $items = array_filter($array, function ($i) use ($id) {
      return $i['id'] !== $id;
    });

    $items = array_values($items);

    Session::put('items', $items);

    $cart_count = 0;
    $cart_total = 0;

    foreach (Session::get('items') as $item) {
      $cart_count += $item['count'];
    }

    foreach (Session::get('items') as $item) {
      $cart_total += $item['total'];
    }

    return compact('cart_count', 'cart_total', 'items');
  }

  /**
   * Display the specified resource.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function show(array $id) {
    return DB::table('items')->join('categories', 'items.subcategory_id', '=', 'categories.id')
      ->select('items.*', 'categories.plug as subcategory_plug')
      ->whereIn('items.id', $id)
      ->get();
  }
}
