<?php


namespace App\Http\Repositories;


use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ComputerRepositories
{
    public function saveComputerToDb($arrayToInsert)
    {
        DB::table('computers')->insert($arrayToInsert);
    }

    public function countComputers()
    {
        return DB::table('computers')->count();
    }

    public function findHardware($model)
    {
        return DB::table('computers')->where('model', '=', $model);
    }

    public function findHddById($id)
    {
        return DB::table('computers')->where('hdd_ids', 'like', "%$id%")->get();
    }

    public function findSsdById($id)
    {
        return DB::table('computers')->where('ssd_ids', 'like', "%$id%")->get();
    }

    public function getSpecificGeneratedCpu($id)
    {
        return DB::table('computers')->where('cpu_id', '=', $id)->get([
            '*',
            DB::raw('round(cpu_score) as cpu_score'),
        ]);
    }

    public function getSpecificGeneratedGpu($id)
    {
        return DB::table('computers')->where('gpu_id', '=', $id)->get([
            '*',
            DB::raw('round(gpu_score) as gpu_score'),
        ]);
    }

    public function getSpecificGeneratedRam($id)
    {
        return DB::table('computers')->where('ram_id', '=', $id)->get([
            '*',
            DB::raw('round(ram_score) as ram_score'),
        ]);
    }


}
