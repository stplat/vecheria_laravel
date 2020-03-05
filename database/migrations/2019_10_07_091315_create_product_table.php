<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('product', function (Blueprint $table) {
      $table->increments('product_id');
      $table->integer('category_id');
      $table->text('name');
      $table->text('slug');
      $table->text('manufacturer');
      $table->text('article');
      $table->text('meta_keywords');
      $table->text('meta_description');
      $table->text('meta_title');
      $table->text('available');
      $table->text('weight');
      $table->float('price');
      $table->text('dimension');
      $table->text('comment');
      $table->text('material');
      $table->text('technic');
      $table->text('description');
      $table->text('video');
      $table->text('image_path');
      $table->text('similar_product_id');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('product');
  }
}
