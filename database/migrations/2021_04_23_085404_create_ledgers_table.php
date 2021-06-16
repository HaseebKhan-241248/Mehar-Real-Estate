<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLedgersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ledgers', function (Blueprint $table) {
            $table->id();
            $table->integer('account_id');
            $table->integer('jv_id')->nullable();
            $table->integer('booking_id')->nullable();
            $table->integer('plot_id')->nullable();
            $table->date('day')->nullable();
            $table->double('debit',15,2)->nullable();
            $table->double('credit',15,2)->nullable();
            $table->string('remarks')->nullable();
            $table->string('type')->nullable();
            $table->string('status')->nullable();
            $table->integer('user_id')->nullable();

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
        Schema::dropIfExists('ledgers');
    }
}
