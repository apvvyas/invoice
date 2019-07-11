<?php

namespace App\DataTables;

use Carbon\Carbon;
use App\Models\Invoice;
use Yajra\DataTables\Services\DataTable;

class InvoiceDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->editColumn('status', function($query){
                $status = [
                    'color' => 'warning',
                    'text'  => $query->status
                ];
                if($query->status == 'Paid'){
                  $status['color'] = 'success';  
                }
                elseif($query->status == 'Overdue'){
                    $status['color'] = 'danger';
                }

                return $status;
            })
            ->editColumn('due_at',function($query){
                return $query->due_at->format('d-m-Y');
            })->addColumn('recipient',function($query){
                if(isset($query->recipient)){
                    return $query->recipient->company_name;
                }
                return '-';
            })->addColumn('permissions',function($query){
                return [
                    'view'=>auth()->user()->hasPermissionTo('view_invoice'),
                    'delete'=>auth()->user()->hasPermissionTo('delete_invoice')
                ];
                
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Invoice $model)
    {
        return $model->newQuery()->with('recipient')->orderBy('created_at','DESC');
    }

}
