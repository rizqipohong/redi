<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aff_product', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('term_id');
            $table->bigInteger('views')->nullable();
            $table->bigInteger('click_share')->nullable();
            $table->bigInteger('click_cart')->nullable();
            $table->bigInteger('click_like')->nullable();
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
        Schema::dropIfExists('aff_product');
    }
}
