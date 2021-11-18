<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\DataTables\LogDataTable;

class LogController extends AppBaseController
{
    /**
     * Display a listing of the Activity log.
     *
     * @param LogDataTable $vinDataTable
     * @return Response
     */
    public function index(LogDataTable $logDataTable)
    {   
        return $logDataTable->render('logs.index');
    }
}
