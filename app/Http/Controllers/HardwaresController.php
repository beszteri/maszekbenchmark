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

    public function cpus($id)
    {
        $button = $id;
        if ($id < 3)
        {
            $button = 3;
        }
        $cpus = $this->hardwareService->findAllSpecificComponents("CPU");
        $cpusForPage = $cpus->forPage($id,9)->values();
        $data = [
            'cpus' => $cpusForPage,
            'button' => $button
        ];
        return view('hardwares.cpus')->with($data);
    }

    public function gpus($id)
    {
        $button = $id;
        if ($id < 3)
        {
            $button = 3;
        }
        $gpus = $this->hardwareService->findAllSpecificComponents("GPU");
        $gpusForPage = $gpus->forPage($id,9)->values();
        $data = [
            'gpus' => $gpusForPage,
            'button' => $button
        ];

        return view('hardwares.gpus')->with($data);
    }

    public function rams($id)
    {
        $button = $id;
        if ($id < 3)
        {
            $button = 3;
        }
        $rams = $this->hardwareService->findAllSpecificComponents("RAM");
        $ramsForPage = $rams->forPage($id,9)->values();
        $data = [
            'rams' => $ramsForPage,
            'button' => $button
        ];

        return view('hardwares.rams')->with($data);
    }

    public function hdds($id)
    {
        $button = $id;
        if ($id < 3)
        {
            $button = 3;
        }
        $hdds = $this->hardwareService->findAllSpecificComponents("HDD");
        $hddsForPage = $hdds->forPage($id,9)->values();
        $data = [
            'hdds' => $hddsForPage,
            'button' => $button
        ];

        return view('hardwares.hdds')->with($data);
    }

    public function showCpu($id)
    {
        $hardware = $this->hardwareService->findHardwareById($id);
        $cpus = $this->hardwareService->getSpecificGeneratedCpu($id);
        $labels = [];
        foreach ($cpus as $cpu) {
            array_push($labels, $cpu->cpu_score);
        }
        $sortedLabels = array_count_values($labels);
        ksort($sortedLabels);
        $data = [
            'hardware' => $hardware,
            'cpus' => $cpus,
            'labels' =>  $sortedLabels,
        ];
        dd($sortedLabels);
        return view('hardwares.showcpu')->with($data);
    }

    public function showGpu($id)
    {
        $hardware = $this->hardwareService->findHardwareById($id);
        $gpus = $this->hardwareService->getSpecificGeneratedGpu($id);
        $labels = [];
        foreach ($gpus as $gpu) {
            array_push($labels, $gpu->gpu_score);
        }
        $sortedLabels = array_count_values($labels);
        ksort($sortedLabels);
        $data = [
            'hardware' => $hardware,
            'gpus' => $gpus,
            'labels' =>  $sortedLabels,
        ];
        return view('hardwares.showgpu')->with($data);
    }

    public function showRam($id)
    {
        $hardware = $this->hardwareService->findHardwareById($id);
        $rams = $this->hardwareService->getSpecificGeneratedRam($id);
        $labels = [];
        foreach ($rams as $ram) {
            array_push($labels, $ram->ram_score);
        }
        $sortedLabels = array_count_values($labels);
        ksort($sortedLabels);
        $data = [
            'hardware' => $hardware,
            'rams' => $rams,
            'labels' =>  $sortedLabels,
        ];
        return view('hardwares.showram')->with($data);
    }

    public function showHdd($id)
    {
        $hardware = $this->hardwareService->findHardwareById($id);
        $comps = $this->hardwareService->getSpecificGeneratedHdd($id);
        $hardware = $this->hardwareService->findHardwareById($id);
        $allStorageScore = array();
        foreach ($comps as $comp)
        {
            $storageIds = explode(",", $comp->hdd_ids);
            $storageIds = array_map('intval', $storageIds);
            $storageScores = explode(",", $comp->hdd_scores);
            $storageScores = array_map('intval', $storageScores);

            $scoreKey = array_search($id, $storageIds);
            $storageScore = $storageScores[$scoreKey];
            array_push($allStorageScore, $storageScore);
        }
        $storageScore = array_sum($allStorageScore) / count($allStorageScore);
        $storage = [$hardware->id, $hardware->part, $hardware->brand, $hardware->model, $storageScore];
        $labels = $allStorageScore;

        $sortedLabels = array_count_values($labels);
        ksort($sortedLabels);
        $data = [
            'hardware' => $hardware,
            'hdds' => $labels,
            'labels' =>  $sortedLabels,
        ];
        return view('hardwares.showhdd')->with($data);
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
        $gamerScore = $this->hardwareService->getGamerScore();
        $workstationScore = $this->hardwareService->getWorkstationScore();
        $desktopScore = $this->hardwareService->getDesktopScore();
        return view('welcome')->with('data', $data)->with('gamerScore', $gamerScore)->with('workstationScore', $workstationScore)
            ->with('desktopScore', $desktopScore);
    }

}
