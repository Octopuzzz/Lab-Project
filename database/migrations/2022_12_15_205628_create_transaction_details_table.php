<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id('TransactionDetailID');
            $table->foreignId('HeaderID')->constrained('header_transactions', 'HeaderTransactionID')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('ProductID')->constrained('products', 'ProductID')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('Quantity');
            $table->string('Sub_Total');
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
        Schema::dropIfExists('transaction_details');
    }
}
