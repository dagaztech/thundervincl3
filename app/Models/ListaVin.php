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
class ListaVin extends Model
{


    public $table = 'v_vines_consultas';

}
