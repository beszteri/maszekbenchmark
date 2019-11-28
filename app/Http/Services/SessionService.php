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
        return $singleArray;
    }

}
