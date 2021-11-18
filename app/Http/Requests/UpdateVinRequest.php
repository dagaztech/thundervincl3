<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Vin;

class UpdateVinRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
			'marca_id' => 'required|numeric',
			'campana' => 'required',
			'nombre' => 'required',
			'lineas_afectadas_por_campanas' => 'required',
			'modelos_vehiculos_afectados' => 'required',
			'estado' => 'required',
			'descripcion' => 'required',
			//'info_adicional' => 'required',
			//'fecha_inicio_campana' =>'date|after:18 years ago',
			//'atendido' =>'date|after:18 years ago',
		];
    }
}
