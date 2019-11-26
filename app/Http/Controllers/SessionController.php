<?php


namespace App\Http\Controllers;


use App\Http\Services\SessionService;
use Illuminate\Support\Facades\DB;

class SessionController
{
    /**
     * @var SessionService
     */
    private $sessionService;

    /**
     * SessionController constructor.
     * @param SessionService $sessionService
     */
    public function __construct(SessionService $sessionService)
    {
        $this->sessionService = $sessionService;
    }

    public function storeSessionData($id) {
        $singleArray = $this->sessionService->storeSessionData($id);
        session()->put($singleArray[1], $singleArray);
        return redirect('/')->with('success', 'Added!');
    }

    public function deleteSessionData() {
        session()->flush();
        return redirect('/')->with('success', 'Components removed!');
    }
}
