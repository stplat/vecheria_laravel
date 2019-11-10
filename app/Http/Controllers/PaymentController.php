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
    $categories = DB::table('categories')->where('available', '1')->get();
    
    $menu = [];
    
    function inArray($array, $needle) {
      $result = 0;
      
      foreach ($array as $key => $value) {
        if (is_array($value) && in_array($needle, $value)) {
          $result = in_array($needle, $value);
        }
      }
      
      return $result;
    }
    
    foreach ($categories as $row) {
      $menu_item['category'] = '';
      $menu_item['subcategory'] = [];
      
      if (!inArray($menu, $row->category)) {
        $menu_item['category'] = $row->category;
        $menu_item['subcategory'][$row->plug] = $row->subcategory;
        
        array_push($menu, $menu_item);
      } else {
        foreach ($menu as $key => $value) {
          if ($value['category'] == $row->category) {
            $menu[$key]['subcategory'][$row->plug] = $row->subcategory;
          }
        }
      }
    }
  
    $cart_count = count(Session::get('id'));
    
    $keywords = 'православная, лавка, изделия, крестики, бухвицы, браслеты, ручная работа, освещенные';
    $description = 'Покупка недорогих освещенных православных ювелирных изделий ручной работы по низким ценам';
    $title = 'Интернет-магазин православных изделий "Вечерия"';
    
    return view('payment', compact('menu', 'keywords', 'description', 'title', 'cart_count'));
  }
}
