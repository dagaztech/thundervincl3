<?php

namespace App\Http\Controllers;

use App\DataTables\ExportacionDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateExportacionRequest;
use App\Http\Requests\UpdateExportacionRequest;
use App\Repositories\ExportacionRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ExportacionController extends AppBaseController
{
    /** @var  ExportacionRepository */
    private $exportacionRepository;

    public function __construct(ExportacionRepository $exportacionRepo)
    {
        $this->exportacionRepository = $exportacionRepo;
    }

    /**
     * Display a listing of the Exportacion.
     *
     * @param ExportacionDataTable $exportacionDataTable
     * @return Response
     */
    public function index(ExportacionDataTable $exportacionDataTable)
    {
        return $exportacionDataTable->render('exportaciones.index');
    }

    /**
     * Show the form for creating a new Exportacion.
     *
     * @return Response
     */
    public function create()
    {
        return view('exportaciones.create');
    }

    /**
     * Store a newly created Exportacion in storage.
     *
     * @param CreateExportacionRequest $request
     *
     * @return Response
     */
    public function store(CreateExportacionRequest $request)
    {
        $input = $request->all();

        $exportacion = $this->exportacionRepository->create($input);

        Flash::success('Exportacion saved successfully.');

        return redirect(route('exportaciones.index'));
    }

    /**
     * Display the specified Exportacion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $exportacion = $this->exportacionRepository->findWithoutFail($id);

        if (empty($exportacion)) {
            Flash::error('Exportacion not found');

            return redirect(route('exportaciones.index'));
        }

        return view('exportaciones.show')->with('exportacion', $exportacion);
    }

    /**
     * Show the form for editing the specified Exportacion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $exportacion = $this->exportacionRepository->findWithoutFail($id);

        if (empty($exportacion)) {
            Flash::error('Exportacion not found');

            return redirect(route('exportaciones.index'));
        }

        return view('exportaciones.edit')->with('exportacion', $exportacion);
    }

    /**
     * Update the specified Exportacion in storage.
     *
     * @param  int              $id
     * @param UpdateExportacionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateExportacionRequest $request)
    {
        $exportacion = $this->exportacionRepository->findWithoutFail($id);

        if (empty($exportacion)) {
            Flash::error('Exportacion not found');

            return redirect(route('exportaciones.index'));
        }

        $exportacion = $this->exportacionRepository->update($request->all(), $id);

        Flash::success('Exportacion updated successfully.');

        return redirect(route('exportaciones.index'));
    }

    /**
     * Remove the specified Exportacion from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $exportacion = $this->exportacionRepository->findWithoutFail($id);

        if (empty($exportacion)) {
            Flash::error('Exportacion not found');

            return redirect(route('exportaciones.index'));
        }

        $this->exportacionRepository->delete($id);

        Flash::success('Exportacion deleted successfully.');

        return redirect(route('exportaciones.index'));
    }
}
