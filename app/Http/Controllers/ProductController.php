<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Session;

class ProductController extends Controller {
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

  public function index($category_slug, $product_slug, Request $request) {

    $query = DB::table('category')->where('slug', $category_slug)->get();

    if (count($query->toArray())) {
      $query = DB::table('product')->where('slug', $product_slug)->get();

      if (count($query->toArray())) {
        $product = $query->toArray()[0];

        $meta_keywords = $product->meta_keywords;
        $meta_description = $product->meta_description;
        $title = $product->meta_title;
        $h1 = $product->name;
        $description = $product->comment;

        $product = DB::table('product')->leftJoin('product_to_category', 'product.product_id', '=', 'product_to_category.product_id')
          ->select('product.*', 'category.name_2st as category', 'category.slug as category_slug')
          ->leftJoin('category', 'product.category_id', '=', 'category.category_id')
          ->where('product.product_id', $product->product_id)->groupBy('product.product_id')
          ->get()[0];

        $similar_product_id = explode(';', $product->similar_product_id);

        $similar_products = DB::table('product')->leftJoin('product_to_category', 'product.product_id', '=', 'product_to_category.product_id')
          ->select('product.*', 'category.name_2st as category', 'category.slug as category_slug')
          ->leftJoin('category', 'product.category_id', '=', 'category.category_id')
          ->whereIn('product.product_id', $similar_product_id)->groupBy('product.product_id')
          ->get();

        $buy = Session::get('buy') ?: Session::get('buy');
        $cart_count = 0;

        $product->image_path = explode(';', $product->image_path);

        $in_cart = false;

        $canonical = $this->canonical;

        if (is_array(Session::get('items'))) {
          foreach (Session::get('items') as $item) {
            $cart_count += $item['count'];
          }

          if (parent::inArray(Session::get('items'), $product->product_id)) {
            $in_cart = true;
          }
        }

        if ($request->ajax()) {
          return response()->json([
            'product' => $product,
          ]);

        } else {
          return view('product', compact('meta_keywords', 'meta_description', 'title', 'h1', 'description', 'product', 'similar_products', 'buy', 'in_cart'));
        }
      } else {
        return abort('404');
      }
    } else {
      return abort('404');
    }


    /*if (count($query->toArray())) {
      $category = $query->toArray()[0];

      $meta_keywords = $category->meta_keywords;
      $meta_description = $category->meta_description;
      $title = $category->meta_title;
      $h1 = $category->name_2st;
      $description = $category->comment;

      $items = DB::table('product')->leftJoin('product_to_category', 'product.product_id', '=', 'product_to_category.product_id')
        ->select('product.*')->where('product_to_category.category_id', $category->category_id)->groupBy('product.product_id')
        ->get();

      if ($request->ajax()) {
        return response()->json([
          'items' => $items,
        ]);

      } else {
        return view('product', compact('meta_keywords', 'meta_description', 'title', 'h1', 'description', 'items'));
      }
    } else {
      return abort('404');
    }

    /*global $flag;
    $flag = false;

    foreach ($this->categoryQuery->toArray() as $category) {
      if ($category->subcategory_plug == $category_plug) {
        $flag = true;
      }
    }

    $items = DB::table('items')->join('categories', 'items.subcategory_id', '=', 'categories.id')
      ->select('items.*', 'categories.plug as subcategory_plug', 'category', 'subcategory')
      ->where('categories.plug', $category_plug)
      ->where('items.plug', $item_plug)
      ->get();

    if (!count($items)) {
      $flag = false;
    }

    if ($flag) {
      $items = $items[0];

      $subcategory_plug = $items->subcategory_plug;
      $subcategory = $items->subcategory;
      
      $keywords = $items->meta_keywords;
      $description = $items->meta_description;
      $title = $items->meta_title;
      $callback = Session::get('callback') ?: Session::get('callback');
      $buy = Session::get('buy') ?: Session::get('buy');
      $cart_count = 0;

      $items->image_path = explode(';', $items->image_path);

      $in_cart = false;

      $canonical = $this->canonical;

      if (is_array(Session::get('items'))) {
        foreach (Session::get('items') as $item) {
          $cart_count += $item['count'];
        }

        if (parent::inArray(Session::get('items'), $items->id)) {
          $in_cart = true;
        }
      }
      
      return view('product', compact('items', 'subcategory', 'subcategory_plug', 'keywords', 'description', 'title', 'cart_count', 'in_cart', 'callback', 'buy', 'canonical'));
    } else {
      abort('404');
    }*/

  }
}
