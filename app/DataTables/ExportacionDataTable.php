<?php

namespace App\DataTables;

use App\Models\Exportacion;
use Form;
use Yajra\Datatables\Services\DataTable;

class ExportacionDataTable extends DataTable
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('fecha', function ($item) {
                return date('d/m/Y',strtotime($item->created_at));
            })
            ->addColumn('hora', function ($item) {
                return date('H:i:s',strtotime($item->created_at));
            })
            ->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $exportacions = Exportacion::query()->orderBy('id','desc');

        return $this->applyScopes($exportacions);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->ajax('')
            ->parameters([
                'dom' => 'Bfrtip',

                'scrollX' => true,

                "language" => [

                    "url" => "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"

                ],

                'buttons' => [

                    ['extend' => 'print', 'text' => '<i class="fa fa-print"></i> Imprimir'],

                    ['extend' => 'reset', 'text' => '<i class="fa fa-undo"></i> Resetear'],

                    ['extend' => 'reload', 'text' => '<i class="fa fa-refresh"></i> Recargar'],

                    ['extend' => 'colvis', 'text' => 'Visibilidad de la Columna'],

                    [

                         'extend'  => 'collection',

                         'text'    => '<i class="fa fa-download"></i> Exportar',

                         'buttons' => [

                             'csv',

                             'excel',

                         ],

                    ],   

                ]
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    private function getColumns()
    {
        return [
            'descripción' => ['name' => 'descripcion', 'data' => 'descripcion', 'width' => '50%', 'className' => 'text-left'],
            'IP' => ['name' => 'ip', 'data' => 'ip', 'width' => '15%', 'className' => 'text-left'],
            'fecha' => ['name' => 'created_at', 'data' => 'fecha', 'width' => '15%', 'className' => 'text-left'],
            'hora_de_transferencia' => ['name' => 'created_at', 'data' => 'hora', 'width' => '20%', 'className' => 'text-left']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'exportacions';
    }
}
