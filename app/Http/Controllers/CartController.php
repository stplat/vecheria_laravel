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
    
    $cart_count = Session::get('id') ? count(Session::get('id')) : 0;
    
    $keywords = 'православная, лавка, изделия, крестики, бухвицы, браслеты, ручная работа, освещенные';
    $description = 'Покупка недорогих освещенных православных ювелирных изделий ручной работы по низким ценам';
    $title = 'Интернет-магазин православных изделий "Вечерия"';
    
    echo $this->show('2');
    
    return view('cart', compact('menu', 'keywords', 'description', 'title', 'cart_count'));
  }
  
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
    //
  }
  
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function addSession(Request $request) {
    
    //Session::forget('items');
    
    $array = Session::get('items') ? Session::get('items') : [];
    $items = [];
    
    foreach ($array as $key => $value) {
      if (!in_array($request->input('id'), $value)) {
        array_push($items, ['id' => $request->input('id'), 'count' => '1']);
      } else {
        $items[$key]['count'] = $value['count'] + 1;
      }
    }
    
    return $items;
    
    
    /*$items = Session::get('id') ? Session::get('id') : [];

    if (!in_array($request->input('id'), $items)) {
      array_push($items, $request->input('id'));

      Session::put('id', $items);
      
      return count(Session::get('id'));
    }*/
    
    //Session::put('items', [['id' => '2', 'count' => '1'], ['id' => '3', 'count' => '1']]);
  }
  
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request) {
    //
  }
  
  /**
   * Display the specified resource.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function show($id) {
    return DB::table('items')->where('id', $id)->get();
  }
  
  /**
   * Show the form for editing the specified resource.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id) {
    //
  }
  
  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id) {
    //
  }
  
  /**
   * Remove the specified resource from storage.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id) {
    //
  }
}
