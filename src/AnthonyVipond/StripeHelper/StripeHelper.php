<?php namespace AnthonyVipond\StripeHelper;

use \Config;

class StripeHelper {

	public static function api_key() {
		return Config::get('stripehelper::api_key');
	}

	public static function pub_key() {
		return Config::get('stripehelper::publishable_key');
	}

	public static function currency() {
		return Config::get('stripehelper::currency');
	}
 
}