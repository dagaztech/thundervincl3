<?php

namespace App\Http\Controllers;


use App\DataTables\VinDataTable;
use App\DataTables\ListaVinsDataTable;
use App\DataTables\DetalleCampanaDataTable;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Requests;
use App\Http\Requests\CreateVinRequest;
use App\Http\Requests\UpdateVinRequest;
use App\Repositories\VinRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Models\Vin;
use App\Models\VinVolks;
use App\Models\VinMans;
use App\Models\Marca;
use App\Models\Historial_busqueda;

use App\Models\DetalleCampana;
use App\Models\Exportacion;
use App\Models\Notificacion;
use App\Models\LogImportacion;


use Excel;
use File;
use DataTables;
use Datatables as laravelDatatables;
use Validator;
use DB;
use Storage;
use Mail;
use Config;

class VinController extends AppBaseController

{

    /** @var  VinRepository */

    private $vinRepository;
    private static $campañasNoAsiciaidaVin = 'El vehículo con el VIN / chasis consultado, actualmente no tiene campañas de servicio pendientes por efectuar. Lo invitamos a seguir consultando periódicamente.';

    private static $vinNoexiste = 'Tu vehículo actualmente no presenta campañas pendientes por realizar.';

    public function __construct(VinRepository $vinRepo)
    {
        //return response(self::$campañasNoAsiciaidaVin, 400);
        $this->vinRepository = $vinRepo;
    }


    /**
     * Display a listing of the Vin.
     *
     * @param VinDataTable $vinDataTable
     * @return Response
     */

    public function index(VinDataTable $vinDataTable)
    {
        return $vinDataTable->render('vins.index');
    }

    /**
     * Display a listing of the Vin for specific marca.
     *
     * @param DetalleCampanaDataTable $detalleCampanaDataTable
     * @param $id
     * @return Response
     */

    public function getVinPorMarca(DetalleCampanaDataTable $detalleCampanaDataTable, $id)
    {
        $marca = Marca::find($id);
        
        $campanas_mas_consultadas = Vin::getCampanasConsultadas($id);
        return view('detallecampanas.por_marca', compact('marca', 'campanas_mas_consultadas'));
    }


    /**
     * Display a listing of the Vin for specific marca.
     *
     * @param DetalleCampanaDataTable $detalleCampanaDataTable
     * @param $id
     * @return Response
     */

    public function panelPorMarca($id)
    {

        $marca = Marca::find($id);
        $consultas_marca = DB::table('historial_busquedas as hc')
            ->join('marcas as m', 'hc.marca_id', '=', 'm.id')
            ->select('m.nombre', DB::raw("count(*) as consultas"))
            ->where('hc.marca_id', $id)
            ->groupBy('m.nombre')
            ->first();


        $consultas_efectivas = DB::table('historial_busquedas as hc')
            ->select(DB::raw("count(distinct texto_busqueda,campana) as consultas"))
            ->where('hc.marca_id', $id)->where('estado', 1)
            ->first();

        if ($consultas_marca) {
            $efectividad_consultas = ((int)$consultas_efectivas['consultas'] / (int)$consultas_marca['consultas']) * 100;
        } else {
            $efectividad_consultas = 0;
        }

        $campanas_mas_consultadas;
        if($id == 4){
            $campanas_mas_consultadas = VinVolks::getCampanasConsultadas($id)->splice(0, 10);
        }
        else if($id == 7){
            $campanas_mas_consultadas = VinMans::getCampanasConsultadas($id)->splice(0, 10);
        }
        else{
            $campanas_mas_consultadas = Vin::getCampanasConsultadas($id)->splice(0, 10);
        }


        $consultas_por_mes = DB::table("historial_busquedas as hc")
            ->select(DB::raw("ELT(DATE_FORMAT(hc.created_at, '%m'),
                'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre') as mes"), DB::raw("(COUNT(*)) as total_consultas"))
            ->where('hc.marca_id', $id)
            ->orderBy('hc.created_at', 'asc')
            ->groupBy('mes')
            ->get();
        return view('vins.panel_marca', compact(
            'marca',
            'consultas_marca',
            'consultas_efectivas',
            'efectividad_consultas',
            'campanas_mas_consultadas',
            'consultas_por_mes'
        ));

    }


    /**
     * Show the form for creating a new Vin.
     *
     * @return Response
     */

    public function create()
    {
        $marcas = Marca::all();
        return view('vins.create')->with('marcas', $marcas);
    }

    /**
     * Store a newly created Vin in storage.
     *
     * @param CreateVinRequest $request
     *
     * @return Response
     */

    public function store(CreateVinRequest $request)
    {

        set_time_limit(0);
        if ($request->vines) {
            $file = $request->vines->getRealPath();
        }

        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        //$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Csv");
        $reader->setInputEncoding('CP1252');
        $reader->setDelimiter(';');

        $spreadsheet = $reader->load($file);


        $worksheet = $spreadsheet->getActiveSheet();
        // Get the highest row number and column letter referenced in the worksheet
        $highestRow = $worksheet->getHighestRow(); // e.g. 10
        $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
        $firstCell = $worksheet->getCell("A1")->getValue();;
        //echo $siNumber ;
        //print_r($worksheet);

        //$archivo = Excel::load($file)->get();

        //$archivo = File::get($file);

        $guardados = 0;
        $no_guardados = 0;
        $total = 0;
        //$campana = explode(':', $archivo[0]);
        //$campana = explode(',', $campana[2]);
        //$campana = $campana[0];
        //unset($archivo[0]);

        $campana = explode(':', $firstCell)[1];
        $campana = explode(',', $campana)[0];
        
        $lineas_afectadas_por_campanas;

        $modelos_vehiculos_afectados;

        if (sizeof($request->lineas_afectadas_por_campanas) > 1)

            $lineas_afectadas_por_campanas = implode(',', $request->lineas_afectadas_por_campanas);

        else
            $lineas_afectadas_por_campanas = $request->lineas_afectadas_por_campanas[0];

        if (sizeof($request->modelos_vehiculos_afectados) > 1)

            $modelos_vehiculos_afectados = implode(',', $request->modelos_vehiculos_afectados);

        else

            $modelos_vehiculos_afectados = $request->modelos_vehiculos_afectados[0];


        $input = $request->except(['lineas_afectadas_por_campanas', 'modelos_vehiculos_afectados']);
        $input['lineas_afectadas_por_campanas'] = $lineas_afectadas_por_campanas;
        $input['modelos_vehiculos_afectados'] = $modelos_vehiculos_afectados;

        if (empty($input['fecha_inicio_campana'])) {

            $input['fecha_inicio_campana'] = null;
        }

        if (empty($input['atendido'])) {

            $input['atendido'] = null;
        }

        $vin = $this->vinRepository->create($input);

        for ($row = 2; $row <= $highestRow; ++$row) {

            $data = array(
                'vin_id' => $vin->id,
                'marca_id' => $request->marca_id,
                'campana' => $campana,
                'vin' => $worksheet->getCell("A". $row)->getValue(),

                'importer_dealer' => $worksheet->getCell("B". $row)->getValue(),

                'criterio' =>$worksheet->getCell("C". $row)->getValue(),

                'fecha_ejecucion_campana' => $worksheet->getCell("D". $row)->getValue(),

                'labour' => $worksheet->getCell("E". $row)->getValue(),

                'parts' => $worksheet->getCell("F". $row)->getValue(),

                'count' => $worksheet->getCell("G". $row)->getValue(),

                'codigo_borrado' => $worksheet->getCell("H". $row)->getValue(),

                'column9' => $worksheet->getCell("I". $row)->getValue(),

                'column10' => $worksheet->getCell("J". $row)->getValue(),

                'dealer_que_ejecuta_campana' => $worksheet->getCell("K". $row)->getValue(),
                
                'column12' => $worksheet->getCell("L". $row)->getValue(),
            );

            DetalleCampana::where('vin', $data['vin'])->where('marca_id', $request->marca_id)->delete();


            if (!empty($data['importer_dealer'])) {

                $importer_dealer = $data['importer_dealer'];
                $data['importer_dealer'] = substr($importer_dealer, 0, 6);
                $data['vendedor'] = substr($importer_dealer, 6);
            } else {
                $data['importer_dealer'] = null;
                $data['vendedor'] = null;
            }

            if (!empty($data['dealer_que_ejecuta_campana'])) {

                $dealer_que_ejecuta_campana = $data['dealer_que_ejecuta_campana'];
                $data['dealer_que_ejecuta_campana'] = substr($dealer_que_ejecuta_campana, 0, 6);
                $data['importer_ejecuta'] = substr($dealer_que_ejecuta_campana, 6);
            } else {

                $data['dealer_que_ejecuta_campana'] = null;
                $data['importer_ejecuta'] = null;
            }

            DetalleCampana::create($data);
            $guardados++;
        }

        //foreach ($archivo->toArray() as $row) {

            //$data = array(
                //'vin_id' => $vin->id,
                //'marca_id' => $request->marca_id,
                //'campana' => $campana,
                //'vin' => (isset($row[1])) ? $row[1] : null,
                //'importer_dealer' => (isset($row[2])) ? $row[2] : null,
                //'criterio' => (isset($row[3])) ? $row[3] : null,
                //'fecha_ejecucion_campana' => (isset($row[4])) ? $row[4] : null,
                //'labour' => (isset($row[5])) ? $row[5] : null,
                //'parts' => (isset($row[6])) ? $row[6] : null,
                //'count' => (isset($row[7])) ? $row[7] : null,
                //'codigo_borrado' => (isset($row[8])) ? $row[8] : null,
                //'column9' => (isset($row[9])) ? $row[9] : null,
                //'column10' => (isset($row[10])) ? $row[10] : null,
                //'dealer_que_ejecuta_campana' => (isset($row[11])) ? $row[11] : null,
                //'column12' => (isset($row[12])) ? $row[12] : null,

            //);
            //DetalleCampana::where('vin', $data['vin'])->where('marca_id', $request->marca_id)->delete();


            //if (!empty($data['importer_dealer'])) {

                //$importer_dealer = $data['importer_dealer'];
                //$data['importer_dealer'] = substr($importer_dealer, 0, 6);
                //$data['vendedor'] = substr($importer_dealer, 6);
            //} else {
                //$data['importer_dealer'] = null;
                //$data['vendedor'] = null;
            //}

            //if (!empty($data['dealer_que_ejecuta_campana'])) {
                //$dealer_que_ejecuta_campana = $data['dealer_que_ejecuta_campana'];
                //$data['dealer_que_ejecuta_campana'] = substr($dealer_que_ejecuta_campana, 0, 6);
                //$data['importer_ejecuta'] = substr($dealer_que_ejecuta_campana, 6);
            //} else {

                //$data['dealer_que_ejecuta_campana'] = null;
                //$data['importer_ejecuta'] = null;
            //}

            //DetalleCampana::create($data);
            //$guardados++;
        //}

        Flash::success('VIN creado exitosamente.');
        return redirect(route('vins.index'));
    }


    /**
     * Display the specified Vin.
     *
     * @param int $id
     *
     * @return Response
     */

    public function show($id)
    {

        $vin = $this->vinRepository->findWithoutFail($id);
        if (empty($vin)) {
            Flash::error('Vin no encontrado');

            return redirect(route('vins.index'));
        }

        return view('vins.show')->with('vin', $vin);

    }


    /**
     * Show the form for editing the specified Vin.
     *
     * @param int $id
     *
     * @return Response
     */

    public function edit($id)

    {

        $vin = $this->vinRepository->findWithoutFail($id);


        $marcas = Marca::all();


        if (empty($vin)) {

            Flash::error('VIN no encontrado');


            return redirect(route('vins.index'));

        }

        $lineas = '';

        $modelos = '';

        if (strpos($vin->lineas_afectadas_por_campanas, ','))

            $lineas = explode(',', $vin->lineas_afectadas_por_campanas);


        if (strpos($vin->modelos_vehiculos_afectados, ','))

            $modelos = explode(',', $vin->modelos_vehiculos_afectados);


        return view('vins.edit')->with(['vin' => $vin, 'marcas' => $marcas, 'lineas' => $lineas, 'modelos' => $modelos]);

    }


    /**
     * Update the specified Vin in storage.
     *
     * @param int $id
     * @param UpdateVinRequest $request
     *
     * @return Response
     */

    public function update($id, UpdateVinRequest $request)

    {

        $vin = $this->vinRepository->findWithoutFail($id);


        if (empty($vin)) {

            Flash::error('VIN no encontrado');


            return redirect(route('vins.index'));

        }


        $lineas_afectadas_por_campanas;

        $modelos_vehiculos_afectados;

        if (sizeof($request->lineas_afectadas_por_campanas) > 1)

            $lineas_afectadas_por_campanas = implode(',', $request->lineas_afectadas_por_campanas);

        else
            $lineas_afectadas_por_campanas = $request->lineas_afectadas_por_campanas[0];


        if (sizeof($request->modelos_vehiculos_afectados) > 1)

            $modelos_vehiculos_afectados = implode(',', $request->modelos_vehiculos_afectados);

        else

            $modelos_vehiculos_afectados = $request->modelos_vehiculos_afectados[0];


        $data = $request->except(['lineas_afectadas_por_campanas', 'modelos_vehiculos_afectados']);

        $data['lineas_afectadas_por_campanas'] = $lineas_afectadas_por_campanas;

        $data['modelos_vehiculos_afectados'] = $modelos_vehiculos_afectados;

        //dd($data);

        if (empty($data['atendido'])) {

            $data['atendido'] = null;

        }

        if (empty($data['fecha_inicio_campana'])) {


            $data['fecha_inicio_campana'] = null;


        }

        $vin = $this->vinRepository->update($data, $id);


        Flash::success('VIN actualizado exitosamente.');


        return redirect(route('vins.index'));

    }


    /**
     * Remove the specified Vin from storage.
     *
     * @param int $id
     *
     * @return Response
     */

    public function destroy($id)

    {

        $vin = $this->vinRepository->findWithoutFail($id);


        if (empty($vin)) {

            Flash::error('Vin no encontrado');


            return redirect(route('vins.index'));

        }


        $this->vinRepository->delete($id);


        Flash::success('VIN borrado exitosamente.');


        return redirect(route('vins.index'));

    }


    /**
     * Search the specified Vin from storage.
     *
     * @param Request $request
     *
     * @return Response
     */

    public function search(Request $request)
    {
        //return response(self::$campañasNoAsiciaidaVin, 400);

        $fecha_consulta = Carbon::now();
        $dia = 0;
        $mes = 0;
        $maracas = array(2,3);
        $maracasRequest = null;


        if ($fecha_consulta->day < 10) {
            $dia = '0' . $fecha_consulta->day;
        } else {
            $dia = $fecha_consulta->day;
        }

        if ($fecha_consulta->month < 10) {
            $mes = '0' . $fecha_consulta->month;
        } else {
            $mes = $fecha_consulta->month;
        }

        $date = $fecha_consulta->year . $mes . $dia;

        $resulVin = $this->getSearhByVinMarca($request->vines, $date);

        if ($resulVin == null || $resulVin == '') {
            return response(self::$vinNoexiste, 400);
        }
        

        if ($resulVin != null && $resulVin != '') {
            if ($resulVin->marca_id != $request->marca) {
                if ($request->marca == 2 ) {
                    if (!in_array($resulVin->marca_id, $maracas)) {
                        return response('El VIN / chasis consultado no corresponde a la marca', 400);
                    }
                }

                if ($request->marca != 2 ) {
                    return response('El VIN / chasis consultado no corresponde a la marca', 400);
                }
            }
        }

        if ($resulVin != null && $resulVin != '') {
            if ($resulVin->campana == '' && $resulVin->campana == null) {
                return response(self::$campañasNoAsiciaidaVin, 400);
            }
        }

        if ($request->marca == 2) {
            $maracasRequest = $maracas;
        } else {
            $maracasRequest = $request->marca;
        }

        if (is_array($maracasRequest)) {
            $vin = DetalleCampana::join('vins as vin', 'detalle_campanas.vin_id', 'vin.id')
                ->where('vin', $request->vines)
                ->whereIn('detalle_campanas.marca_id', $maracasRequest)
                ->where('vin.estado', 1)
                ->where(function ($query) use ($date) {
                    $query->orWhereNull('fecha_ejecucion_campana');
                    $query->orWhereRaw('fecha_ejecucion_campana = ""');
                    $query->orWhereRaw('CONVERT(SUBSTRING_INDEX(fecha_ejecucion_campana, "-",-1),UNSIGNED INTEGER) >= ' . $date);
                });

        } else {
            $vin = DetalleCampana::join('vins as vin', 'detalle_campanas.vin_id', 'vin.id')
                ->where('vin', $request->vines)->where('detalle_campanas.marca_id', $maracasRequest)
                ->where('vin.estado', 1)
                ->where(function ($query) use ($date) {
                    $query->orWhereNull('fecha_ejecucion_campana');
                    $query->orWhereRaw('fecha_ejecucion_campana = ""');
                    $query->orWhereRaw('CONVERT(SUBSTRING_INDEX(fecha_ejecucion_campana, "-",-1),UNSIGNED INTEGER) >= ' . $date);
                });
        }

        $respuesta = array();

        if ($vin->count() > 0) {

            $i = 1;

            $vin = $vin->get();

            foreach ($vin as $value) {

                $vin_padre = Vin::where('marca_id', $value->marca_id)->where('campana', $value->campana)->first();

                $respuesta[] = '

                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse' . $i . '">' . $vin_padre->campana . '</a>
                    </h4>
                  </div>
                  <div id="collapse' . $i . '" class="panel-collapse collapse">
                    <p id="nombre-data" class="msg-ok vin-camp-p" style="color:black;">
                        <strong>Nombre:</strong> ' . $vin_padre->nombre . '
                    </p>
                    <p id="descripcion-data" class="msg-ok" style="color:black;">
                        <strong>Descripción:</strong>
                        ' . $vin_padre->descripcion . '
                    </p>
                    
                    <p id="descripcion-data" class="msg-ok" style="color:black;">
                        <strong>Fecha de Inicio de Campaña:</strong>
                        ' . $vin_padre->fecha_inicio_campana . '
                    </p>
                    <p id="descripcion-data" class="msg-ok" style="color:black;">
                        <strong>Modelos de Vehículos Afectados:</strong>
                        ' . $vin_padre->modelos_vehiculos_afectados . '

                    </p>

                    ' . $this->getInformacionAdicional($vin_padre->info_adicional) . '

                  </div>
                </div>

                ';

                $i++;

                /*
                 * autor: Jhon Janer Moreno
                 * 19/04/2018
                 * Descriocion: Se anade validacion de fecha de cierre de campana sea mayor a la fecha de consulta
                 *
                 * */

                if ((trim($value->fecha_ejecucion_campana)) == "") {

                    Historial_busqueda::create([
                        'marca_id' => $value->marca_id,
                        'campana' => $value->campana,
                        'texto_busqueda' => $request->vines,
                        'estado' => 1,
                    ]);
                } else {
                    if ($value->fecha_ejecucion_campana >= $date) {
                        Historial_busqueda::create([
                            'marca_id' => $value->marca_id,
                            'campana' => $value->campana,
                            'texto_busqueda' => $request->vines,
                            'estado' => 1,
                        ]);
                    }
                }
            }

            $this->updateDetalleCampana($request->vines, $request->rut);
            return implode('', $respuesta);

        } else {
            Historial_busqueda::create([
                'marca_id' => $request->marca,
                'texto_busqueda' => $request->vines,
                'estado' => 0,
            ]);
            return response(self::$vinNoexiste, 200);
        }
    }

    private function getInformacionAdicional($info_adicional)
    {

        if ($info_adicional != null && $info_adicional != '') {
            return '<p id="descripcion-data" class="msg-ok" style="color:black;">
                        <strong>Información Adicional:</strong>
                        ' . $info_adicional . '
                    </p>';
        }
        return '';
    }

    public function updateDetalleCampana($vin, $rut)
    {
        DetalleCampana::where('vin', $vin)->update(['rut' => $rut]);
    }

    public function getSearhByVinMarca($vines, $date)
    {

        $vin = DetalleCampana::join('vins as vin', 'detalle_campanas.campana', 'vin.campana')
            ->where('vin', $vines)
            ->where('vin.estado', 1)
            ->where(function ($query) use ($date) {
                $query->orWhereNull('fecha_ejecucion_campana');
                $query->orWhereRaw('fecha_ejecucion_campana = ""');
                $query->orWhereRaw('CONVERT(SUBSTRING_INDEX(fecha_ejecucion_campana, "-",-1),UNSIGNED INTEGER) >= ' . $date);
            })->first();

        return $vin;
    }


    /**
     * Show the form for upload a new Vin.
     *
     * @return Response
     */

    public function uploadVin()
    {
        $marcas = Marca::all();
        return view('vins.upload_form', compact('marcas'));
    }


    /**
     * Show the form for upload a new Vin.
     *
     * @return Response
     */

    public function uploadMaster()
    {
        $marcas = Marca::all();
        return view('vins.upload_master_form', compact('marcas'));
    }

    /**
     * Show the form for upload a new Vin.
     *
     * @return Response
     */

    public function listaVins(ListaVinsDataTable $listavinsDataTable)
    {
        return $listavinsDataTable->render('vins.lista-vins');
    }

    /**
     * Show the form for upload a new Vin.
     *
     * @return Response
     */

    public function getConsultas()
    {
        $vins = DB::table('v_vines_consultas')
            ->selectRaw('marca, vin, campana, fecha_ult_consulta, cantidad_consultas')
            ->get();
        return laravelDatatables::of($vins)->escapeColumns([])->make(true);
    }


    /**
     * Store excel file for vin table
     *
     * @return Response
     */

    public function storeExcel(Request $request)
    {

        set_time_limit(0);

        if ($request->hasFile('files')) {

            $file = $request->file('files')->getRealPath();
        }

        $archivo = Excel::load($file)->get();

        Vin::where('marca_id', $request->marca_id)->delete();

        $cantidad = 0;

        foreach ($archivo->toArray() as $row) {

            $row['marca_id'] = $request->marca_id;

            $vin = Vin::create($row);
            $cantidad++;
        }

        return response(array('files' => ['results' => $cantidad]), 200);
    }


    /**
     * Store excel file for detalle_camapanas table
     *
     * @return Response
     */

    public function storeExcelMaster(Request $request)
    {

        set_time_limit(18000);
        ini_set('max_execution_time', 18000); //3 minutes

        if ($request->hasFile('files')) {

            $file = $request->file('files')->getRealPath();
        }

        //$archivo = Excel::load($file)->get();

        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        //$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Csv");
        $reader->setInputEncoding('CP1252');
        $reader->setDelimiter(';');

        $spreadsheet = $reader->load($file);


        $worksheet = $spreadsheet->getActiveSheet();
        // Get the highest row number and column letter referenced in the worksheet
        $highestRow = $worksheet->getHighestRow(); // e.g. 10
        $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
        $firstCell = $worksheet->getCell("A1")->getValue();;
        //echo $siNumber ;
        //print_r($worksheet);

        //$archivo = Excel::load($file)->get();

        //$archivo = File::get($file);

        $guardados = 0;
        $no_guardados = 0;
        $total = 0;
        //$campana = explode(':', $archivo[0]);
        //$campana = explode(',', $campana[2]);
        //$campana = $campana[0];
        //unset($archivo[0]);

        $campana = explode(':', $firstCell)[1];
        $campana = explode(',', $campana)[0];

        $vin = Vin::where('marca_id', $request->marca_id)->where('campana', $campana)->first();
        
        for ($row = 2; $row <= $highestRow; ++$row) {
            //echo $row;
            echo "#";
            //echo $worksheet->getCell("A". $row)->getValue();
            //echo "<br />";
            $data = array(
                'vin_id' => $vin->id,
                'marca_id' => $request->marca_id,
                'campana' => $campana,
                'vin' => $worksheet->getCell("A". $row)->getValue(),
                'importer_dealer' => $worksheet->getCell("B". $row)->getValue(),
                'criterio' =>$worksheet->getCell("C". $row)->getValue(),
                'fecha_ejecucion_campana' => $worksheet->getCell("D". $row)->getValue(),
                'labour' => $worksheet->getCell("E". $row)->getValue(),
                'parts' => $worksheet->getCell("F". $row)->getValue(),
                'count' => $worksheet->getCell("G". $row)->getValue(),
                'codigo_borrado' => $worksheet->getCell("H". $row)->getValue(),
                'column9' => $worksheet->getCell("I". $row)->getValue(),
                'column10' => $worksheet->getCell("J". $row)->getValue(),
                'dealer_que_ejecuta_campana' => $worksheet->getCell("K". $row)->getValue(),
                'column12' => $worksheet->getCell("L". $row)->getValue(),
            );

            DetalleCampana::where('vin', $data['vin'])->where('marca_id', $request->marca_id)->delete();


            if (!empty($data['importer_dealer'])) {

                $importer_dealer = $data['importer_dealer'];
                $data['importer_dealer'] = substr($importer_dealer, 0, 6);
                $data['vendedor'] = substr($importer_dealer, 6);
            } else {
                $data['importer_dealer'] = null;
                $data['vendedor'] = null;
            }

            if (!empty($data['dealer_que_ejecuta_campana'])) {

                $dealer_que_ejecuta_campana = $data['dealer_que_ejecuta_campana'];
                $data['dealer_que_ejecuta_campana'] = substr($dealer_que_ejecuta_campana, 0, 6);
                $data['importer_ejecuta'] = substr($dealer_que_ejecuta_campana, 6);
            } else {

                $data['dealer_que_ejecuta_campana'] = null;
                $data['importer_ejecuta'] = null;
            }

            DetalleCampana::create($data);
            $guardados++;
        }
        ///////////////////

        //$archivo = File::get($file);
        //$guardados = 0;
        //$no_guardados = 0;
        //$total = 0;
        //$campana = explode(':', $archivo[0]);
        //$campana = explode(',', $campana[2]);
        //$campana = $campana[0];
        //unset($archivo[0]);

        //$array = explode('\n\r', $archivo);

        //DetalleCampana::where('marca_id', $request->marca_id)->where('campana', $campana)->delete();
        //foreach ($archivo->toArray() as $row) {

            //$vin = Vin::where('marca_id', $request->marca_id)->where('campana', $campana);

            //if ($vin->count() > 0) {
                //$vin = $vin->first();
                //$data = array(
                    //'vin_id' => $vin->id,
                    //'marca_id' => $request->marca_id,
                    //'campana' => $campana,
                    //'vin' => (isset($row[1])) ? $row[1] : null,
                    //'importer_dealer' => (isset($row[2])) ? $row[2] : null,
                    //'criterio' => (isset($row[3])) ? $row[3] : null,
                    //'fecha_ejecucion_campana' => (isset($row[4])) ? $row[4] : null,
                    //'labour' => (isset($row[5])) ? $row[5] : null,
                    //'parts' => (isset($row[6])) ? $row[6] : null,
                    //'count' => (isset($row[7])) ? $row[7] : null,
                    //'codigo_borrado' => (isset($row[8])) ? $row[8] : null,
                    //'column9' => (isset($row[9])) ? $row[9] : null,
                    //'column10' => (isset($row[10])) ? $row[10] : null,
                    //'dealer_que_ejecuta_campana' => (isset($row[11])) ? $row[11] : null,
                    //'column12' => (isset($row[12])) ? $row[12] : null,
                //);

                //if (!empty($data['importer_dealer'])) {

                    //$importer_dealer = $data['importer_dealer'];
                    //$data['importer_dealer'] = substr($importer_dealer, 0, 6);
                    //$data['vendedor'] = substr($importer_dealer, 6);

                //} else {

                    //$data['importer_dealer'] = null;
                    //$data['vendedor'] = null;
                //}

                //if (!empty($data['dealer_que_ejecuta_campana'])) {

                    //$dealer_que_ejecuta_campana = $data['dealer_que_ejecuta_campana'];

                    //$data['dealer_que_ejecuta_campana'] = substr($dealer_que_ejecuta_campana, 0, 6);

                    //$data['importer_ejecuta'] = substr($dealer_que_ejecuta_campana, 6);
                //} else {

                    //$data['dealer_que_ejecuta_campana'] = null;
                    //$data['importer_ejecuta'] = null;
                //}

                //DetalleCampana::create($data);
                //$guardados++;

            //} else {

                //return response(array('error' => 'Error al subir el archivo. //Favor verificar y/o crear la campa&ntilde;a '), 422);
            //}

            //$total++;
        //}
        return response(array('files' => ['results' => $guardados, 'rejects' => $no_guardados, 'total' => $total]), 200);
    }


    /**
     * Set estado = 1 to Vin.
     *
     * @return Response
     */

    public function activar($id)
    {
        $vin = $this->vinRepository->findWithoutFail($id);

        $vin->estado = 1;
        $vin->save();
        return redirect(route('vins.index'));
    }


    /**
     * Set estado = 0 to Vin.
     *
     * @return Response
     */

    public function desactivar($id)
    {
        $vin = $this->vinRepository->findWithoutFail($id);

        $vin->estado = 0;

        $vin->save();

        return redirect(route('vins.index'));

    }

    /**
     *
     * @return Response
     */

    public function tutorial()
    {
        return view('vins.tutorial');
    }


    public function vistaDetalle($codigo)
    {

        $campana = Vin::where('campana', $codigo)->first();
        if (empty($campana)) {
            Flash::error('Vin no encontrado');
            return redirect(url('/home'));
        }

        $consultas_marca = DB::table('historial_busquedas as hc')
            ->join('marcas as m', 'hc.marca_id', '=', 'm.id')
            ->select('m.nombre', DB::raw("count(*) as consultas"))
            ->where('hc.marca_id', $campana->marca_id)
            ->groupBy('m.nombre')
            ->first();

        $consultas_efectivas = count(DB::table('historial_busquedas')
            ->select('texto_busqueda', 'campana', DB::raw("count(*) as consultas"))
            ->where('campana', $campana->campana)
            ->where('estado', 1)
            ->where('marca_id', $campana->marca_id)
            ->groupBy('texto_busqueda', 'campana')
            ->get());


        if ($consultas_marca)

            $efectividad_consultas = ($consultas_efectivas / (int)$consultas_marca['consultas']) * 100;

        else

            $efectividad_consultas = 0;


        $detalle_consultas = DB::table('detalle_campanas')
            ->join('historial_busquedas', 'detalle_campanas.vin', '=', 'historial_busquedas.texto_busqueda')
            ->select('vin', DB::raw('count(*) as cantidad_consultas'))
            ->where('historial_busquedas.campana', $campana->campana)
            ->groupBy('vin')
            ->orderBy('cantidad_consultas', 'desc')
            ->limit(4)
            ->get();

        //$total_afectados = $campana->detalle_campanas()->count();
        $total_afectados = $campana->detalle_campanas()->distinct('vin')->count('vin');

        $total_atendidos = DetalleCampana::query()->selectRaw('COUNT(id) as total_atendidos')
            ->where('detalle_campanas.vin_id', $campana->id)->whereRaw('fecha_ejecucion_campana<>""')->first();

        $porcentaje_cumplimiento = round(($total_atendidos->total_atendidos / $total_afectados) * 100, 2);

        return view('vins.vistaDetalle', compact('campana', 'porcentaje_cumplimiento', 'total_afectados', 'detalle_consultas', 'consultas_efectivas', 'efectividad_consultas'));

    }


    public function exportar(Request $request)
    {

        set_time_limit(0);
        ini_set('memory_limit', '2048M');

        try {

            /*
             * Autor: jhon janer moreno
             * Fecha: 30-04-2019
             * Descripcion: Se modifico el query para realizar
             * agrupacion por campa;a y vin y union con la tabla v_vines_consultas
             */
            $campanas = DB::table('v_campanas as vcam')->get();

            $texto = 'marca|campana|vin|nombre_campana|descripcion|fecha_cierre|linea_afectada|fecha_inicio|modelo|info_adicional|fecha_creacion' . "\r\n";
            $nombre_archivo = 'campañas_' . date('Ymd') . '.txt';
            $archivos = $nombre_archivo;
            foreach ($campanas as $campana) {
                if ($campana['fecha_cierre'] == '0000-00-00') {
                    $campana['fecha_cierre'] == '';
                }
                if (!empty($campana['vin'])) {
                    $texto .= '"' . str_replace('"', '', $campana['marca']) . '"|"' . str_replace('"', '', $campana['campana']) . '"|"' . str_replace('"', '', $campana['vin']) . '"|"' . str_replace('"', '', $campana['nombre_campana']) . '"|""|"' . str_replace('"', '', $campana['fecha_cierre']) . '"|"' . str_replace('"', '', $campana['lineas_afectadas_por_campanas']) . '"|"' . str_replace('"', '', $campana['fecha_inicio_campana']) . '"|"' . str_replace('"', '', $campana['modelos_vehiculos_afectados']) . '"|""|"' . str_replace('"', '', $campana['fecha_creacion']) . '"' . "\r\n";
                }
            }

            // Storage::disk('public')->put($nombre_archivo, $texto);
            Storage::disk('sftp')->put('in/' . $nombre_archivo, $texto);

            $data = [
                'descripcion' => 'Archivo ' . $nombre_archivo . ' fue creado',
                'ip' => \Request::ip()
            ];
            Exportacion::create($data);

            /*
             * Auto: Jhon Janer
             * Fecha: 21/05/2019
             * Descrioon: Se agraga condicion para que solo mustre los registrfos cuando fecha_ejecucion_campana nos e null
             */

            $campanas = DB::table('v_datos_txt')->where('fecha_ejecucion_campana', '<>', '')->groupBy('vin')->get();
            $texto = 'campana|vin|fecha_inicio|importador|vendedor|criterio|fecha_ejecucion|labor|partes|conteo|importador_2|ejecutor' . "\r\n";
            $nombre_archivo = 'revisiones_' . date('Ymd') . '.txt';
            $archivos .= ', ' . $nombre_archivo;

            foreach ($campanas as $campana) {
                if (!empty($campana['vin'])) {
                    $texto .= '"' . str_replace('"', '', $campana['campana']) . '"|"' . str_replace('"', '', $campana['vin']) . '"|"' . str_replace('"', '', $campana['fecha_inicio_campana']) . '"|"' . str_replace('"', '', $campana['importador']) . '"|"' . str_replace('"', '', $campana['vendedor']) . '"|"' . str_replace('"', '', $campana['criterio']) . '"|"' . str_replace('"', '', $campana['fecha_ejecucion_campana']) . '"|"' . str_replace('"', '', $campana['labor']) . '"|"' . str_replace('"', '', $campana['partes']) . '"|"' . str_replace('"', '', $campana['conteo']) . '"|"' . str_replace('"', '', $campana['importador_2']) . '"|"' . str_replace('"', '', $campana['ejecutor']) . '"' . "\r\n";
                }
            }

            //Storage::disk('public')->put($nombre_archivo, $texto);
            Storage::disk('sftp')->put('in/' . $nombre_archivo, $texto);

            $data = [
                'descripcion' => 'Archivo ' . $nombre_archivo . ' fue creado',
                'ip' => \Request::ip()
            ];
            Exportacion::create($data);

            /*
             * Autor: jhon janer moreno
             * Fecha: 30-04-2019
             * Descripcion: Se ;adio union con la tabla v_campanas y se agrupo por vin, marca, campana
             *
             */
            $campanas = DB::table('v_vines_consultas as vcon')
                ->join('v_campanas as vcam', 'vcon.vin', 'vcam.vin')
                ->selectRaw('vcon.vin, vcon.marca, vcon.campana,
                            MAX(vcon.fecha_ult_consulta) fecha_ult_consulta,
                            SUM(vcon.cantidad_consultas) as cantidad_consultas')
                ->groupBy('vcon.vin', 'vcon.fecha_ult_consulta')
                ->get();

            $texto = 'vin|marca|fecha_consulta|cantidad_consultas' . "\r\n";
            $nombre_archivo = 'consulta_' . date('Ymd') . '.txt';
            $archivos .= ', ' . $nombre_archivo;

            foreach ($campanas as $campana) {
                if (!empty($campana['vin'])) {
                    $texto .= '"' . str_replace('"', '', $campana['vin']) . '"|"' . str_replace('"', '', $campana['marca']) . '"|"' . str_replace('"', '', $campana['fecha_ult_consulta']) . '"|"' . str_replace('"', '', $campana['cantidad_consultas']) . '"' . "\r\n";
                }
            }

            //Storage::disk('public')->put($nombre_archivo, $texto);
            Storage::disk('sftp')->put('in/' . $nombre_archivo, $texto);
            $data = [
                'descripcion' => 'Archivo ' . $nombre_archivo . ' fue creado',
                'ip' => \Request::ip()
            ];
            Exportacion::create($data);

            $campanas = DB::table('marcas')->get();
            $texto = 'marca;codigoMarca' . "\r\n";
            $nombre_archivo = 'homologacionMarcas_' . date('Ymd') . '.txt';
            $archivos .= ', ' . $nombre_archivo;

            foreach ($campanas as $campana) {
                $texto .= trim($campana['nombre']) . ';' . trim($campana['codigo']) . "\r\n";
            }

            //Storage::disk('public')->put($nombre_archivo, $texto);
            Storage::disk('sftp')->put('in/' . $nombre_archivo, $texto);

            $data = [
                'descripcion' => 'Archivo ' . $nombre_archivo . ' fue creado',
                'ip' => \Request::ip()
            ];
            Exportacion::create($data);

            $data = [
                'descripcion' => 'Exportación a B.I. exitosa',
                'ip' => \Request::ip(),
                'status' => 1
            ];
            Notificacion::create($data);

            Flash::success('Exportación realizada exitosamente.');
            $data = [
                'exportado' => $archivos,
                'ip_origen' => \Request::ip(),
                'ip_destino' => Config::get('filesystems.disks.sftp.ip'),
                'ruta' => 'sftp://' . Config::get('filesystems.disks.sftp.host'),
                'fecha' => date('d/m/Y'),
                'hora' => date('H:i:s')
            ];
            Mail::send('emails.email_exito_thundervin', $data, function ($message) {
                $message->subject('Notificación: Procedimiento exitoso');
                $message->to(Config::get('constants.company_email'));
            });
        } catch (Exception $e) {
            Flash::error('La exportación presento un error.');
            $data = [
                'exportado' => $archivos,
                'ip_origen' => \Request::ip(),
                'ip_destino' => Config::get('filesystems.disks.sftp.ip'),
                'ruta' => 'sftp://' . Config::get('filesystems.disks.sftp.host'),
                'fecha' => date('d/m/Y'),
                'hora' => date('H:i:s')
            ];
            Mail::send('emails.email_error_thundervin', $data, function ($message) {
                $message->subject('Notificación de error ThunderVIN');
                $message->to(Config::get('constants.company_email'));
            });
        }

        return redirect(route('exportaciones.index'));
    }

    public function importar(Request $request)
    {
        set_time_limit(0);
        ini_set('memory_limit', '2048M');
        if (Storage::disk('sftp')->exists('errores/Errores_funcionales_' . date('Ymd') . '.xlsx')) {

            $file = Storage::disk('sftp')->get('errores/Errores_funcionales_' . date('Ymd') . '.xlsx');
            Storage::put('public/planos/Errores_funcionales_' . date('Ymd') . '.xlsx', $file);
            $archivo = Excel::load(storage_path('app/public/planos/Errores_funcionales_' . date('Ymd') . '.xlsx'), function ($reader) {
                $reader->formatDates(false);
            })->get();
            $datos = $archivo->toArray();
            $i = 0;
            foreach ($datos as $data) {
                $i++;
                if ($i > 1) {
                    $dato = [
                        'descripcion' => 'Archivo ' . $data[1] . ' - Registro ' . $data[2] . ' - ' . $data[3],
                        'ftp' => Config::get('filesystems.disks.sftp.ip'),
                    ];
                    LogImportacion::create($dato);
                }
            }
            $dato1 = [
                'descripcion' => 'Importación de archivo de errores realizada exitosamente',
                'ip' => \Request::ip(),
                'status' => 1
            ];
            Notificacion::create($dato1);
            Flash::success('Importación de archivo de errores realizada exitosamente');
        } else {
            $dato1 = [
                'descripcion' => 'Importación de archivo de errores no se pudo realizar porque el archivo no existe.',
                'ip' => \Request::ip(),
                'status' => 1
            ];
            Notificacion::create($dato1);
            Flash::error('Importación de archivo de errores no se pudo realizar porque el archivo Errores_funcionales_' . date('Ymd') . '.xlsx no existe.');
        }

        if (Storage::disk('sftp')->exists('errores/Errores_tecnicos_' . date('Ymd') . '.xlsx')) {

            $file = Storage::disk('sftp')->get('errores/Errores_tecnicos_' . date('Ymd') . '.xlsx');
            Storage::put('public/planos/Errores_funcionales_' . date('Ymd') . '.xlsx', $file);
            $archivo = Excel::load(storage_path('app/public/planos/Errores_tecnicos_' . date('Ymd') . '.xlsx'), function ($reader) {
                $reader->formatDates(false);
            })->get();
            $datos = $archivo->toArray();
            $i = 0;
            foreach ($datos as $data) {
                $i++;
                if ($i > 1) {
                    $dato = [
                        'descripcion' => 'Archivo ' . $data[1] . ' - Registro ' . $data[2] . ' - ' . $data[3],
                        'ftp' => Config::get('filesystems.disks.sftp.ip'),
                    ];
                    LogImportacion::create($dato);
                }
            }
            $dato1 = [
                'descripcion' => 'Importación de archivo de errores realizada exitosamente',
                'ip' => \Request::ip(),
                'status' => 1
            ];
            Notificacion::create($dato1);
            Flash::success('Importación de archivo de errores realizada exitosamente');
        } else {
            $dato1 = [
                'descripcion' => 'Importación de archivo de errores no se pudo realizar porque el archivo no existe.',
                'ip' => \Request::ip(),
                'status' => 1
            ];
            Notificacion::create($dato1);
            Flash::error('Importación de archivo de errores no se pudo realizar porque el archivo Errores_tecnicos_' . date('Ymd') . '.xlsx no existe.');
        }

        return redirect(route('logImportaciones.index'));
    }

}

