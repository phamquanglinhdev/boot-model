<?php
/**
 * @return
 * @author Phạm Quang Linh <linhpq@getflycrm.com>
 * @since 12/10/2023 2:11 pm
 */

namespace phamquanglinhdev\Laptrinhluon;

use phamquanglinhdev\Laptrinhluon\Exceptions\PopulatingException;

/**
 * ${PARAM_DOC}
 * @return ${TYPE_HINT}
 * ${THROWS_DOC}
 * @author Phạm Quang Linh <linhpq@getflycrm.com>
 * @since 12/10/2023 2:17 pm
 */
trait Entity
{
    /**
     * @var array
     */
    private $availableProperties = [];

    /**
     * @var array
     */
    private $changedProperties = [];

    /**
     * @var array
     */
    private $commitedProperties = [];

    /**
     * @return array
     * @author Phạm Quang Linh <linhpq@getflycrm.com>
     * @since 12/10/2023 2:17 pm
     */
    public function getAvailableProperties(): array
    {
        return $this->availableProperties;
    }

    /**
     * @return array
     * @author Phạm Quang Linh <linhpq@getflycrm.com>
     * @since 12/10/2023 2:17 pm
     */
    public function getChangedProperties(): array
    {
        return $this->changedProperties;
    }

    /**
     * @return array
     * @author Phạm Quang Linh <linhpq@getflycrm.com>
     * @since 12/10/2023 2:17 pm
     */
    public function getCommitedProperties(): array
    {
        return $this->commitedProperties;
    }

    /**
     * @param array $availableProperties
     * @return void
     * @author Phạm Quang Linh <linhpq@getflycrm.com>
     * @since 12/10/2023 2:17 pm
     */
    public function setAvailableProperties(array $availableProperties): void
    {
        $this->availableProperties = $availableProperties;
    }

    /**
     * @param array $changedProperties
     * @return void
     * @author Phạm Quang Linh <linhpq@getflycrm.com>
     * @since 12/10/2023 2:17 pm
     */
    public function setChangedProperties(array $changedProperties): void
    {
        $this->changedProperties = $changedProperties;
    }

    /**
     * @param array $commitedProperties
     * @return void
     * @author Phạm Quang Linh <linhpq@getflycrm.com>
     * @since 12/10/2023 2:17 pm
     */
    public function setCommitedProperties(array $commitedProperties): void
    {
        $this->commitedProperties = $commitedProperties;
    }

    public function markChange(string $property)
    {
        $this->changedProperties[] = $property;
    }

    /**
     * @param string $property
     * @param string $value
     * @return void
     * @throws PopulatingException
     * @author Phạm Quang Linh <linhpq@getflycrm.com>
     * @since 12/10/2023 2:30 pm
     */
    public function set(string $property, string $value)
    {
        if (! property_exists($this, $property)) {
            throw new PopulatingException("$property not singable in this model");
        }

        $this->{$property} = $value;
    }

    /**
     * @param array $data
     * @return void
     * @throws PopulatingException
     * @author Phạm Quang Linh <linhpq@getflycrm.com>
     * @since 12/10/2023 2:32 pm
     */
    public function populate(array $data = [])
    {
        foreach ($data as $property => $value) {
            $this->set($property, $value);
            $this->markChange($property);
        }
    }

    /**
     * @return array
     * @throws PopulatingException
     * @since 12/10/2023 2:38 pm
     * @author Phạm Quang Linh <linhpq@getflycrm.com>
     */
    public function getAvailableData(): array
    {
        $data = [];
        foreach ($this->availableProperties as $property) {
            if (property_exists($this, $property)) {
                throw new PopulatingException("$property not found in this model");
            }
            $data[$property] = $this->{$property};
        }

        return $data;
    }
}
