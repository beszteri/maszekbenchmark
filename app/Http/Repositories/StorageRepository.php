<?php


namespace App\Http\Repositories;


use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class StorageRepository extends AbstractRepositories
{
    const TABLE_NAME = "storages";
    const STORAGES = ['ssd', 'hdd'];


    public function getSpecificGeneratedParts(int $id, string $partType): ?Collection
    {
        if (!in_array($partType, self::STORAGES)) {
            return null;
        }
        return $this->getQueryBuilder()->where('storageid', '=', $id)->get([
            '*',
            DB::raw('round(score) as score'),
        ]);
    }
}
