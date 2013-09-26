StripeHelper for Laravel 4
==============

### THIS PACKAGE IS UNDER DEVELOPMENT. NOT READY YET FOR USAGE.

Requires the Stripe.com PHP Library and a helper class for Stripe properties and methods. More to come.


### Installation

Include stripehelper as a dependency in composer.json:

~~~
"anthonyvipond/stripehelper": "dev-master"
~~~

Run `composer install` to download the dependency.

Add the ServiceProvider to your provider array within `app/config/app.php`:

~~~
'providers' => array(

    'AnthonyVipond\StripeHelper\StripeHelperServiceProvider'

)
~~~

Publish the configuration files via `php artisan config:publish anthonyvipond/stripehelper`.


### Configuration

Once you have published the configuration files, you can set your API and Publishable Key in `app/config/packages/anthonyvipond/stripehelper/stripe.php`:
If are Canadian, Irish, or English, update your currency here as necessary.

~~~
<?php
return array(
	'api_key' 			=> 'place_api_key_here',
	'publishable_key' 	=> 'place_publishable_key_here',
	'currency'			=> 'usd',
);