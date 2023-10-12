<?php
/**
 * @return
 * @author Phạm Quang Linh <linhpq@getflycrm.com>
 * @since 12/10/2023 2:11 pm
 */

namespace phamquanglinhdev\Laptrinhluon;

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

}
