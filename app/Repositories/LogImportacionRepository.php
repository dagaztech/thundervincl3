<?php

namespace App\Repositories;

use App\Models\LogImportacion;
use InfyOm\Generator\Common\BaseRepository;

class LogImportacionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'descripcion',
        'ftp'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return LogImportacion::class;
    }
}
