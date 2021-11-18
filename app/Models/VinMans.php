<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogsActivityInterface;
use Spatie\Activitylog\LogsActivity;
use Auth;
use DB;
use Carbon\Carbon;

/**
 * Class Vin
 * @package App\Models
 * @version December 26, 2017, 11:22 am UTC
 *
 * @property string vines
 * @property string campana
 * @property string vendedor
 * @property string ano
 * @property string modelo
 * @property string ciudad
 * @property string atendido
 * @property string estado
 * @property string nombre
 * @property string descripcion
 * @property integer marca_id
 */
class VinMans extends Model implements LogsActivityInterface
{
    //use SoftDeletes;
    use LogsActivity;

    public $table = 'vinmans';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'marca_id',
        'vines',
        'campana',
        'vendedor',
        'ano',
        'modelo',
        'ciudad',
        'atendido',
        'estado',
        'nombre',
        'descripcion',
        'lineas_afectadas_por_campanas',
        'fecha_inicio_campana',
        'modelos_vehiculos_afectados',
        'info_adicional'
    ];
    
    public function marca()
    {
        return $this->belongsTo('App\Models\Marca');
    }
    

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'campana' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'campana' => 'required',
    ];

    /**
     * Get the message that needs to be logged for the given event name.
     *
     * @param string $eventName
     * @return string
     */
    public function getActivityDescriptionForEvent($eventName)
    {

        return '';
    }

    static function getCampanasConsultadas($id)
    {

        /*
         * Autor: Jhon Janer
         * Fecha: 22/05/2019
         * Se modifica query para contar las consultas efectivas agrupadas por vin y fecha_consulta
         */

        $campanas_mas_consultadas = DetalleVinMans::query()
            ->selectRaw('detallevinmans.campana, count(distinct detallevinmans.id) as total_afectados, 0 as total_atendidos, 
            (SELECT IFNULL(count(*), 0)
                    FROM (select vcon.campana, count(vcon.id) as cantidad_consultas from historial_busquedas as vcon inner join detallevinmans as      
                    vcam on SUBSTRING(vcon.texto_busqueda, 0,9) = vcam.vin group by vcon.texto_busqueda, vcon.created_at) as v_vines_con
                    WHERE v_vines_con.campana = detallevinmans.campana) as consultas_efectivas,
                    COUNT(historial_busquedas.texto_busqueda) as consultas_web')
            ->leftJoin('historial_busquedas', function($leftJoin){
            $leftJoin->on('detallevinmans.campana', '=', 'historial_busquedas.campana');
            $leftJoin->on('detallevinmans.vin', '=', 'historial_busquedas.texto_busqueda')
                ->where('historial_busquedas.estado', '=', 1 );
        })
        ->where('detallevinmans.marca_id', $id)->groupBy('detallevinmans.campana')
            ->orderBy('consultas_efectivas','desc')->get();
        $resultado = collect();


        if($campanas_mas_consultadas->count() > 0){
            foreach ($campanas_mas_consultadas as $campana){
                $total_atendidos = DetalleVinVolks::query()
                ->selectRaw('COUNT(id) as total_atendidos')
                ->where('detallevinvolks.vinvolksid', $campana->id)
                ->where('detallevinvolks.marca_id', $id)
                //->whereRaw('fecha_ejecucion_campana<>""')
                    ->first();
                $campana->total_atendidos = $total_atendidos->total_atendidos;
                
                $resultado->push($campana);
            }
        }
        return $resultado;
    }

}
