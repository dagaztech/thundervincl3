<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Historial_busqueda extends Model
{
    public $table = 'historial_busquedas';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'marca_id',
        'campana',
        'texto_busqueda',
        'estado'   
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'texto_busqueda' => 'required|max:255',
    ];

        /**
     * Get the vin that owns the historial_busqueda.
     */
    public function detalle_campana()
    {
        return $this->belongsTo('App\Models\DetalleCampana', 'texto_busqueda');
    }
}
