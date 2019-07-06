<?php

namespace App\DataTables;

use App\Models\Tax;
use Yajra\DataTables\Services\DataTable;

class TaxDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)->editColumn('rate',function($query){
            return $query->rate." %";
        })->editColumn('created_at',function($query){
            return $query->created_at->format('j F, Y');
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Tax $model)
    {
        return $model->newQuery()->select('*');
    }
}
