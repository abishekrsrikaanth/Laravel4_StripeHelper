<?php namespace AnthonyVipond\StripeHelper;

use Illuminate\Support\ServiceProvider;

include 'dependencies/stripe-php-1.8.3/lib/Stripe.php';

class StripeHelperServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('anthonyvipond/stripehelper');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['stripehelper'] = $this->app->share(function($app)
		{
			return new StripeHelper;
		});

		$this->app->booting(function()
		{
			$loader = \Illuminate\Foundation\AliasLoader::getInstance();
			$loader->alias('StripeHelper', 'AnthonyVipond\StripeHelper\Facades\StripeHelper');
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('stripehelper');
	}

}