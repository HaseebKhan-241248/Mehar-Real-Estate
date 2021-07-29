<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AltarIntial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('intiqals', function (Blueprint $table) {
            $table->integer('booking_id')->nullable()->change();
            $table->string('intiqal_no')->nullable()->change();
            $table->string('intiqal')->nullable()->change();
            $table->string('intiqal_attachment')->nullable()->change();
            $table->string('description')->nullable()->change();
            $table->string('type')->nullable()->change();
            $table->integer('status')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('intiqals', function (Blueprint $table) {
            //
        });
    }
}
