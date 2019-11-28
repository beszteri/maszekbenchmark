<?php


namespace App\Http\Repositories;


use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ComputerRepositories extends AbstractRepositories
{
    const COMPUTER_PARTS = ['cpu', 'gpu', 'ram'];
    const TABLE_NAME = "computers";

    public function countComputers()
    {
        return $this->getQueryBuilder()->count();
    }

    /*public function getSpecificGeneratedParts(int $id, string $partType): ?Collection
    {
        if (!in_array($partType, array_merge(self::STORAGES, self::COMPUTER_PARTS))) {
            return null;
        }

        if (in_array($partType, self::STORAGES)) {
            $tableName = 'storages';
        } else {
            $tableName = 'computers';
        }

        return DB::table($tableName)->where($partType . '_id', '=', $id)->get([
            '*',
            DB::raw('round(' . $partType . '_score) as score'),
        ]);
    }*/

    public function getSpecificGeneratedParts(int $id, string $partType): ?Collection
    {
        if (!in_array($partType, self::COMPUTER_PARTS)) {
            return null;
        }
        return $this->getQueryBuilder()->where($partType . '_id', '=', $id)->get([
            '*',
            DB::raw('round(' . $partType . '_score) as score'),
        ]);
    }
}
