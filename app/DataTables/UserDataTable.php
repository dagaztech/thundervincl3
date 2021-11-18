<?php



namespace App\DataTables;



use App\User;

use Form;

use Yajra\Datatables\Services\DataTable;



class UserDataTable extends DataTable

{



    /**

     * @return \Illuminate\Http\JsonResponse

     */

    public function ajax()

    {

        return $this->datatables

            ->eloquent($this->query())

            ->addColumn('action', 'users.datatables_actions')

            ->make(true);

    }



    /**

     * Get the query object to be processed by datatables.

     *

     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder

     */

    public function query()

    {

        $users = User::query()->whereNull('deleted_at');



        return $this->applyScopes($users);

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

            ->addAction(['width' => '10%','title' => 'Acciones'])

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

    private function getColumns()

    {

        return [

            'nombre' => ['name' => 'name', 'data' => 'name'],

            'email' => ['name' => 'email', 'data' => 'email'],

            'fecha_creacion' => ['name' => 'created_at', 'data' => 'created_at'],

        ];

    }



    /**

     * Get filename for export.

     *

     * @return string

     */

    protected function filename()

    {

        return 'users';

    }

}

