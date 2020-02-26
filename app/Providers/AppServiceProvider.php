<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;

use DB;
use Session;

class AppServiceProvider extends ServiceProvider {
  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot() {
    $meta_keywords = 'православная, лавка, изделия, крестики, бухвицы, браслеты, ручная работа, освещенные';
    $meta_description = 'Покупка недорогих освещенных православных ювелирных изделий ручной работы по низким ценам';
    $title = 'Интернет-магазин православных изделий "Вечерия"';

    $category_list = DB::table('category')->leftJoin('product_to_category', 'category.category_id', '=', 'product_to_category.category_id')
      ->select('category.name', 'category.name_2st', 'category.slug')
      ->groupBy('category.category_id')->where('available', '1')
      ->get();

    $menu = [];

    foreach ($category_list as $category) {
      $menu_item['category'] = '';
      $menu_item['subcategory'] = [];

      if (!$this::inArray($menu, $category->name)) {
        $menu_item['category'] = $category->name;
        $menu_item['subcategory'][$category->slug] = $category->name_2st;

        array_push($menu, $menu_item);
      } else {
        foreach ($menu as $key => $value) {
          if ($value['category'] == $category->name) {
            $menu[$key]['subcategory'][$category->slug] = $category->name_2st;
          }
        }
      }
    }

    view()->composer('*', function ($view) {
      $cart_count = 0;

      if (is_array(Session::get('items'))) {
        foreach (Session::get('items') as $category) {
          $cart_count += $category['count'];
        }
      }

      $callback = Session::get('callback') ?: Session::get('callback');

      $view->with([
        'cart_count' => $cart_count,
        'callback' => $callback,
      ]);
    });


    view()->share([
      'menu' => $menu,
      'meta_keywords' => $meta_keywords,
      'meta_description' => $meta_description,
      'title' => $title,
      'canonical' => false,
    ]);

  }

  /**
   * Register any application services.
   *
   * @return void
   */
  public function register() {
    //$request->server->set('HTTPS', true);
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
}
