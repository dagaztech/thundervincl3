<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

/**
 * Class LogImportacion
 * @package App\Models
 * @version October 22, 2018, 9:52 pm -05
 */
class LogImportacion extends Model
{
    use SoftDeletes;

    public $table = 'log_importaciones';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'descripcion',
        'ftp',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'descripcion' => 'string',
        'ftp' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return 
     **/
    static function getAll()
    {
        return self::select('id','descripcion','ftp',DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d %H:%i:%s") as created_at'))->whereNull('deleted_at')->orderBy('id','desc');        
    }
    
}
