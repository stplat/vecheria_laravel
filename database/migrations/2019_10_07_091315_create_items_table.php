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
      $table->increments('id');                 // 1. идентификатор
      $table->integer('display');               // 2. отображение
      $table->integer('manufacturerid');        // 3. идентификатор производителя
      $table->integer('collectionid');          // 4. идентификатор коллекции
      $table->integer('article');               // 5. статья
      $table->integer('name');                  // 6. имя
      $table->integer('price');                 // 7. стоимость
      $table->integer('gender');                // 8. пол
      $table->integer('discount');              // 9. скидка
      $table->integer('availability');          // 10. доступность
      $table->integer('description');           // 11. описание
      $table->integer('dimensions');            // 12. размеры
      $table->integer('weight');                // 13. вес
      $table->integer('packaging');             // 14. упаковка
      $table->integer('orderscount');           // 15. количество заказов
      $table->integer('viewscount');            // 16. количество просмотров
      $table->integer('created');               // 17. созданный
      $table->integer('modified');              // 18. модифицированный
      $table->integer('title');                 // 19. заголовок
      $table->integer('metadescription');       // 20. мета-описание
      $table->integer('metakeywords');          // 21. мета-ключевики
      $table->integer('sanctified');            // 22. освещение
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
