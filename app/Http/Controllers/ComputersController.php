<?php

namespace App\Http\Controllers;

use App\Computer;
use App\Hardware;
use App\Http\Services\ComputerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ComputersController extends Controller
{
    /**
     * @var ComputerService
     */
    private $computerService;

    /**
     * ComputersController constructor.
     * @param ComputerService $computerService
     */
    public function __construct(ComputerService $computerService)
    {
        $this->computerService = $computerService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('computers.index');
    }

    public function store()
    {
        $this->computerService->generateRandomComputers();
        return redirect('/')->with('success', 'Random computers generated!');
    }

    public function tested()
    {
        $data = $this->computerService->runATest();
        $gamerScore = $data['gamerScore'];
        $desktopScore = $data['desktopScore'];
        $workstationScore = $data['workstationScore'];
        return view('computers.tested')->with('gamerScore', $gamerScore)->with('desktopScore', $desktopScore)
            ->with('workstationScore', $workstationScore);
    }

}
