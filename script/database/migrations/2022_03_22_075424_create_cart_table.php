<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart', function (Blueprint $table) {

            $table->increments('id');
            $table->unsignedBigInteger('term_id');
            $table->unsignedBigInteger('customer_id');
            $table->integer('qty')->nullable();
            $table->string('coupon')->nullable();
            $table->string('weight')->nullable();
            $table->integer('subtotal')->nullable();
            $table->string('origin')->nullable();
            $table->integer('price')->nullable();
            $table->string('destination')->nullable();
            $table->integer('primary_shipping_mode')->nullable();
            $table->string('drosphip_name')->nullable();
            $table->integer('drosphip_number')->nullable();
            $table->foreign('term_id')->references('id')->on('terms')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
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
        Schema::dropIfExists('cart');
    }
}
