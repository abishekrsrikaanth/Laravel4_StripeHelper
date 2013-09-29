<?php

use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration {

	/**
	 * Create the payment_errors table. Hopefully, this doesn't already exist in the database being used.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('orders')) {	
			Schema::create('orders', function($table)
			{
				$table->increments('id');
				$table->integer('user_id');
				$table->string('product_id')->length(50);
				$table->string('currency')->length(50);
				$table->integer('amount');
				$table->string('paid')->length(50);
				$table->timestamps();
			});
		} else {
			throw new Exception('You already have an "orders" table. Delete this table, or temporarily rename it, or edit this package\'s migrations');
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('orders');
	}

}