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

    foreach ($this->categoryQuery->toArray() as $category) {
      if ($category->subcategory_plug == $category_plug) {
        $flag = true;
      }
    }

    if ($flag) {
      $limit = $request->input('per_page') ? $request->input('per_page') : 24;
      $sort = $request->input('orderby') ? $request->input('orderby') : 'ASC';

      $items = DB::table('items')->join('categories', 'items.subcategory_id', '=', 'categories.id')
        ->select('items.*', 'categories.plug as subcategory_plug', 'subcategory')->where('categories.plug', $category_plug)
        ->orderBy('price', $sort)
        ->paginate($limit);

      $categories_page = DB::table('categories')->where('plug', $category_plug)->get();

      $subcategory = $items->items()[0]->subcategory;

      $menu = $this->menu;
      $keywords = $categories_page[0]->meta_keywords;
      $description = $categories_page[0]->meta_description;
      $title = $categories_page[0]->meta_title;
      $callback = Session::get('callback') ?: Session::get('callback');
      $cart_count = 0;

      if (is_array(Session::get('items'))) {
        foreach (Session::get('items') as $category) {
          $cart_count += $category['count'];
        }
      }

      $url_path = (string)$request->fullUrl();
      $canonical = strpos($url_path, '?') !== false ? $request->Url() : false;

      if ($request->ajax()) {
        $html_paginate = str_replace('<ul class="pagination">', '', $items->render());
        $html_paginate = str_replace('</ul>', '', $html_paginate);
        $html_paginate = (string)preg_replace('/\s+/', ' ', $html_paginate);

        return response()->json([
          'pagination' => $html_paginate,
          'items' => $items,
        ]);


      } else {
        return view('catalog', compact('menu', 'items', 'subcategory', 'keywords', 'description', 'title', 'cart_count', 'callback', 'canonical'));
      }
    } else {
      abort('404');
    }
  }
}
