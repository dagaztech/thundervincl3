<?php

namespace App\Http\Controllers;

use App\DataTables\LogImportacionDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateLogImportacionRequest;
use App\Http\Requests\UpdateLogImportacionRequest;
use App\Repositories\LogImportacionRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class LogImportacionController extends AppBaseController
{
    /** @var  LogImportacionRepository */
    private $logImportacionRepository;

    public function __construct(LogImportacionRepository $logImportacionRepo)
    {
        $this->logImportacionRepository = $logImportacionRepo;
    }

    /**
     * Display a listing of the LogImportacion.
     *
     * @param LogImportacionDataTable $logImportacionDataTable
     * @return Response
     */
    public function index(LogImportacionDataTable $logImportacionDataTable)
    {
        return $logImportacionDataTable->render('log_importaciones.index');
    }

    /**
     * Show the form for creating a new LogImportacion.
     *
     * @return Response
     */
    public function create()
    {
        return view('log_importaciones.create');
    }

    /**
     * Store a newly created LogImportacion in storage.
     *
     * @param CreateLogImportacionRequest $request
     *
     * @return Response
     */
    public function store(CreateLogImportacionRequest $request)
    {
        $input = $request->all();

        $logImportacion = $this->logImportacionRepository->create($input);

        Flash::success('Log Importacion saved successfully.');

        return redirect(route('logImportaciones.index'));
    }

    /**
     * Display the specified LogImportacion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $logImportacion = $this->logImportacionRepository->findWithoutFail($id);

        if (empty($logImportacion)) {
            Flash::error('Log Importacion not found');

            return redirect(route('logImportaciones.index'));
        }

        return view('log_importaciones.show')->with('logImportacion', $logImportacion);
    }

    /**
     * Show the form for editing the specified LogImportacion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $logImportacion = $this->logImportacionRepository->findWithoutFail($id);

        if (empty($logImportacion)) {
            Flash::error('Log Importacion not found');

            return redirect(route('logImportaciones.index'));
        }

        return view('log_importaciones.edit')->with('logImportacion', $logImportacion);
    }

    /**
     * Update the specified LogImportacion in storage.
     *
     * @param  int              $id
     * @param UpdateLogImportacionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLogImportacionRequest $request)
    {
        $logImportacion = $this->logImportacionRepository->findWithoutFail($id);

        if (empty($logImportacion)) {
            Flash::error('Log Importacion not found');

            return redirect(route('logImportaciones.index'));
        }

        $logImportacion = $this->logImportacionRepository->update($request->all(), $id);

        Flash::success('Log Importacion updated successfully.');

        return redirect(route('logImportaciones.index'));
    }

    /**
     * Remove the specified LogImportacion from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $logImportacion = $this->logImportacionRepository->findWithoutFail($id);

        if (empty($logImportacion)) {
            Flash::error('Log Importacion not found');

            return redirect(route('logImportaciones.index'));
        }

        $this->logImportacionRepository->delete($id);

        Flash::success('Log Importacion deleted successfully.');

        return redirect(route('logImportaciones.index'));
    }
}
