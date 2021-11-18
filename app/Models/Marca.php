<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    public $table = 'marcas';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    public $fillable = [
        'codigo',
        'nombre'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'codigo' => 'string',
        'nombre' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'codigo' => 'required|max:5',
        'nombre' => 'required|max:40'
    ];

     /**
     * Get the historial_busqueda for the vin.
     */
    public function vines()
    {
        return $this->hasMany('App\Models\Vin');
    }
    
    /**
     * Get the historial_busqueda for the vin.
     */
    public function detalle_campanas()
    {
        return $this->hasMany('App\Models\DetalleCampana');
    }
}
