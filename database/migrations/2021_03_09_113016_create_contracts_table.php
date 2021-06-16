<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->date('day')->nullable();
            $table->integer('customer_id')->nullable();
            $table->string('customer_contact')->nullable();
            $table->integer('project_id')->nullable();
            $table->integer('sector_id')->nullable();
            $table->integer('block_id')->nullable();
            $table->integer('plot_id')->nullable();
            $table->integer('size')->nullable();
            $table->double('intiqal_g',15,2)->nullable();
            $table->double('intiqal_a',15,2)->nullable();
            $table->double('intiqal_diff',15,2)->nullable();
            $table->double('received',15,2)->nullable();
            $table->double('partner_amount',15,2)->nullable();
            $table->double('partner_amount_a',15,2)->nullable();
            $table->double('equity_difference',15,2)->nullable();
            $table->double('agreed_price',15,2)->nullable();
            $table->double('remaining_amount',15,2)->nullable();
            $table->double('rate_marla',15,2)->nullable();
            $table->string('dp_per')->nullable();
            $table->double('dealer_id',15,2)->nullable();
            $table->double('dealer_commision_per',15,2)->nullable();
            $table->double('dealer_commision_value',15,2)->nullable();
            $table->double('coms_formula',15,2)->nullable();
            $table->double('dealer_commision_due',15,2)->nullable();
            $table->double('dealer_comsvalue',15,2)->nullable();
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
        Schema::dropIfExists('contracts');
    }
}
