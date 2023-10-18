<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pays', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('addmember_id');
            $table->unsignedBigInteger('setdeposit_id');
            $table->double('amount');
            $table->string('type');
            

            $table->timestamps();

            $table->foreign('addmember_id')->references('id')->on('addmembers')->onDelete('cascade');
            $table->foreign('setdeposit_id')->references('id')->on('setdeposits')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pays');
    }
}
