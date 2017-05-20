<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBidsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('bids', function (Blueprint $table){
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->date('date');
            $table->integer('value')->unsigned();
            $table->integer('paid')->unsigned()->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->unique(['date', 'user_id']);
            $table->index(['date', 'value']);
            $table->index(['value', 'paid']);
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('bids');
    }
}
