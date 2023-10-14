<?php

namespace phamquanglinhdev\Laptrinhluon;

use Illuminate\Database\Eloquent\Model;

class DomainModel extends Model
{
    use Entity;
    public function setAvailableWhenCreated(array $data): void
    {
        foreach ($data as $key => $value) {
            $this->markAvailable($key);
        }
    }

    public function setCommittedPropertiesWhenUpdated(array $data): void
    {
        foreach ($data as $key => $value) {
            $this->markCommitted($key);
        }
    }
}
