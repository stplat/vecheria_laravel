<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;

class CatalogController extends Controller {
  
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  
  public function index($category_plug, Request $request) {
    global $flag;
    $flag = false;
    
    foreach ($this->itemsQuery->toArray() as $item) {
      if ($item->subcategory_plug == $category_plug) {
        $flag = true;
      }
    }
    
    if ($flag) {
      $limit = $request->input('per_page') ? $request->input('per_page') : 24;
      $sort = $request->input('orderby') ? $request->input('orderby') : 'ASC';
      
      $items = DB::table('items')->join('categories', 'items.subcategory_id', '=', 'categories.id')
        ->select('*', 'categories.plug as subcategory_plug')->where('categories.plug', $category_plug)
        ->orderBy('price', $sort)
        ->paginate($limit);
      
      $subcategory = $items->items()[0]->subcategory;
      $items_quantity = count($items->items());
      $items_quantity_all = 13;
      
      $menu = $this->menu;
      $cart_count = $this->cart_count;
      $keywords = 'православная, лавка, изделия, крестики, бухвицы, браслеты, ручная работа, освещенные';
      $description = 'Покупка недорогих освещенных православных ювелирных изделий ручной работы по низким ценам';
      $title = 'Интернет-магазин православных изделий "Вечерия"';
      $callback = $this->callback;
      
      if ($request->ajax()) {
        $html_paginate = str_replace('<ul class="pagination">', '', $items->render());
        $html_paginate = str_replace('</ul>', '', $html_paginate);
        $html_paginate = (string)preg_replace('/\s+/', ' ', $html_paginate);
        
        return response()->json([
          'pagination' => $html_paginate,
          'items' => $items,
          'items_quantity' => $items_quantity,
          'items_quantity_all' => $items_quantity_all
        ]);
        
      } else {
        return view('catalog', compact('menu', 'items_quantity', 'items_quantity_all', 'items', 'subcategory', 'keywords', 'description', 'title', 'cart_count', 'callback'));
      }
    } else {
      abort('404');
    }
    
  }
}
