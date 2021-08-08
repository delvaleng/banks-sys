<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountOwnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_own', function (Blueprint $table) {
          $table->id();

          $table->bigInteger('id_user')->unsigned();
          $table->bigInteger('id_tp_account')->unsigned();

          $table->string('n_account')->nullable();
          $table->double('balance')->nullable();

          $table->boolean('status')->nullable()->default(false);
          $table->timestamps();
          $table->foreign('id_user')->references('id')->on('users');
          $table->foreign('id_tp_account')->references('id')->on('tp_account');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('account_own');
    }
}
