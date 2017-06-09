<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(){
		Schema::create('payments', function (Blueprint $table){
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->float('amount', 7, 2)->unsigned();
			$table->boolean('captured');
			$table->string('status');
			$table->integer('stripe_created')->unsigned();
			$table->string('stripe_balance_transaction_id');
			$table->string('stripe_charge_id');
			$table->json('stripe_data')->nullable();
			$table->timestamps();

			$table->foreign('user_id')->references('id')->on('users');

			$table->index('created_at');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(){
		Schema::dropIfExists('payments');
	}
}
