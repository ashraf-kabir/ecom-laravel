<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('products', function (Blueprint $table)
    {
      $table->id();
      $table->string('product_name');
      $table->string('product_price');
      $table->string('product_image');
      $table->string('product_length');
      $table->string('product_width');
      $table->string('product_height');
      $table->string('product_weight');
      $table->string('product_quantity');
      $table->longText('product_description');
      $table->integer('category_id');
      $table->integer('status');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('products');
  }
}
