<?php

namespace phamquanglinhdev\Laptrinhluon\Exceptions;

class QueryHandlerException extends \Exception
{
    public function __construct($message = '', $code = 400)
    {
        if (empty($message)) {
            $message = '';
        }

        parent::__construct($message, $code);
    }
}
