<?php

use Illuminate\Database\Migrations\Migration;

class CreateCreditCardsTable extends Migration {

	/**
	 * Create the credit_cards table. Hopefully, this doesn't already exist in the database being used.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('users')) {	
			Schema::create('credit_cards', function($table)
			{
			    $table->increments('id');

			    $table->integer('user_id'); 
			    // The foreign key that links this row with a user in your users table. If your users table is not named 'users', update this.

				$table->string('customer_id'); 
				// This needs to be provided in order to charge a user's card, if charging based on the customer_id, which is standard.

				$table->string('last4');
				$table->string('type'); 
				// E.g. Mastercard, Visa, etc.

				$table->string('fingerprint'); 
				// The only unique identifier of a particular card as customer_id changes with each request despite using the same card.

				$table->string('country');

				$table->string('cvc_check'); 
				// E.g. 'pass'

				$table->integer('exp_month');
				$table->integer('exp_year');
				$table->timestamps();
			});
		} else {
			throw new Exception('You already have a "credit_cards" table. Delete this table, or temporarily rename it, then install this package again');
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('credit_cards');
	}

}