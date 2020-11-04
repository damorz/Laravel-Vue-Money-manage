<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('transaction_id');
            $table->foreignId('user_id')->references('id')->on('users')->onUpdate('cascade');
            $table->double('price');
            $table->foreignId('category_id')->references('category_id')->on('categorys')->onUpdate('cascade');
            $table->string('description',40);
            $table->date('date');
            $table->string('transaction_type'); //ซ้ำซ้อน?

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
