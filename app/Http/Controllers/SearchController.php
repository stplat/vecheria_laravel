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
    $callback = Session::get('callback') ?: Session::get('callback');
    $cart_count = 0;

    if (is_array(Session::get('items'))) {
      foreach (Session::get('items') as $category) {
        $cart_count += $category['count'];
      }
    }

    $canonical = $this->canonical;

    $search_str = '';
    $items = false;

    if ($request->input('search')) {
      $items = DB::table('items')->get();
      $search_str = mb_strtolower((string)$request->input('search'));
      $id = [];

      foreach ($items as $value) {
        $name = mb_strtolower((string)$value->name);
        $article = mb_strtolower((string)$value->article);

        if (strpos($name, $search_str) !== false || strpos($article, $search_str) !== false) {
          array_push($id, $value->id);
        }
      }

      $items = DB::table('items')->leftJoin('categories', 'items.subcategory_id', '=', 'categories.id')
        ->select('items.*', 'categories.plug as subcategory_plug')->whereIn('items.id', $id)->paginate();
    }

    return view('search', compact('keywords', 'description', 'title', 'cart_count', 'callback', 'canonical', 'search_str', 'items'));
  }
}
