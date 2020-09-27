<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class IndexController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $meta_keywords = 'православная, лавка, изделия, крестики, бухвицы, браслеты, ручная работа, освещенные';
    $meta_description = 'Покупка недорогих освещенных православных ювелирных изделий ручной работы. Большой выбор образков, крестиков и бусин. Звоните +7 (495) 203-96-96';
    $title = '«ВЕЧЕРИЯ» - интернет магазин православных изделий';

    $items = DB::table('product')->leftJoin('product_to_category', 'product.product_id', '=', 'product_to_category.product_id')
      ->select('product.*', 'category.name_2st as category', 'category.slug as category_slug')->inRandomOrder()->limit('4')
      ->leftJoin('category', 'product.category_id', '=', 'category.category_id')->get();

    $items = $items->map(function ($item) {
      $item->image_path = collect(explode(';', $item->image_path))->map(function ($item) {
        return collect([
          'name' => substr($item, 0, strripos($item, '.')),
          'extension' => substr($item, strripos($item, '.') + 1, strlen($item)),
        ]);
      });
      return $item;
    });

    $canonical = $this->canonical;

    return view('index', compact('items', 'meta_keywords', 'meta_description', 'title', 'canonical'));
  }

  public function sitemap(Request $request)
  {
    $items = DB::table('product')->leftJoin('product_to_category', 'product.product_id', '=', 'product_to_category.product_id')
      ->select('product.*', 'category.name_2st as category', 'category.slug as category_slug')->groupBy('product.product_id')
      ->leftJoin('category', 'product.category_id', '=', 'category.category_id')->get();

    $categories = DB::table('category')->where('available', '1')->get();

    return response()->view('sitemap', compact('items', 'categories'))->header('Content-Type', 'text/xml');
  }

  public function route()
  {

  }
}
