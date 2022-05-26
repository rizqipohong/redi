<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('returnitems', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('term_id');
            $table->string('info')->nullable();
            $table->string('status')->nullable();
            $table->integer('qty')->defult(1);
            $table->double('amount');

            $table->foreign('order_id')
                ->references('id')->on('orders')
                ->onDelete('cascade');

            $table->foreign('term_id')
                ->references('id')->on('terms')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('returnitems');
    }
}
