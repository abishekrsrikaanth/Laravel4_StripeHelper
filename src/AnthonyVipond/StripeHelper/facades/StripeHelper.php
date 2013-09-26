<?php namespace AnthonyVipond\StripeHelper\Facades;
 
use Illuminate\Support\Facades\Facade;
 
class StripeHelper extends Facade {
 
  /**
   * Get the registered name of the component.
   *
   * @return string
   */
  protected static function getFacadeAccessor() { 
  	return 'stripehelper'; 
  }
 
}