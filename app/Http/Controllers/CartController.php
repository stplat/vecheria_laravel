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
    //Session::forget('cart_step');
    $meta_keywords = 'православная, лавка, изделия, крестики, бухвицы, браслеты, ручная работа, освещенные';
    $meta_description = 'Покупка недорогих освещенных православных ювелирных изделий ручной работы по низким ценам';
    $title = 'Корзина покупок интернет-магазина православных изделий "Вечерия"';
    $callback = Session::get('callback') ?: Session::get('callback');
    $cart_count = 0;
    $id = [];
    $items = [];
    
    if (is_array(Session::get('items'))) {
      foreach (Session::get('items') as $category) {
        $cart_count += $category['count'];
      }
    }
    
    if (is_array(Session::get('items'))) {
      foreach (Session::get('items') as $array) {
        array_push($id, $array['id']);
      }
      
      $items_query = $this->show($id);
      
      foreach ($items_query as $obj) {
        $item = $obj;
        foreach (Session::get('items') as $array) {
          if ($array['id'] == $obj->product_id) {
            $item->count = $array['count'];
            $item->total = $array['count'] * $obj->price;
          }
        }
        array_push($items, $item);
      }
    }
    
    $cart_total = 0;
    
    if (Session::get('items'))
      foreach (Session::get('items') as $item) {
        $cart_total += $item['total'];
      }
    
    $cart_step = Session::get('cart_step') ?: 1;
    
    $canonical = $this->canonical;
    
    return view('cart', compact('meta_keywords', 'meta_description', 'title', 'cart_count', 'items', 'callback', 'cart_total', 'cart_step', 'canonical'));
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
    
    $id = $request->input('id');
    $count = $request->input('count');
    $price = $request->input('price');
    $total = (int)$request->input('count') * (int)$request->input('price');
    
    if (!parent::inArray($items, $id)) {
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
    return DB::table('product')->leftJoin('category', 'product.category_id', '=', 'category.category_id')
      ->select('product.*', 'category.name_2st as category', 'category.slug as category_slug')->groupBy('product.product_id')
      ->whereIn('product.product_id', $id)->get();
  }
  
  public function ordering(Request $request) {
    $name = $request->input('name');
    $phone = $request->input('phone');
    $shipping = $request->input('shipping');
    $address = $request->input('address') ? $request->input('address') : 'не указано';
    $email = $request->input('email') ? (string)$request->input('email') : 'не указано';
    $comment = $request->input('comment') ? $request->input('comment') : 'не указано';
    $items = $request->input('items');
    $price = $request->input('price');
    $promo = $request->input('promo');
    $discount = $request->input('discount');
    $total = (strpos($request->input('total'), 'доставка')) ? $request->input('total') : $request->input('total') . ' руб.';
    
    $to = "<info@vecheria.ru>, ";
    if ($request->input('email')) {
      $to .= "<" . $request->input('email') . ">";
    }
    
    $headers = "Content-type: text/html; charset=urf-8 \r\n";
    $headers .= "From: <info@vecheria.ru>\r\n";
    $headers .= "Reply-To: info@vecheria.ru\r\n";
    $subject = 'Заказ на покупку ювелирного изделия. vecheria.ru';
    $message = '              
      <div class="cart-ordering">
        <div class="cart-ordering__title" style="text-transform: uppercase;font-size: 18px;font-weight: 500;padding: 15px 0 10px;border-bottom: 1px solid #eaeaea;color:#414850;">Информация о заказе</div>
        <ul class="cart-ordering__list" style="list-style-type: none;margin: 0;padding: 10px 0 0;">
          <li style="margin: 5px 0;">Контактное лицо: <b>' . $name . '</b></li>
          <li style="margin: 5px 0;">Телефон: <b>' . $phone . '</b></li>
          <li style="margin: 5px 0;">Способ доставки:  <b>' . $shipping . '</b></li>
          <li style="margin: 5px 0;">Адрес доставки: <b>' . $address . '</b></li>
          <li style="margin: 5px 0;">Электронная почта: <b>' . $email . '</b></li>
          <li style="margin: 5px 0;">Комментарий: <b>' . $comment . '</b></li>
          <li style="margin: 5px 0;">Изделие: <b>' . $items . '</b></li>
          <li style="margin: 5px 0;">Стоимость изделий: <b>' . $price . ' руб.</b></li>
          <li style="margin: 5px 0;">Скидка по промокоду (' . $promo . '): <b>' . $discount . ' руб.</b></li>
          <li style="margin: 5px 0;">Общая стоимость покупки: <b>' . $total . '</b></li>
        </ul>
      </div>      
    ';
    
    mail($to, $subject, $message, $headers);
    
    Session::forget('items');
  }
  
  public function checkPromo(Request $request) {
    $promo_code = $request->input('promo');
    $query = DB::table('promo')->where('code', '=', $promo_code)->exists();
    
    if ($query) {
      $discount = DB::table('promo')->where('code', '=', $promo_code)->select('discount')->get()[0]->discount;
      
      if ($request->ajax()) {
        return response()->json([
          'check' => true,
          'discount' => $discount,
        ]);
      }
    }
    
  }
}
