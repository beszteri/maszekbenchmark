<?php


namespace App\Http\Services;


use App\Hardware;
use App\Http\Repositories\ComputerRepositories;
use App\Http\Repositories\HardwareRepositories;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HardwareService
{

    /**
     * @var HardwareRepositories
     */
    private $hardwareRepositories;
    /**
     * @var ComputerRepositories
     */
    private $computerRepositories;

    /**
     * HardwareService constructor.
     * @param HardwareRepositories $hardwareRepositories
     * @param ComputerRepositories $computerRepostories
     */
    public function __construct(HardwareRepositories $hardwareRepositories, ComputerRepositories $computerRepositories)
    {
        $this->hardwareRepositories = $hardwareRepositories;
        $this->computerRepositories = $computerRepositories;
    }


    public function createHardwaresModel(): Collection
    {
        $hardwaresColl = collect();
        $hardwaresData = $this->hardwareRepositories->getAllDataFromHardwares();
        foreach ($hardwaresData as $hardware)
        {
            $hardwaresColl->push(new Hardware($hardware->id,$hardware->part, $hardware->brand, $hardware->model, $hardware->score));
        }
        return $hardwaresColl;
    }

    public function findHardwareById($id)
    {
        foreach ($this->createHardwaresModel() as $part)
        {
            if ($part->getId() == $id)
            {
                return $part;
            }
        }
    }

    public function findAllSpecificComponents($component) :Collection
    {
        $cpus = collect();
        foreach ($this->createHardwaresModel() as $part)
        {
            if ($part->getPart() === $component)
            {
                $cpus->push($part);
            }
        }
        return $cpus;
    }

    public function getSearchedData($query)
    {
        return $this->hardwareRepositories->getSearchedData($query);
    }

    public function getSpecificGeneratedCpu($id)
    {
        return $this->computerRepositories->getSpecificGeneratedCpu($id);
    }

    public function getSpecificGeneratedGpu($id)
    {
        return $this->computerRepositories->getSpecificGeneratedGpu($id);
    }

    public function getSpecificGeneratedRam($id)
    {
        return $this->computerRepositories->getSpecificGeneratedRam($id);
    }

    public function getSpecificGeneratedHdd($id)
    {
        return $this->computerRepositories->findHddById($id);
    }

    public function getDataFromSession()
    {
        $gpu = Session::get('GPU');
        $cpu = Session::get('CPU');
        $ram = Session::get('RAM');
        $hdd = Session::get('HDD');
        $ssd = Session::get('SSD');
        $higherStorageScore = $hdd[4];
        if ($ssd[4] > $higherStorageScore) {
            $higherStorageScore = $ssd[4];
        }
        $data = [
            'cpu' => $cpu,
            'gpu' => $gpu,
            'ram' => $ram,
            'hdd' => $hdd,
            'ssd' => $ssd,
            'higherStorageScore' => $higherStorageScore,
        ];
        return $data;
    }

    public function getGamerScore()
    {
        $data = $this->getDataFromSession();
        return $data['cpu'][4] * 0.3 + $data['gpu'][4] * 0.5 + $data['ram'][4] * 0.1 + $data['higherStorageScore'] * 0.1;
    }

    public function getWorkstationScore()
    {
        $data = $this->getDataFromSession();
        return $data['cpu'][4] * 0.5 + $data['gpu'][4] * 0.1 + $data['ram'][4] * 0.2 + $data['higherStorageScore'] * 0.2;
    }

    public function getDesktopScore()
    {
        $data = $this->getDataFromSession();
        return $data['cpu'][4] * 0.3 + $data['gpu'][4] * 0.1 + $data['ram'][4] * 0.3 + $data['higherStorageScore'] * 0.3;
    }

}
