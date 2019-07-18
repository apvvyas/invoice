<?php

namespace App\Services;

use Carbon\Carbon;
use App\Repositories\InvoiceRepository;

class DashBoardService
{
	protected $invoice_repository;

	function __construct(InvoiceRepository $repo){
		$this->invoice_repository = $repo;
	}

	function getMonthlyReport(){
		$start_date = Carbon::now()->subMonths(12);
		$end_date = Carbon::now();

		$month1 = Carbon::now()->subMonths(1)->format('F');
		$month2 = Carbon::now()->format('F');

		$months = [];
		$report = collect();

		$start_calulate_date = Carbon::now()->subMonths(11);
		$current_month = null;

		for ($i=0; $i <12 ; $i++) { 
			$months[] = $start_calulate_date->format('M Y');
	        $report->put($start_calulate_date->format('F Y'),[
	        	'paid'=>0,
	        	'pending'=>0
	        ]);
	        $start_calulate_date->addMonth();
		}

		$dashboardReport['annual'] = $this->invoice_repository->annualInvoiceData($start_date->format('Y-m-d'),$end_date->format('Y-m-d'));
		$dashboardReport['annual']->each(function ($item,$key) use ($report){
			
			$value = [];
			if($report->has($item->MONTH." ".$item->YEAR))
				$value = $report->get($item->MONTH." ".$item->YEAR);
			if($item->isPaid()){
				$value['paid'] = $item->INV_COUNT;
			}
			elseif($item->isPending()){
				$value['pending'] = $item->INV_COUNT;
			}

			$report->put($item->MONTH." ".$item->YEAR,$value);
		});

		$dashboardReport['months'] = $months;
		$dashboardReport['annual'] = $report;
		$dashboardReport['chart_paid'] = $report->pluck('paid')->toArray();
		$dashboardReport['chart_pending'] = $report->pluck('pending')->toArray();
		$dashboardReport['new_invoice_percent'] = 0;

		$getTwoMonthdata = $this->invoice_repository->getTwoMonthsInvoiceCount($month1,$month2)->toArray();

		$diffInCount = $getTwoMonthdata[$month2] - $getTwoMonthdata[$month1];
		
		if($diffInCount > 0){
			if($getTwoMonthdata[$month1] > 0)
				$dashboardReport['new_invoice_percent'] = (($diffInCount * 100) / $getTwoMonthdata[$month1]);
			else
				$dashboardReport['new_invoice_percent'] = 100;
		}

		$dashboardReport['total_paid'] = array_sum(($dashboardReport['annual']->pluck('paid'))->toArray());
		$dashboardReport['total_pending'] = array_sum(($dashboardReport['annual']->pluck('pending'))->toArray());



		$dashboardReport['recentFiveInvoices'] = $this->invoice_repository->getRecentFiveInvoices();
		$dashboardReport['productCount'] = \Auth::user()->items()->count();
		$dashboardReport['recipientCount'] = \Auth::user()->recipients()->count();
		$dashboardReport['invoiceCount'] = \Auth::user()->invoices()->count();

		return $dashboardReport;
	}
}