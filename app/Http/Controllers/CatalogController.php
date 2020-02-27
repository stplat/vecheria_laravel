<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CatalogController extends Controller {

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

  public function index($category_slug, Request $request) {

    $query = DB::table('category')->where('slug', $category_slug)->where('available', '1')->get();

    if (count($query->toArray())) {
      $category = $query->toArray()[0];

      $meta_keywords = $category->meta_keywords;
      $meta_description = $category->meta_description;
      $title = $category->meta_title;
      $h1 = $category->name_2st;
      $description = $category->comment;

      $limit = $request->input('limit');
      $order = $request->input('orderby') ?: 'asc';

      $items = DB::table('product')->leftJoin('product_to_category', 'product.product_id', '=', 'product_to_category.product_id')
        ->select('product.*', 'category.name_2st as category', 'category.slug as category_slug')->where('product_to_category.category_id', $category->category_id)->groupBy('product.product_id')->limit($limit)
        ->orderBy('price', $order)->leftJoin('category', 'product.category_id', '=', 'category.category_id')->get();

      if ($request->ajax()) {
        return response()->json([
          'items' => $items,
        ]);

      } else {
        return view('catalog', compact('meta_keywords', 'meta_description', 'title', 'h1', 'description', 'items'));
      }
    } else {
      return abort('404');
    }
  }
}