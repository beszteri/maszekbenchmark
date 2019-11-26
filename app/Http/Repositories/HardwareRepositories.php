<?php


namespace App\Http\Repositories;


use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class HardwareRepositories
{
    public function getAllDataFromHardwares() :Collection
    {
        return DB::table('hardwares')->get();
    }

    public function getSearchedData($query)
    {
        return DB::table('hardwares')->where('model', 'like', "%$query%")->get();
    }

    public function findHardwareById($id)
    {
        return DB::table('hardwares')->where('id', '=', $id)->get();
    }

}
