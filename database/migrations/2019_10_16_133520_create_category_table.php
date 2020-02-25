<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('category', function (Blueprint $table) {
      $table->increments('category_id');
      $table->text('name');
      $table->text('name_2st');
      $table->text('slug');
      $table->text('available');
      $table->text('meta_keywords');
      $table->text('meta_description');
      $table->text('meta_title');
      $table->text('comment');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('category');
  }
}
