<?php

namespace phamquanglinhdev\Laptrinhluon;

use phamquanglinhdev\Laptrinhluon\Exceptions\ConditionPopulatingExceptions;
use phamquanglinhdev\Laptrinhluon\Exceptions\QueryHandlerException;

/**
 * @author Phạm Quang Linh <linhpq@getflycrm.com>
 * @since 10/14/2023 3:39 PM
 */
class QueryHandler
{

    public const DEFAULT_OFFSET = 1;
    public const DEFAULT_LIMIT = 1;
    /**
     * @var string[]
     */
    private $fields = ["*"];

    /**
     * @var array
     */
    private $customField = [];

    /**
     * @var array
     */
    private $filtering = [];

    /**
     * @var int
     */
    private $limit = self::DEFAULT_LIMIT;

    /**
     * @var int
     */
    private $offset = self::DEFAULT_OFFSET;

    /**
     * @param array $data
     * @return void
     * @throws QueryHandlerException
     * @author Phạm Quang Linh <linhpq@getflycrm.com>
     * @since 10/14/2023 3:25 PM
     */
    public function populate(array $data)
    {
        foreach ($data as $key => $value) {
            if (!property_exists($this, $key)) {
                throw new QueryHandlerException("$key not exist in queryHandler");
            }

        }
    }

    /**
     * @return array
     * @throws ConditionPopulatingExceptions
     * @author Phạm Quang Linh <linhpq@getflycrm.com>
     * @since 10/14/2023 3:39 PM
     */
    public function getParams(): array
    {
        return [
            'fields' => $this->fields,
            'custom_field' => $this->customField,
            'limit' => $this->limit,
            'offset' => $this->offset,
            'conditions' => $this->getCondition($this->filtering),
        ];

    }

    /**
     * @param array $filtering
     * @return array
     * @throws ConditionPopulatingExceptions
     * @author Phạm Quang Linh <linhpq@getflycrm.com>
     * @since 10/14/2023 3:39 PM
     */
    private function getCondition(array $filtering): array
    {
        $conditions = [];

        foreach ($filtering as $key => $value) {

            $field = explode($key, ".")[0];

            $equal = explode($key, ".")[1];

            $condition = [
                'field' => $field,
                'equal' => $this->transEqual($equal),
                'value' => $value
            ];

            $conditions[] = $condition;
        }

        return $conditions;
    }

    /**
     * @param $rawEqual
     * @return string
     * @throws ConditionPopulatingExceptions
     * @author Phạm Quang Linh <linhpq@getflycrm.com>
     * @since 10/14/2023 3:39 PM
     */
    private function transEqual($rawEqual): string
    {
        $rawEquals = [
            "lt", "mt", "lte", "mte", "in", "contains", "eq",
        ];
        $transEquals = [
            "<", ">", "<=", ">=", "in", "like", "=",
        ];

        foreach ($rawEquals as $key => $equal) {
            if ($rawEqual === $equal) {
                return $transEquals[$key];
            }
        }
        throw new ConditionPopulatingExceptions("$rawEqual not found in equal list");
    }

}
