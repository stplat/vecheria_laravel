<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use DB;
use Session;

class SearchController extends Controller {
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

  public function index(Request $request) {
    $keywords = '';
    $description = 'Поиск товаров по артикулу или названию';
    $title = 'Поиск товаров по артикулу или названию';

    $canonical = $this->canonical;

    $search_str = '';
    $items = false;

    if ($request->input('search')) {
      $items = DB::table('product')->get();
      $search_str = mb_strtolower((string)$request->input('search'));
      $id = [];

      foreach ($items as $value) {
        $name = mb_strtolower((string)$value->name);
        $article = mb_strtolower((string)$value->article);

        if (strpos($name, $search_str) !== false || strpos($article, $search_str) !== false) {
          array_push($id, $value->product_id);
        }
      }
      $items = DB::table('product')->select('product.*', 'category.name_2st as category', 'category.slug as category_slug')
        ->leftJoin('category', 'product.category_id', '=', 'category.category_id')
        ->whereIn('product.product_id', $id)->get();

      /*$items = DB::table('product')->leftJoin('categories', 'items.subcategory_id', '=', 'categories.id')
        ->select('items.*', 'categories.plug as subcategory_plug')->whereIn('items.id', $id)->paginate();*/
    }

    return view('search', compact('keywords', 'description', 'title', 'canonical', 'search_str', 'items'));
  }
}
