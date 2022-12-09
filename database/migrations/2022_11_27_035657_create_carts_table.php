<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id('CardID');
            $table->foreignId('UserID')->constrained('users', 'UserID');
            $table->foreignId('ProductID')->constrained('products', 'ProductID');
            $table->integer('Quantity');
            $table->integer('Price');
            $table->unsignedBigInteger('TotalPrice');
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
        Schema::dropIfExists('carts');
    }
}
