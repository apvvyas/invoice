<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
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
             ->addColumn('company',function($query){
                if(isset($query->details)){
                 return $query->details->business_name;
                }
                return '-';
             })->addColumn('permissions',function($query){
                return [
                    'view'=>auth()->user()->hasPermissionTo('view_user'),
                    'edit'=>auth()->user()->hasPermissionTo('edit_user'),
                    'delete'=>auth()->user()->hasPermissionTo('delete_user'),
                ];
                
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        $role = 'Admin';
        return $model->newQuery()->select('*')->role($role)->with('details');
    }
}
