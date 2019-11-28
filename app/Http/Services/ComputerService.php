<?php


namespace App\Http\Services;


use App\Http\Repositories\ComputerRepositories;
use App\Http\Repositories\HardwareRepositories;
use App\Http\Repositories\StorageRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class ComputerService
{
    /**
     * @var ComputerRepositories
     */
    private $computerRepositories;
    /**
     * @var HardwareRepositories
     */
    private $hardwareRepositories;
    /**
     * @var StorageRepository
     */
    private $storageRepository;
    /**
     * ComputerService constructor.
     * @param ComputerRepositories $computerRepositories
     * @param HardwareRepositories $hardwareRepositories
     * @param StorageRepository $storageRepository
     */
    public function __construct(ComputerRepositories $computerRepositories, HardwareRepositories $hardwareRepositories, StorageRepository $storageRepository)
    {
        $this->computerRepositories = $computerRepositories;
        $this->hardwareRepositories = $hardwareRepositories;
        $this->storageRepository = $storageRepository;
    }


    public function generateRandomComputers(){
        $cpus = $this->hardwareRepositories->getSpecificHardwares("CPU");
        $intelCpus = $this->hardwareRepositories->getIntelCpus();
        $gpus = $this->hardwareRepositories->getSpecificHardwares("GPU");
        $rams = $this->hardwareRepositories->getSpecificHardwares("RAM");
        $storages = $this->hardwareRepositories->getStorages();

        for ($i = 0; $i < 100000; $i++) {
            $cpu = $cpus->random();
            $cpuScore = $cpu->score * $this->scoreDifference();
            $gpu = $gpus->random();
            $gpuScore = $gpu->score * $this->scoreDifference();
            if ($cpu->part === 'AMD' && $gpu->part === 'Intel') {
                $cpu = $intelCpus->random();
                $cpuScore = $cpu->score * $this->scoreDifference();
            }
            $ram = $rams->random();
            $ramScore = $ram->score * $this->scoreDifference();
            $storageToIns=$this->makeStorageToIns($storages);
            $compArrToInsert = ['cpu_id' => $cpu->id, 'cpu_score' => $cpuScore, 'gpu_id' => $gpu->id,
                'gpu_score' => $gpuScore, 'ram_id' => $ram->id, 'ram_score' => $ramScore];
            $compId = $this->computerRepositories->saveDataToDb($compArrToInsert);
            foreach ($storageToIns as $storage) {
                $storage['compid'] = $compId;
                $this->storageRepository->saveDataToDb($storage);
            }

        }
    }

    public function scoreDifference() :int
    {
        return rand(900, 1100) / 1000;
    }

    private function makeStorageToIns(Collection $storages) :array
    {
        $storageToIns = [];
        $storageNumber = rand(1, 5);
        for ($s = 1; $s <= $storageNumber; $s++) {
            $storage = $storages->random();
            $scoreDifference = rand(900, 1100) / 1000;
            $storageScore = $storage->score * $scoreDifference;
            $storageToIns[] = [
                'storageid' => $storage->id,
                'score' => $storageScore,
            ];
        }
        return $storageToIns;
    }

    public function countComputers()
    {
        return $this->computerRepositories->countComputers();
    }

    public function findHardware($model)
    {
        return $this->computerRepositories->findHardware($model);
    }

    public function runATest() :array
    {
        $scoreDifference = rand(900, 1100) / 1000;
        $gpuScore = Session::get('GPU')[4];
        $cpuScore = Session::get('CPU')[4];
        $ramScore = Session::get('RAM')[4];
        $hddScore = Session::get('HDD')[4];
        $ssdScore = Session::get('SSD')[4];
        $higherStorageScore = $hddScore;
        if ($ssdScore > $higherStorageScore) {
            $higherStorageScore = $ssdScore;
        }
        $gamerScore = ($cpuScore * 0.3 + $gpuScore * 0.5 + $ramScore * 0.1 + $higherStorageScore * 0.1) * $scoreDifference;
        $desktopScore = ($cpuScore * 0.3 + $gpuScore * 0.1 + $ramScore * 0.3 + $higherStorageScore * 0.3) * $scoreDifference;
        $workstationScore = ($cpuScore * 0.5 + $gpuScore * 0.1 + $ramScore * 0.2 + $higherStorageScore * 0.2) * $scoreDifference;
        $data = ['gamerScore' => $gamerScore, 'desktopScore' => $desktopScore, 'workstationScore' => $workstationScore];
        return $data;
    }
}
