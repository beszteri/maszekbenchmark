<?php


namespace App\Http\Repositories;


use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class HardwareRepositories extends AbstractRepositories
{
    const TABLE_NAME = "hardwares";

    public function getAllDataFromHardwares() :Collection
    {
        return $this->getQueryBuilder()->get();
    }

    public function getSearchedData($query)
    {
        return $this->getQueryBuilder()->where('model', 'like', "%$query%")->get();
    }

    public function getIntelCpus() :Collection
    {
        return $this->getQueryBuilder()->where('part', '=', 'CPU')
            ->where('brand', '=', 'Intel')->get();
    }

    public function getStorages() :Collection
    {
        return $this->getQueryBuilder()->where('part', '=', 'SSD')->where('part','=', 'HDD')->get();
    }

    public function getSpecificHardwares($partType): Collection
    {
        return $this->getQueryBuilder()->where('part', '=', $partType)->get();
    }

    public function findHardwareById($id)
    {
        return $this->getQueryBuilder()->where('id', '=', $id)->get();
    }
}
