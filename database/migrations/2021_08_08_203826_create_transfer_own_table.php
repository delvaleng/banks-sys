<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransferOwnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfer_own', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_account_own_origen')->unsigned();
            $table->bigInteger('id_account_own_destino')->unsigned();
            $table->bigInteger('id_user')->unsigned();
            $table->double('mount')->nullable();
            $table->double('mount_prev')->nullable();
            $table->double('mount_next')->nullable();
            $table->string('n_transfer')->nullable();
            $table->boolean('status')->nullable()->default(false);
            $table->timestamps();
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_account_own_origen')->references('id')->on('account_own');
            $table->foreign('id_account_own_destino')->references('id')->on('account_own');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transfer_own');
    }
}
