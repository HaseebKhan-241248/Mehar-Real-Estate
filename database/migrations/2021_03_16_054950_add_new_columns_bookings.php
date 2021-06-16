<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnsBookings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->integer('marketer_id')->nullable();
            $table->double('marketer_commision_per',15,2)->nullable();
            $table->double('marketer_commision_value',15,2)->nullable();
            $table->double('marketer_coms_formula',15,2)->nullable();
            $table->double('marketer_commision_due',15,2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            //
        });
    }
}
