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
  public $categoryQuery;
  public $canonical;
  
  public function __construct(Request $request) {
    /*$categories = DB::table('items')->join('categories', 'items.subcategory_id', '=', 'categories.id')
      ->select('*', 'categories.plug as subcategory_plug')->get();
      
    $this->categoryQuery = $categories;

    $url_path = (string)$request->fullUrl();
    $this->canonical = false;*/
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
