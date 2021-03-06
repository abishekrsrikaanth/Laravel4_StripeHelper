<?php namespace AnthonyVipond\StripeHelper;

use \Config;
use \Payment_Error;
use \Stripe_Charge;
use \Stripe_Customer;

class StripeHelper {

	public static function api_key() {
		return Config::get('packages/AnthonyVipond/StripeHelper/stripe.api_key');
	}

	public static function pub_key() {
		return Config::get('packages/AnthonyVipond/StripeHelper/stripe.pub_key');
	}

	public static function currency() {
		return Config::get('packages/AnthonyVipond/StripeHelper/stripe.currency');
	}

    /**
     * charge_card
     *
     * Charge the customer's card using the id property of customer object
     *
     * @return object on success, false on failure
     */
	public static function charge_card($email, $customer_id, $price_in_cents, &$message  = '')
    {
        try {
            $charge = Stripe_Charge::create(array(
            "amount"   => $price_in_cents,
            "currency" => self::currency(),
            "customer" => $customer_id)
            );
            return $charge;
        } catch (Stripe_CardError $e) {
            // Since it's a decline, Stripe_CardError will be caught
            $message = 'Error 1: Sorry! The card was declined!';
            Payment_Error::log_payment_error($e, $email);
            return false;
        } catch (Stripe_InvalidRequestError $e) {
            // Invalid parameters were supplied to Stripe's API
            // Using an unaccepted currency will trigger this
            $message = 'Error 2: Sorry! There was a problem with the credit card data.';
            Payment_Error::log_payment_error($e, $email);
            return false;
        } catch (Stripe_AuthenticationError $e) {
            // Authentication with Stripe's API failed
            // (maybe you changed API keys recently)
            $message = 'Error 3: Sorry! Card Authentication Problems.';
            Payment_Error::log_payment_error($e, $email);
            return false;
        } catch (Stripe_ApiConnectionError $e) {
            // Network communication with Stripe failed
            $message = 'Error 4: Sorry! A network error occured.';
            Payment_Error::log_payment_error($e, $email);
            return false;
        } catch (Stripe_Error $e) {
            // Display a very generic error to the user, and maybe send
            // yourself an email
            $message = 'Error 5: Sorry! Unable to process an order.';
            Payment_Error::log_payment_error($e, $email);
            return false;
        } catch (Exception $e) {
            // Something else happened, completely unrelated to Stripe
            $message = 'Error 6: Sorry! Something unrelated to your credit card went wrong.';
            Payment_Error::log_payment_error($e = 'not_stripe', $email);
            return false;
        }
	}

    /**
     * create_customer
     *
     * Create the customer object using the Stripe token
     *
     * @return object on success, false on failure
     */
	public static function create_customer($email, $stripe_token, &$message = '')
    {
        try {
            $customer = Stripe_Customer::create(array(
                "card" => $stripe_token,
                "description" => $email
            ));
            return $customer;
        } catch (Stripe_CardError $e) {
            // Since it's a decline, Stripe_CardError will be caught
            $message = 'Error 7: Sorry! The card was declined!';
            Payment_Error::log_payment_error($e, $email);
            return false;
        } catch (Stripe_InvalidRequestError $e) {
            // Invalid parameters were supplied to Stripe's API
            // Using an unaccepted currency will trigger this
            $message = 'Error 8: Sorry! There was a problem with the credit card data.';
            Payment_Error::log_payment_error($e, $email);
            return false;
        } catch (Stripe_AuthenticationError $e) {
            // Authentication with Stripe's API failed
            // (maybe you changed API keys recently)
            $message = 'Error 9: Sorry! Card Authentication Problems.';
            Payment_Error::log_payment_error($e, $email);
            return false;
        } catch (Stripe_ApiConnectionError $e) {
            // Network communication with Stripe failed
            $message = 'Error 10: Sorry! A network error occured.';
            Payment_Error::log_payment_error($e, $email);
            return false;
        } catch (Stripe_Error $e) {
            // Display a very generic error to the user, and maybe send yourself an email
            $message = 'Error 11: Sorry! Unable to process an order.';
            Payment_Error::log_payment_error($e, $email);
            return false;
        } catch (Exception $e) {
            // Something else happened, completely unrelated to Stripe
            $message = 'Error 12: Sorry! Something unrelated to your credit card went wrong.';
            Payment_Error::log_payment_error($e = 'not_stripe', $email);
            return false;
        }
	}
 
}