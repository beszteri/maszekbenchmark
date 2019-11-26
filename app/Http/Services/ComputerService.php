<?php


namespace App\Http\Services;


use App\Computer;
use App\Http\Repositories\ComputerRepositories;
use App\Http\Repositories\HardwareRepositories;
use Illuminate\Support\Facades\DB;
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
     * ComputerService constructor.
     * @param ComputerRepositories $computerRepositories
     * @param HardwareRepositories $hardwareRepositories
     */
    public function __construct(ComputerRepositories $computerRepositories, HardwareRepositories $hardwareRepositories)
    {
        $this->computerRepositories = $computerRepositories;
        $this->hardwareRepositories = $hardwareRepositories;
    }


    public function generateRandomComputers(){
        $hardwares = $this->hardwareRepositories->getAllDataFromHardwares();
        $cpus = collect();
        $intelCpus = collect();
        $gpus = collect();
        $rams = collect();
        $ssds = collect();
        $hdds = collect();
        $arrayToInsert = array();
        foreach ($hardwares as $hardware)
        {
            if ($hardware->part === 'CPU' && $hardware->brand === 'Intel')
            {
                $intelCpus->push($hardware);
                $cpus->push($hardware);
            }elseif ($hardware->part === 'GPU')
            {
                $gpus->push($hardware);
            }elseif ($hardware->part === 'RAM')
            {
                $rams->push($hardware);
            }elseif ($hardware->part === 'SSD')
            {
                $ssds->push($hardware);
            }elseif ($hardware->part === 'HDD')
            {
                $hdds->push($hardware);
            }elseif ($hardware->part === 'CPU' && $hardware->brand === 'AMD')
            {
                $cpus->push($hardware);
            }
        }
        for ($i = 0; $i < 100000; $i++) {
            $ssdsToInsert = "";
            $ssdScoresToInsert = "";
            $hddsToInsert = "";
            $hddScoresToInsert = "";
            $scoreDifference = rand(900, 1100) / 1000;
            $cpu = $cpus->random();
            $cpuScore = $cpu->score * $scoreDifference;
            $gpu = $gpus->random();
            $gpuScore = $gpu->score * $scoreDifference;
            if ($cpu->part === 'AMD' && $gpu->part === 'Intel') {
                $cpu = $intelCpus->random();
                $cpuScore = $cpu->score * $scoreDifference;
            }
            $ram = $rams->random();
            $ramScore = $ram->score * $scoreDifference;
            $storageNumber = rand(1, 5);
            for ($s = 1; $s <= $storageNumber; $s++) {
                $selectStorage = rand(0, 1);
                if ($selectStorage === 0) {
                    $tempSsd = $ssds->random();
                    $tempSsdScore = $tempSsd->score * $scoreDifference;
                    $ssdsToInsert .= $tempSsd->id . ",";
                    $ssdScoresToInsert .= $tempSsdScore . ",";
                } else {
                    $tempHdd = $hdds->random();
                    $tempHddScore = $tempHdd->score * $scoreDifference;
                    $hddsToInsert .= $tempHdd->id . ",";
                    $hddScoresToInsert .= $tempHddScore . ",";
                }
            }
            $ssdsToInsert = rtrim($ssdsToInsert, ",");
            $hddsToInsert = rtrim($hddsToInsert, ",");
            $ssdScoresToInsert = rtrim($ssdScoresToInsert, ",");
            $hddScoresToInsert = rtrim($hddScoresToInsert, ",");
            $arrayToInsert = ['cpu_id' => $cpu->id, 'cpu_score' => $cpuScore, 'gpu_id' => $gpu->id, 'gpu_score' => $gpuScore, 'ram_id' => $ram->id, 'ram_score' => $ramScore, 'ssd_ids' => $ssdsToInsert,
                'ssd_scores' => $ssdScoresToInsert, 'hdd_ids' => $hddsToInsert, 'hdd_scores' => $hddScoresToInsert];
            $this->computerRepositories->saveComputerToDb($arrayToInsert);
        }
    }

    public function countComputers()
    {
        return $this->computerRepositories->countComputers();
    }

    public function findHardware($model)
    {
        return $this->computerRepositories->findHardware($model);
    }

    public function runATest()
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
