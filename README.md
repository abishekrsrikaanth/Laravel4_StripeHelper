StripeHelper for Laravel 4
==============

Requires the Stripe.com PHP Library and a helper class for Stripe properties and methods. More to come.


### Installation

1. Include stripehelper as a dependency in composer.json:

~~~
"anthonyvipond/stripehelper": "dev-master"
~~~

2. Run `composer install` to download the dependency.

3. Add the ServiceProvider to your provider array within `app/config/app.php`:

~~~
'providers' => array(

    'AnthonyVipond\StripeHelper\StripeHelperServiceProvider'

)
~~~

4. Publish the configuration files via `php artisan config:publish anthonyvipond/stripehelper`.


### Publish Javascript Assets

~~~

php artisan asset:publish anthonyvipond/stripehelper

~~~


### Include Javascript Assets

~~~

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="/stripehelper.js"></script>

~~~


### Update Values in StripeHelper.js

Update them in YOUR public folder. Not the VENDOR one, which is overwritten when you 'composer update'

There are three lines, they are marked clearly with comments. Update them as necessary.


### Run Migrations

~~~

php artisan migrate --package="anthonyvipond/stripehelper"

~~~


### Configuration

Once you have published the configuration files, you can set your API and Publishable Key in `app/config/packages/anthonyvipond/stripehelper/stripe.php`:
If are Canadian, Irish, or English, update your currency here as necessary.

~~~

return array(
	'api_key' 			=> 'place_api_key_here',
	'publishable_key' 	=> 'place_publishable_key_here',
	'currency'			=> 'usd',
);

### How to Use

Some convenient static methods you can use globally:

~~~

StripeHelper::api_key() // Get your secret key

StripeHelper::pub_key() // Get your publishable key

StripeHelper::currency() // Get the currency you are charging in

~~~

~~~

StripeHelper::create_customer( $stripe_token, $email, &$message = '' )
// Create a customer object from a Stripe token
// You can initialize a $message var prior to calling this if you want a user-friendly error message for users
// This returns the customer object on success, and return FALSE on failure.
// Prior to returning false, it logs the error information to your database.

StripeHelper::charge_card( $price_in_cents, $customer_id, &$message = '', $email )
// Charges a credit card based on a customer_id passed to it
// You can initialize a $message var prior to calling this if you want a user-friendly error message for users
// This returns the charge object on success, and return FALSE on failure.
// Prior to returning false, it logs the error information to your database.

~~~