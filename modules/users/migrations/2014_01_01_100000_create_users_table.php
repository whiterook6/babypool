<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(){
		Schema::create('users', function (Blueprint $table) {
			$table->increments('id');
			$table->char('initials', 2)->unique();
			$table->string('email')->unique();
			$table->boolean('enable_notifications')->default(false);
			$table->string('stripe_token')->nullable();
			$table->string('stripe_customer_id')->nullable();
			$table->string('password');
			$table->rememberToken();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(){
		Schema::dropIfExists('users');
	}
}