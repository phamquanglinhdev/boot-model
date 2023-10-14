<?php

namespace phamquanglinhdev\Laptrinhluon\Exceptions;

class ConditionPopulatingExceptions extends \Exception
{
    public function __construct($message = "", $code = 400)
    {
        parent::__construct($message, $code);
    }
}
