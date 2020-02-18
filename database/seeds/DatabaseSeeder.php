<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    DB::table('users')->insert([
      'name' => '100',
      'email' => str_random(10) . '@gmail.com',
      'password' => bcrypt('secret'),
    ]);

    DB::table('promo')->insert([
      'code' => Str::upper(Str::random(5, 'alpha')),
      'discount' => '10',
    ]);
  }
}
