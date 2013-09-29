<?php

class PurchaseController extends BaseController {

	public function purchase()
	{
		return View::make('purchase');
	}

	public function process()
	{

		if (Auth::check()) {
			$user = Auth::user();
		}

		// This holds a token from Stripe which is a reference to the credit card stored on Stripe's servers.
		$token = Input::get('stripeToken');

		// You should send the email address of user to Stripe. Its a kind of human-readable identifier for you.
		$email = Input::get('email');

		// Initiate an empty message variable to pass through to methods. It will be updated with error messages if there was a problem.
		$message = '';

		// The amount you want to charge, in cents.
		$total_in_cents = 500;


	    // returns customer object on success, false on failure
		$customer = StripeHelper::create_customer($email, $stripe_token, $message);

		if ($customer) {

		    // returns charge object on success, false on failure
			$charge = StripeHelper::charge_card($email, $customer->id, $total_in_cents, $message);

			if ($charge->paid) {
				// Store the order in an `orders` table
				// Assuming this table has `id` column (AI, PK), this will be the foreign key in credit_cards table (see below)
				$order = Order::create(array(
					'user_id'		=> isset($user->id) ? $user->id : 'N/A', // Foreign key for users table
					'product_id'	=> 'Your product id here', // Foreign key for your products table
                    'currency'  	=> $charge->currency,
                    'amount'    	=> $charge->amount,
                    'paid'    		=> (string)$charge->paid,
                ));

                if ($order) {
                	// Store the credit card usage in a `credit_cards` table
                	$card = Credit_card::create(array(
	                    'order_id' 		=> $order->id, // Foreign key for orders table
						'user_id'		=> isset($user->id) ? $user->id : 'N/A', // Foreign key for users table
	                    'processor' 	=> 'stripe',
	                    'charge_id'		=> $charge->id,
	                    'card_id'		=> $charge->card->id, // this changes with every charge, despite using the same card
	                    'last4'			=> $charge->card->last4,
	                    'type'			=> $charge->card->type,
	                    'exp_month'		=> $charge->card->exp_month,
	                    'exp_year'		=> $charge->card->exp_year,
	                    'fingerprint'	=> $charge->card->fingerprint, // this is a constant, unique identifer of a given credit card
                	));
                }      
			}
		}
	}

}