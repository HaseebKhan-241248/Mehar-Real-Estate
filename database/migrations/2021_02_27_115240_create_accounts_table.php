<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('account_name')->nullable();
            $table->string('account_type')->nullable();
            $table->string('sub_account_type')->nullable();
            $table->string('description')->nullable();
            $table->string('vat_code')->nullable();
            $table->integer('parent_id')->nullable();
            $table->string('note')->nullable();
            $table->string('open_bal')->nullable();
            $table->date('day')->nullable();
            $table->string('status')->nullable();
            $table->integer('fixed')->nullable();
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
        Schema::dropIfExists('accounts');
    }
}
