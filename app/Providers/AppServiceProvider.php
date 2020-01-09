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
    $keywords = 'православная, лавка, изделия, крестики, бухвицы, браслеты, ручная работа, освещенные';
    $description = 'Покупка недорогих освещенных православных ювелирных изделий ручной работы по низким ценам';
    $title = 'Интернет-магазин православных изделий "Вечерия"';

    $categories = DB::table('items')->join('categories', 'items.subcategory_id', '=', 'categories.id')
      ->select('*', 'categories.plug as subcategory_plug')->get();

    $menu = [];

    foreach ($categories as $category) {
      $menu_item['category'] = '';
      $menu_item['subcategory'] = [];

      if (!$this::inArray($menu, $category->category)) {
        $menu_item['category'] = $category->category;
        $menu_item['subcategory'][$category->plug] = $category->subcategory;

        array_push($menu, $menu_item);
      } else {
        foreach ($menu as $key => $value) {
          if ($value['category'] == $category->category) {
            $menu[$key]['subcategory'][$category->plug] = $category->subcategory;
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
      'keywords' => $keywords,
      'description' => $description,
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
