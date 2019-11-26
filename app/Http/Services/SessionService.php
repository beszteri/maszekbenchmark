<?php


namespace App\Http\Services;


use App\Http\Repositories\ComputerRepositories;
use App\Http\Repositories\HardwareRepositories;
use Illuminate\Support\Facades\DB;

class SessionService
{
    /**
     * @var HardwareRepositories
     */
    private $hardwareRepositores;
    /**
     * @var ComputerRepositories
     */
    private $computerRepositories;

    /**
     * SessionService constructor.
     * @param HardwareRepositories $hardwareRepositores
     * @param ComputerRepositories $computerRepositories
     */
    public function __construct(HardwareRepositories $hardwareRepositores, ComputerRepositories $computerRepositories)
    {
        $this->hardwareRepositores = $hardwareRepositores;
        $this->computerRepositories = $computerRepositories;
    }

    public function storeSessionData($id)
    {
        $hardware = $this->hardwareRepositores->findHardwareById($id);
        $singleArray = [];
        foreach ($hardware as $childArray)
        {
            foreach ($childArray as $value)
            {
                $singleArray[] = $value;
            }
        }
        if ($singleArray[1] == 'SSD')
        {
            return $this->getStorageToSession($singleArray, $singleArray[1], $id);
        }
        elseif ($singleArray[1] == 'HDD')
        {
            return $this->getStorageToSession($singleArray, $singleArray[1], $id);
        }
        return $singleArray;
    }

    public function getStorageToSession($singleArray, $storage, $id)
    {
        $comps = null;
        if ($storage == 'SSD')
        {
            $comps = $this->computerRepositories->findSsdById($id);
        }else
        {
            $comps = $this->computerRepositories->findHddById($id);
        }
        $allStorageScore = array();
        foreach ($comps as $comp)
        {
            $storageIds = explode(",", $comp->ssd_ids);
            $storageIds = array_map('intval', $storageIds);
            $storageScores = explode(",", $comp->ssd_scores);
            $storageScores = array_map('intval', $storageScores);
            $scoreKey = array_search($id, $storageIds);
            $storageScore = $storageScores[$scoreKey];
            array_push($allStorageScore, $storageScore);
        }
        $storageScore = array_sum($allStorageScore) / count($allStorageScore);
        $storage = [$singleArray[0], $singleArray[1], $singleArray[2], $singleArray[3], $storageScore];
        return $storage;
    }
}
