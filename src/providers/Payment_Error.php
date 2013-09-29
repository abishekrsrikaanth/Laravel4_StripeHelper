<?php

class Payment_Error extends Eloquent
{

    public static function log_payment_error($error, $email)
    {
        if ($error == 'not_stripe') {
            $message = 'Payment error not related to credit card';

            Payment_Error::create(array(
                                    'email'     => $email,
                                    'type'      => '',
                                    'code'      => '',
                                    'param'     => '',
                                    'message'   => $message,
                                    'date'      => New Datetime
                                ));
            return $message;
        } else {
            $body = $error->getJsonBody();
            $err  = $body['error'];

            $type    = isset($err['type']) ? $err['type'] : 'N/A';
            $code    = isset($err['code']) ? $err['code'] : 'N/A';
            $param   = isset($err['param']) ? $err['param'] : 'N/A';
            $message = isset($err['message']) ? $err['message'] : 'N/A';

            Payment_Error::create(array(
                                    'email'     => $email,
                                    'type'      => $type,
                                    'code'      => $code,
                                    'param'     => $param,
                                    'message'   => $message,
                                    'date'      => New Datetime
                                ));
            return $message;
        } 
    }
}