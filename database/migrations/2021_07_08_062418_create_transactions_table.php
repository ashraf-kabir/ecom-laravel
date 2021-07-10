<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('transactions', function (Blueprint $table)
    {
      $table->id();
      $table->string('subtotal');
      $table->string('tax');
      $table->string('discount');
      $table->string('total');
      $table->string('payment_id');
      $table->integer('payment_type');
      $table->integer('user_id');
      $table->integer('order_id');
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
    Schema::dropIfExists('transactions');
  }
}
