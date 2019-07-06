<?php

namespace App\DataTables;

use Auth;
use App\Models\Item;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)->editColumn('created_at',function($query){
            return $query->created_at->format('j F, Y');
        })->editColumn('quantity',function($query){
            return $query->quantity." ".$query->unit;
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Item $model)
    {
        return $model->newQuery()->select('*')->where('user_id',Auth::user()->id);
    }
}
