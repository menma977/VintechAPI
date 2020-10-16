<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryStakesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('history_stakes', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->text('user');
      $table->text('fund');
      $table->string('possibility');
      $table->text('result');
      $table->string('status');
      $table->boolean('stop')->default(false);
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
    Schema::dropIfExists('history_stakes');
  }
}
