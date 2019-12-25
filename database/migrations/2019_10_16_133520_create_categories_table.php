<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('categories', function (Blueprint $table) {
      $table->increments('id');
      $table->text('category');
      $table->text('subcategory');
      $table->text('plug');
      $table->text('available');
      $table->text('meta_keywords');
      $table->text('meta_description');
      $table->text('meta_title');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('categories');
  }
}
