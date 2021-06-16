<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntiqalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intiqals', function (Blueprint $table) {
            $table->id();
            $table->integer('booking_id');
            $table->string('intiqal_no');
            $table->string('intiqal');
            $table->string('intiqal_attachment');
            $table->string('description');
            $table->string('type');
            $table->integer('status');
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
        Schema::dropIfExists('intiqals');
    }
}
