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
            $table->integer('bidder_id')->unsigned();
            $table->date('date');
            $table->integer('value')->unsigned();
            $table->enum('status', [
                'unconfirmed',
                'confirmed',
                'paid',
                'cancelled'
            ]);
            $table->timestamps();

            $table->foreign('bidder_id')->references('id')->on('bidders');
            $table->index(['date', 'value']);
            $table->index('status');
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
