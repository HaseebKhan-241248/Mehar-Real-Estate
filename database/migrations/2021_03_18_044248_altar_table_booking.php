<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AltarTableBooking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('head_id')->nullable();
            $table->string('mode_of_payment')->nullable();
            $table->string('start_date')->nullable();
            $table->double('installment_amount',15,2)->nullable();
            $table->double('possession',15,2)->nullable();
            $table->string('no_of_installments')->nullable();
            $table->double('marketer_coms_value_paid',15,2)->nullable();
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
