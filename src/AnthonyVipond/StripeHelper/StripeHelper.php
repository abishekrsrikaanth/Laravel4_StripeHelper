<?php namespace AnthonyVipond\StripeHelper;

use \Config;
 
class StripeHelper {

	public static $api_key;

	public static $pub_key;

	public static $currency;

	public function __construct() {

		static::$api_key  = Config::get('stripe.api_key');
		static::$pub_key  = Config::get('stripe.publishable_key');
		static::$currency = Config::get('stripe.currency');
	}
 
}