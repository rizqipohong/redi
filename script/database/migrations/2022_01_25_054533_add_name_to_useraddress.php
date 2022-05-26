<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNameToUseraddress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('useraddress', function (Blueprint $table) {
            $table->string('recipient')->after('address_id')->nullable();
            $table->bigInteger('phonenumber')->after('recipient')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('useraddress', function (Blueprint $table) {
            //
        });
    }
}
