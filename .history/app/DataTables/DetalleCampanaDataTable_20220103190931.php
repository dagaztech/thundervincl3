<?php



namespace App\DataTables;



use App\Models\DetalleCampana;

use Form;

use Yajra\Datatables\Services\DataTable;



class DetalleCampanaDataTable extends DataTable

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

            //->addColumn('action', 'detallecampanas.datatables_actions')

            ->make(true);

    }



    /**

     * Get the query object to be processed by dataTables.

     *

     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection

     */

    public function query()

    {

        $key = $this->key;



        if(!empty($key)){

            //$detalle_campanas = DetalleCampana::query()->where('detalle_campanas.marca_id', $key)->with('marca', 'vins')->orderBy('detalle_campanas.id','desc');
            $detalle_campanas = DetalleCampana::query()-> where('vins.marca_id', $key)->with('marca_id', 'vins')->orderBy('vins.id','desc');

        }else{

            //$detalle_campanas = DetalleCampana::query()->with('marca', 'vins')->orderBy('detalle_campanas.id','desc'); 
            $detalle_campanas = DetalleCampana::query()->with('marca_id', 'vins')->orderBy('vins.id','desc'); 

        }





        return $this->applyScopes($detalle_campanas);

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

            //->addAction([ 'title' => 'Acciones'])

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

    protected function getColumns()

    {

        return [

            'marca' => ['name' => 'marca_id', 'data' => 'marca.nombre'],

            'vines' => ['name' => 'vines', 'data' => 'vines'],

            'campana' => ['name' => 'campana', 'data' => 'campana'],

            'vendedor' => ['name' => 'vendedor', 'data' => 'vendedor'],

            'ano' => ['name' => 'ano', 'data' => 'ano'],

            'modelo' => ['name' => 'modelo', 'data' => 'modelo'],

            'ciudad' => ['name' => 'ciudad', 'data' => 'ciudad'],

            'atendido' => ['name' => 'atendido', 'data' => 'atendido'],

            'nombre' => ['name' => 'nombre', 'data' => 'nombre'],

            'descripcion' => ['name' => 'descripcion', 'data' => 'descripcion'],

            'lineas_afectadas_por_campanas' => ['name' => 'lineas_afectadas_por_campanas', 'data' => 'lineas_afectadas_por_campanas'],

            'fecha_inicio_campana' => ['name' => 'fecha_inicio_campana', 'data' => 'fecha_inicio_campana'],

            'modelos_vehiculos_afectados' => ['name' => 'modelos_vehiculos_afectados', 'data' => 'modelos_vehiculos_afectados'],

            'info_adicional' => ['name' => 'info_adicional', 'data' => 'info_adicional'],

            'estado' => ['name' => 'estado', 'data' => 'estado'],

        ];

    }



    /**

     * Get filename for export.

     *

     * @return string

     */

    protected function filename()

    {

        return 'detallecampanas_' . time();

    }

}