<?php

namespace App\DataTables;

use App\Models\Offre;
use Yajra\DataTables\Services\DataTable;

class ListOffresDataTable extends DataTable
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
            ->addColumn('action', function($query){
                return '<a href="'.route('admin.show_offre',$query->idoffres).'" class="btn btn-info"><span class="fa fa-eye"></span></a> '.
                '<a href="'.route('admin.edit_offre',$query->idoffres).'" class="btn btn-primary"><span class="fa fa-edit"></span></a>'
                .
                ' <a href="'.route('admin.destroy_offre',$query->idoffres).'" class="btn btn-danger" onclick="if(confirm(\'Voulez-vous vraiment supprimé cette offre??\')){return true}else{return false}"><span class="fa fa-trash"></span></a>'
                ;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Offre $model)
    {
        return $model->get();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->addAction(['width' => '150px'])
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            // 'idoffres',
            'titre',
            'resume',
            'statut'
        ];
    }

    protected function getBuilderParameters(){
        return [
            
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'ListOffres_' . date('YmdHis');
    }
}
