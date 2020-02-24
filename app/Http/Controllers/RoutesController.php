<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class RoutesController extends Controller {
  
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index($slug, Request $request) {
    
    $query = DB::table('category')->where('slug', $slug)->get();
    
    if (count($query->toArray())) {
      return $this->category($query, $request);
    } else {
      $query = DB::table('product')->where('slug', $slug)->get();
      
      if (count($query->toArray())) {
        return $this->product($query);
      } else {
        return abort('404');
      }
    }
    
  }
  
  public function category($query, $request) {
    $category = $query->toArray()[0];
    
    $meta_keywords = $category->meta_keywords;
    $meta_description = $category->meta_description;
    $title = $category->meta_title;
    $h1 = $category->name_2st;
    $description = $category->comment;
  
    $items = DB::table('product')->leftJoin('product_to_category', 'product.product_id', '=', 'product_to_category.product_id')
      ->select('product.*')->where('product_to_category.category_id', $category->category_id)->groupBy('product.product_id')->get();
    
    /*echo '<pre>';
    var_dump($items);
    echo '<pre>';*/
  
    if ($request->ajax()) {
      echo 'asd';
    
    
    } else {
      return view('catalog', compact('meta_keywords', 'meta_description', 'title', 'h1', 'description', 'items'));
    }
    
    
    
  }
  
  public function product($query) {
    print_r($query);
  }
}
