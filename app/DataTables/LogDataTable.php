<?php

namespace App\DataTables;

use App\User;
use Yajra\Datatables\Services\DataTable;
use Spatie\Activitylog\Models\Activity;

class LogDataTable extends DataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->make(true);
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $logs = Activity::query()->with('user')->orderBy('id','desc');

        return $this->applyScopes($logs);
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
                'scrollX' => false,
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
    protected function getColumns()
    {
        return [
            'usuario' => ['name' => 'user_id', 'data' => 'user.name'],
            'descripción' => ['name' => 'text', 'data' => 'text'],
            'I.P.' => ['name' => 'ip_address', 'data' => 'ip_address'],
            'fecha' => ['name' => 'created_at', 'data' => 'created_at'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'logs_' . time();
    }
}
