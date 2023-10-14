<?php

namespace phamquanglinhdev\Laptrinhluon;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

/**
 * @author Phạm Quang Linh <linhpq@getflycrm.com>
 * @since 10/14/2023 3:17 PM
 */
class ParamHandler
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }


    /**
     * @param array $rules
     * @return void
     * @throws ValidationException
     * @author Phạm Quang Linh <linhpq@getflycrm.com>
     * @since 10/14/2023 3:17 PM
     */
    public function handlerValidate(array $rules = [])
    {
        $validation = Validator::make($this->data, $rules);

        if ($validation->fails()) {
            throw new ValidationException($validation);
        }
    }

    /**
     * @return array
     * @author Phạm Quang Linh <linhpq@getflycrm.com>
     * @since 10/14/2023 3:17 PM
     */
    public function getData(): array
    {
        return $this->data;
    }

}
