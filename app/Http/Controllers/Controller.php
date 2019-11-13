<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use DB;
use Session;

class Controller extends BaseController {
  public $menu;
  public $itemsQuery;
  public $cart_count;
  public $callback;
  
  public function __construct() {
    $items = DB::table('items')->join('categories', 'items.subcategory_id', '=', 'categories.id')
      ->select('*', 'categories.plug as subcategory_plug')->get();
  
    $menu = [];
    
    foreach ($items as $item) {
      $menu_item['category'] = '';
      $menu_item['subcategory'] = [];
      
      if (!$this::inArray($menu, $item->category)) {
        $menu_item['category'] = $item->category;
        $menu_item['subcategory'][$item->plug] = $item->subcategory;
        
        array_push($menu, $menu_item);
      } else {
        foreach ($menu as $key => $value) {
          if ($value['category'] == $item->category) {
            $menu[$key]['subcategory'][$item->plug] = $item->subcategory;
          }
        }
      }
    }
    
    $cart_count = 0;
    
    if (is_array(Session::get('items'))) {
      foreach (Session::get('items') as $item) {
        $cart_count += $item['count'];
      }
    }
  
    $this->itemsQuery = $items;
    $this->menu = $menu;
    $this->cart_count = $cart_count;
    $this->callback = Session::get('callback') ?: Session::get('callback');
  }
  
  public static function inArray($array, $needle) {
    $result = 0;
    
    foreach ($array as $key => $value) {
      if (is_array($value) && in_array($needle, $value)) {
        $result = in_array($needle, $value);
      }
    }
    
    return $result;
  }
  
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
