<?php
/**
 * @return
 * @author Phạm Quang Linh <linhpq@getflycrm.com>
 * @since 12/10/2023 2:11 pm
 */

namespace phamquanglinhdev\Laptrinhluon;

use phamquanglinhdev\Laptrinhluon\Exceptions\PopulatingException;

/**
 * @author Phạm Quang Linh <linhpq@getflycrm.com>
 * @since 10/14/2023 2:09 PM
 */
trait Entity
{

    //************************ Identity ****************************

    private $primaryKey = "id";

    public function primaryKey(): string
    {
        return $this->primaryKey;
    }

    public function setPrimaryKey(string $primaryKey): void
    {
        $this->primaryKey = $primaryKey;
    }

    //************************ State properties ****************************

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
    private $committedProperties = [];

    /**
     * @return array
     * @author Phạm Quang Linh <linhpq@getflycrm.com>
     * @since 10/14/2023 2:10 PM
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
    public function getCommittedProperties(): array
    {
        return $this->commitedProperties;
    }


//************************ Set state ****************************


    /**
     * @param array $data
     * @return void
     * @throws PopulatingException
     * @since 12/10/2023 2:17 pm
     * @author Phạm Quang Linh <linhpq@getflycrm.com>
     */
    public function setAvailableProperties(array $data = []): void
    {
        foreach ($data as $key => $value) {

            if (!property_exists($this, $key)) {
                throw new PopulatingException("$key not assign in this " . static::class);
            }

            $this->availableProperties[$key] = true;
        }
    }

    /**
     * @param array $data
     * @return void
     * @throws PopulatingException
     * @since 12/10/2023 2:17 pm
     * @author Phạm Quang Linh <linhpq@getflycrm.com>
     */
    public function setChangedProperties(array $data = []): void
    {
        foreach ($data as $key => $value) {

            if (!property_exists($this, $key)) {
                throw new PopulatingException("$key not assign in this " . static::class);
            }

            $this->changedProperties[$key] = true;
        }
    }


    /**
     * @param array $data
     * @return void
     * @throws PopulatingException
     * @since 12/10/2023 2:17 pm
     * @author Phạm Quang Linh <linhpq@getflycrm.com>
     */
    public function setCommittedProperties(array $data = []): void
    {
        foreach ($data as $key => $value) {

            if (!property_exists($this, $key)) {
                throw new PopulatingException("$key not assign in this " . static::class);
            }

            $this->commitedProperties[$key] = true;
        }
    }

//************************ Mark State ****************************

    /**
     * @param string $property
     * @return void
     * @author Phạm Quang Linh <linhpq@getflycrm.com>
     * @since 10/14/2023 2:28 PM
     */
    public function markChange(string $property)
    {
        $this->changedProperties[] = $property;
    }

    /**
     * @param string $property
     * @return void
     * @author Phạm Quang Linh <linhpq@getflycrm.com>
     * @since 10/14/2023 2:28 PM
     */
    public function markAvailable(string $property)
    {
        $this->availableProperties[$property] = true;
        unset($this->changedProperties[$property]);
    }

    /**
     * @param string $property
     * @return void
     * @author Phạm Quang Linh <linhpq@getflycrm.com>
     * @since 10/14/2023 2:28 PM
     */
    public function markCommitted(string $property)
    {
        $this->commitedProperties[$property] = true;
    }

//************************ CheckState ****************************

    /**
     * @param string $property
     * @return bool
     * @author Phạm Quang Linh <linhpq@getflycrm.com>
     * @since 10/14/2023 2:28 PM
     */
    public function isPresent(string $property): bool
    {
        return (property_exists($this, $property));
    }


    /**
     * @param $property
     * @return bool
     * @throws PopulatingException
     * @author Phạm Quang Linh <linhpq@getflycrm.com>
     * @since 10/14/2023 2:28 PM
     */
    public function isEmpty($property): bool
    {
        if (!$this->isPresent($property)) {
            throw new PopulatingException("$property not assign in this " . static::class);
        }

        return !empty($this->{$property});
    }

    /**
     * @param $property
     * @return bool
     * @throws PopulatingException
     * @author Phạm Quang Linh <linhpq@getflycrm.com>
     * @since 10/14/2023 2:28 PM
     */
    public function isChanged($property): bool
    {
        if (!$this->isPresent($property)) {
            throw new PopulatingException("$property not assign in this " . static::class);
        }

        return isset($this->changedProperties[$property]);
    }

    /**
     * @param $property
     * @return bool
     * @throws PopulatingException
     * @author Phạm Quang Linh <linhpq@getflycrm.com>
     * @since 10/14/2023 2:28 PM
     */
    public function isAvailable($property): bool
    {
        if (!$this->isPresent($property)) {
            throw new PopulatingException("$property not assign in this " . static::class);
        }

        return isset($this->availableProperties[$property]);
    }

    /**
     * @param $property
     * @return bool
     * @throws PopulatingException
     * @author Phạm Quang Linh <linhpq@getflycrm.com>
     * @since 10/14/2023 2:28 PM
     */
    public function isCommitted($property): bool
    {
        if (!$this->isPresent($property)) {
            throw new PopulatingException("$property not assign in this " . static::class);
        }

        return isset($this->availableProperties[$property]);
    }

//************************ CheckState ****************************

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
        if (!property_exists($this, $property)) {
            throw new PopulatingException("$property not singable in this model");
        }

        $this->{$property} = $value;
        $this->markChange($property);
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
