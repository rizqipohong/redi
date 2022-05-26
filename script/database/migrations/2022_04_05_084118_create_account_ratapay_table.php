<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountRatapayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_ratapay', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('customer_id');
            $table->string('email')->nullable();
            $table->string('name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('account_currency')->nullable();
            $table->string('account_last_active')->nullable();
            $table->string('account_created_time')->nullable();
            $table->bigInteger('account_id')->nullable();
            $table->bigInteger('account_balance')->nullable();
            $table->bigInteger('phone')->nullable();
            $table->string('account_status')->nullable();
            $table->string('link_status')->nullable();
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
        Schema::dropIfExists('account_ratapay');
    }
}
