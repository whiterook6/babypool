<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePiratesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pirates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->timestamps();

            $table->unique('email');
            $table->index('created_at');
        });

        Schema::create('bids', function (Blueprint $table){
            $table->increments('id');
            $table->integer('pirate_id')->unsigned();
            $table->date('date');
            $table->integer('value')->unsigned();
            $table->timestamps();

            $table->foreign('pirate_id')->references('id')->on('pirates');
            $table->index(['date', 'value']);
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bids');
        Schema::dropIfExists('pirates');
    }
}
