<?php
/**
 * @return
 * @author Phạm Quang Linh <linhpq@getflycrm.com>
 * @since 12/10/2023 2:27 pm
 */

namespace phamquanglinhdev\Laptrinhluon\Exceptions;

use Throwable;

class PopulatingException extends \Exception
{
    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        if (empty($message)) {
            $message = 'invalid field exception';
        }

        parent::__construct($message, $code, $previous);
    }
}
