<?php

namespace phamquanglinhdev\Infrastructure;

use Illuminate\Support\Facades\DB;
use phamquanglinhdev\Laptrinhluon\DomainModel;
use phamquanglinhdev\Laptrinhluon\Exceptions\PopulatingException;

abstract class SQLRepository
{
    protected string $table;

    abstract function setTable(): string;

    /**
     * @param DomainModel $domainModel
     * @return int
     * @throws PopulatingException
     * @author Phạm Quang Linh <linhpq@getflycrm.com>
     * @since 10/14/2023 3:03 PM
     */
    public function insert(DomainModel $domainModel): int
    {
        $data = $domainModel->getAvailableData();

        $isCreated = DB::table($this->table)->insertGetId($data);

        if ($isCreated) {
            $domainModel->setAvailableWhenCreated($data);
        }

        return $isCreated;
    }

    /**
     * @param int $id
     * @param DomainModel $domainModel
     * @return bool
     * @throws PopulatingException
     * @author Phạm Quang Linh <linhpq@getflycrm.com>
     * @since 10/14/2023 2:51 PM
     */
    public function update(int $id, DomainModel $domainModel): bool
    {
        $data = $domainModel->getAvailableData();

        $isUpdated = DB::table($this->table)->where('id', $id)->update($data);

        if ($isUpdated) {
            $domainModel->setCommittedProperties($data);
        }

        return $isUpdated;
    }

    /**
     * @param int $id
     * @return bool
     * @author Phạm Quang Linh <linhpq@getflycrm.com>
     * @since 10/14/2023 3:00 PM
     */
    public function delete(int $id): bool
    {
        return DB::table($this->table)->where("id", $id)->delete();
    }
}
