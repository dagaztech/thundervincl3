<?php

namespace App\Repositories;

use App\Models\VinVolks;
use InfyOm\Generator\Common\BaseRepository;

class VinAdminRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'campana',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return VinVolks::class;
    }
}
