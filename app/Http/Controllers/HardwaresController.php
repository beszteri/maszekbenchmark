<?php

namespace App\Http\Controllers;

use App\Hardware;
use App\Http\Services\ComputerService;
use App\Http\Services\HardwareService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HardwaresController extends Controller
{
    private $hardwareService;
    /**
     * HardwaresController constructor.
     */
    public function __construct(HardwareService $hardwareService)
    {
        $this->hardwareService = $hardwareService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('hardwares.index');
    }

    public function displaySelector($component, $id)
    {
        $parts = ['cpus', 'gpus', 'rams', 'hdds', 'ssds'];
        if (in_array($component, $parts)) {
            $data = $this->getComponentsData($component, $id);
            return view('hardwares.showcomponents')->with($data);

        } else {
            $data = $this->getComponentData($component, $id);
            return view('hardwares.showcomponent')->with($data);
        }
    }

    public function getComponentsData($component, $id)
    {
        $button = $id;
        if ($id < 3)
        {
            $button = 3;
        }
        $strToFunc = rtrim($component, 's');
        $components = $this->hardwareService->findAllSpecificComponents(strtoupper($strToFunc));
        $componentsForPage = $components->forPage($id,9)->values();
        $data = [
            'components' => $componentsForPage,
            'button' => $button,
            'component' => $strToFunc,
        ];
        return $data;
    }

    public function getComponentData($component, $id)
    {
        $components = [];
        $hardware = $this->hardwareService->findHardwareById($id);
        if ($component == 'hdd' || $component == 'ssd') {
            $components = $this->hardwareService->getSpecificGeneratedStorage($component, $id);
        }else {
            $components = $this->hardwareService->getSpecificGeneratedComponent($component, $id);
        }
        $labels = [];
        foreach ($components as $component) {
            array_push($labels, $component->score);
        }
        $sortedLabels = array_count_values($labels);
        ksort($sortedLabels);
        $data = [
            'hardware' => $hardware,
            'components' => $components,
            'labels' =>  $sortedLabels,
        ];
        return $data;
    }

    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|min:3'
        ]);
        $query = $request->input('query');
        $hardwares = $this->hardwareService->getSearchedData($query);
        return view('hardwares.search-results')->with('hardwares', $hardwares);
    }

    public function builder()
    {
        $data = $this->hardwareService->getDataFromSession();
        unset($data['higherStorageScore']);
        $gamerScore = $this->hardwareService->getGamerScore();
        $workstationScore = $this->hardwareService->getWorkstationScore();
        $desktopScore = $this->hardwareService->getDesktopScore();
        return view('welcome')->with('data', $data)->with('gamerScore', $gamerScore)->with('workstationScore', $workstationScore)
            ->with('desktopScore', $desktopScore);
    }
}
