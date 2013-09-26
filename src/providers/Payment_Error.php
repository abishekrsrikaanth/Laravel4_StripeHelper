<?php

class Payment_Error extends Eloquent
{
	public static $timestamps = false;

	public static function log_payment_error($error, $email)
    {
        if ($error == 'not_stripe') {
            Payment_Error::create(array(
                                    'email'     => $email,
                                    'type'      => '',
                                    'code'      => '',
                                    'param'     => '',
                                    'message'   => 'Payment error not caused by Stripe',
                                    'date'   	=> New Datetime
                                ));
        } else {
           	$body = $error->getJsonBody();
            $err  = $body['error'];

            Payment_Error::create(array(
                                    'email'     => $email,
                                    'type'      => $err['type'],
                                    'code'      => $err['code'],
                                    'param'     => $err['param'],
                                    'message'   => $err['message'],
                                    'date'   	=> New Datetime
                                )); 
        } 
    }
}