<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    $current_timestamp = Carbon::now()->toDateTimeString(); // 2020-03-11 12:25:00

    DB::table('users')->insert([
      'name'              => 'Admin',
      'email'             => 'admin@gmail.com',
      'email_verified_at' => $current_timestamp,
      'password'          => Hash::make('12345678'),
      'created_at'        => $current_timestamp,
      'updated_at'        => $current_timestamp
    ]);

    DB::table('clients')->insert([
      'email'      => 'kroos@gmail.com',
      'password'   => Hash::make('12345678'),
      'name'       => 'Toni Kroos',
      'phone'      => '12345678',
      'created_at' => $current_timestamp,
      'updated_at' => $current_timestamp
    ]);

    $category_payload = [
      ['category_name' => 'Vegetables', 'created_at' => $current_timestamp, 'updated_at' => $current_timestamp],
      ['category_name' => 'Fruits', 'created_at' => $current_timestamp, 'updated_at' => $current_timestamp],
      ['category_name' => 'Grocery', 'created_at' => $current_timestamp, 'updated_at' => $current_timestamp],
      ['category_name' => 'Dairy', 'created_at' => $current_timestamp, 'updated_at' => $current_timestamp]
    ];

    DB::table('categories')->insert($category_payload);
  }
}
