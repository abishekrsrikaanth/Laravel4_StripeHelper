##StripeHelper for Laravel 4
==============

Requires the Stripe.com PHP Library and has a class for working with Stripe. Comes with sample controller and view, too!


### Installation

* Include stripehelper as a dependency in composer.json:

~~~
"anthonyvipond/stripehelper": "dev-master"
~~~

* Run `composer install` to download the dependency.

* Add the ServiceProvider to your provider array within `app/config/app.php`:

~~~
'providers' => array(

    'AnthonyVipond\StripeHelper\StripeHelperServiceProvider'

)
~~~

### Publish Configuration Files

~~~

php artisan config:publish anthonyvipond/stripehelper

~~~


### Publish Javascript Assets

~~~

php artisan asset:publish anthonyvipond/stripehelper

~~~


### Include Javascript Assets within your `<head>` tags

If you don't have a working project yet, skip this part, and scroll down to the next step.

~~~

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="/packages/anthonyvipond/stripehelper/stripehelper.js"></script>

~~~


### Update Values in StripeHelper.js

Update them in YOUR public folder version (packages/anthonyvipond/stripehelper/StripeHelper.js)

Not the VENDOR one, which is overwritten when you 'composer update'

The most important being: Stripe.setPublishableKey('Your_Publishable_Key_Goes_Here');

Check the commented lines. Update them as necessary.


### Run Migrations (optional)

Note on Migrations:

You must not have tables currently named `credit_cards`, `orders` or `payment_errors` in your database.
If you do, that's fine, just change the migration table names/fields in /vendor/anthonyvipond/stripehelper/src/migrations as necessary.
You can also choose to not run migrations at all if you do not want any database help.

~~~

php artisan migrate --package="anthonyvipond/stripehelper"

~~~


### Configuration

Once you have published the configuration files, you can set your API and Publishable Key in `/app/config/packages/anthonyvipond/stripehelper/stripe.php`:

If are Canadian, Irish, or English, update your currency here as necessary.

~~~

return array(
	'api_key' 			=> 'place_api_key_here',
	'publishable_key' 	=> 'place_publishable_key_here',
	'currency'			=> 'usd',
);

~~~


### Methods for creating customers and charging cards

~~~

StripeHelper::create_customer( $email, $stripe_token, &$message = '' );

// Create a customer object from a Stripe token
// You can optionally initialize a $message var prior to calling this if you want a user-friendly error message for users
// This returns the customer object on success, and return FALSE on failure.
// Prior to returning false, it logs the error information to your database.

StripeHelper::charge_card( $email, $customer_id, $price_in_cents, &$message = '' );

// Charges a credit card based on a customer_id passed to it
// You can optionally initialize a $message var prior to calling this if you want a user-friendly error message for users
// This returns the charge object on success, and return FALSE on failure.
// Prior to returning false, it logs the error information to your database.

~~~

### Sample Controller, View, and Route methods to get you rolling

* Copy from /vendors/AnthonyVipond/src/Controllers/PurchaseController.php into your app/controller/PurchaseController.php

* Copy from /vendors/AnthonyVipond/src/Views/purchase.blade.php into your app/views/purchase.blade.php

* Copy route invocations from /vendors/AnthonyVipond/src/routes.php into your routes.php



### Review all package code inside:

* AnthonyVipond/StripeHelper/src

* AnthonyVipond/StripeHelper/public