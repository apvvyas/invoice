<?php

namespace App\DataTables;

use Auth;
use App\Models\Recipient;
use Yajra\DataTables\Services\DataTable;

class RecipientDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)->addColumn('permissions',function($query){
            return [
                'view'=>auth()->user()->hasPermissionTo('view_recipient'),
                'edit'=>auth()->user()->hasPermissionTo('edit_recipient'),
                'delete'=>auth()->user()->hasPermissionTo('delete_recipient'),
            ];
            
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Recipient $model)
    {
        $query = $model->newQuery()->select('*');
        
        if(Auth::user()->hasRole('User'))
            $query->where('user_id',Auth::user()->id);

        return $query;
    }

}
