<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

use DB;
use Session;

class Controller extends BaseController {
  public $menu;
  public $categoryQuery;
  public $canonical;
  
  public function __construct(Request $request) {
    $categories = DB::table('items')->join('categories', 'items.subcategory_id', '=', 'categories.id')
      ->select('*', 'categories.plug as subcategory_plug')->get();
  
    $menu = [];
    
    foreach ($categories as $category) {
      $menu_item['category'] = '';
      $menu_item['subcategory'] = [];
      
      if (!$this::inArray($menu, $category->category)) {
        $menu_item['category'] = $category->category;
        $menu_item['subcategory'][$category->plug] = $category->subcategory;
        
        array_push($menu, $menu_item);
      } else {
        foreach ($menu as $key => $value) {
          if ($value['category'] == $category->category) {
            $menu[$key]['subcategory'][$category->plug] = $category->subcategory;
          }
        }
      }
    }
  
    $this->categoryQuery = $categories;
    $this->menu = $menu;

    $url_path = (string)$request->fullUrl();
    $this->canonical = false;
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
