<?php

namespace App\Http\Controllers;

use JavaScript;
use Illuminate\Http\Request;
use App\Services\DashBoardService;

class HomeController extends Controller
{
     // Service Variables

    protected $service;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(DashBoardService $dashboard_service)
    {
        $this->middleware('auth');
        $this->service = $dashboard_service;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $invoice_monthly_data = [];
        if(\Auth::user()->hasRole('Admin')){
            $invoice_monthly_data = $this->service->getMonthlyReport();
            JavaScript::put($invoice_monthly_data);    
        }
    
        return view('admin.home')->with($invoice_monthly_data);
    }
}
