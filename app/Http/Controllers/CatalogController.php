<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use DB;

class CatalogController extends Controller {
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

  public function index($category_plug, Request $request) {
    $limit = $request->input('per_page') ? $request->input('per_page') : 24;
    $sort = $request->input('orderby') ? $request->input('orderby') : 'ASC';

    $categories = DB::table('categories')->where('available', '1')->get();
    $subcategories = DB::table('categories')->select('subcategory')->where('plug', $category_plug)->get();
    $items = DB::table('items')->join('categories', 'items.subcategory_id', '=', 'categories.id')
      ->select('items.*', 'categories.plug as subcategory_plug')->where('categories.plug', $category_plug)
      ->orderBy('price', $sort)
      ->paginate($limit);
    $items_quantity = DB::table('items')->join('categories', 'items.subcategory_id', '=', 'categories.id')
      ->select('items.*', 'categories.plug as subcategory_plug')->where('categories.plug', $category_plug)->get();

    $menu = [];
    $subcategory = '';

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

    foreach ($subcategories as $subcategory_name) {
      $subcategory = $subcategory_name->subcategory;
    }

    $keywords = 'православная, лавка, изделия, крестики, бухвицы, браслеты, ручная работа, освещенные';
    $description = 'Покупка недорогих освещенных православных ювелирных изделий ручной работы по низким ценам';
    $title = 'Интернет-магазин православных изделий "Вечерия"';

    if ($request->ajax()) {
      $html_paginate = str_replace('<ul class="pagination">', '', $items->render());
      $html_paginate = str_replace('</ul>', '', $html_paginate);
      $html_paginate = (string) preg_replace('/\s+/', ' ', $html_paginate);

      return response()->json([
        'pagination' => $html_paginate,
        'items' => $items,
        'items_quantity' => $items_quantity
      ]);

    } else {
      if (count($subcategories)) {
        return view('catalog', compact('menu', 'items_quantity', 'items', 'subcategory', 'keywords', 'description', 'title'));
      } else {
        abort('404');
      }
    }
  }
}
