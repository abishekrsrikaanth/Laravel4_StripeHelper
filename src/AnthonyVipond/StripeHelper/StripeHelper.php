<?php namespace AnthonyVipond\StripeHelper;
 
class StripeHelper {

	public static $api_key  = Config::get('stripe.secret_key');

	public static $pub_key  = Config::get('stripe.publishable_key');

	public static $currency = Config::get('stripe.currency');
 
}