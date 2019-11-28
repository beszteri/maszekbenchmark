<?php


namespace App\Http\Repositories;


use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Integer;

abstract class AbstractRepositories
{
    const TABLE_NAME = null;

    protected function getQueryBuilder(): Builder
    {
        assert(static::TABLE_NAME !== null);
        return DB::table(static::TABLE_NAME); //static ?
    }

    public function saveDataToDb(array $arrayToInsert): int
    {
        return $this->getQueryBuilder()->insertGetId($arrayToInsert);
    }

    //public abstract function getSpecificGeneratedPart(int $id, string $partType): ?Collection;

}
