<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('items', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('subcategory_id');
      $table->text('name');
      $table->text('plug');
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
      $table->text('image_path');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('items');
  }
}
