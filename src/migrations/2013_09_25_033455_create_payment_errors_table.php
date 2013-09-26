<?php

use Illuminate\Database\Migrations\Migration;

class CreatePaymentErrorsTable extends Migration {

	/**
	 * Create the payment_errors table. Hopefully, this doesn't already exist in the database being used.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('payment_errors')) {	
			Schema::create('payment_errors', function($table)
			{
				$table->increments('id');
				$table->string('email')->length(255);
				$table->string('type')->length(255);
				$table->text('code');
				$table->text('param');
				$table->text('message');
				$table->date('date');
			});
		} else {
			throw new Exception('You already have a "payment_errors" table. Delete this table, or temporarily rename it, then install this package again');
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('payment_errors');
	}

}