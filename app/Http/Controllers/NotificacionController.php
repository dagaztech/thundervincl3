<?php

namespace App\Http\Controllers;

use App\DataTables\NotificacionDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateNotificacionRequest;
use App\Http\Requests\UpdateNotificacionRequest;
use App\Repositories\NotificacionRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Models\Notificacion;

class NotificacionController extends AppBaseController
{
    /** @var  NotificacionRepository */
    private $notificacionRepository;

    public function __construct(NotificacionRepository $notificacionRepo)
    {
        $this->notificacionRepository = $notificacionRepo;
    }

    /**
     * Display a listing of the Notificacion.
     *
     * @param NotificacionDataTable $notificacionDataTable
     * @return Response
     */
    public function index(NotificacionDataTable $notificacionDataTable)
    {
        return $notificacionDataTable->render('notificaciones.index');
    }

    /**
     * Show the form for creating a new Notificacion.
     *
     * @return Response
     */
    public function create()
    {
        return view('notificaciones.create');
    }

    /**
     * Store a newly created Notificacion in storage.
     *
     * @param CreateNotificacionRequest $request
     *
     * @return Response
     */
    public function store(CreateNotificacionRequest $request)
    {
        $input = $request->all();

        $notificacion = $this->notificacionRepository->create($input);

        Flash::success('Notificacion saved successfully.');

        return redirect(route('notificaciones.index'));
    }

    /**
     * Display the specified Notificacion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $notificacion = $this->notificacionRepository->findWithoutFail($id);

        if (empty($notificacion)) {
            Flash::error('Notificacion not found');

            return redirect(route('notificaciones.index'));
        }

        return view('notificaciones.show')->with('notificacion', $notificacion);
    }

    /**
     * Show the form for editing the specified Notificacion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $notificacion = $this->notificacionRepository->findWithoutFail($id);

        if (empty($notificacion)) {
            Flash::error('Notificacion not found');

            return redirect(route('notificaciones.index'));
        }

        return view('notificaciones.edit')->with('notificacion', $notificacion);
    }

    /**
     * Update the specified Notificacion in storage.
     *
     * @param  int              $id
     * @param UpdateNotificacionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateNotificacionRequest $request)
    {
        $notificacion = $this->notificacionRepository->findWithoutFail($id);

        if (empty($notificacion)) {
            Flash::error('Notificacion not found');

            return redirect(route('notificaciones.index'));
        }

        $notificacion = $this->notificacionRepository->update($request->all(), $id);

        Flash::success('Notificacion updated successfully.');

        return redirect(route('notificaciones.index'));
    }

    /**
     * Remove the specified Notificacion from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $notificacion = $this->notificacionRepository->findWithoutFail($id);

        if (empty($notificacion)) {
            Flash::error('Notificacion not found');

            return redirect(route('notificaciones.index'));
        }

        $this->notificacionRepository->delete($id);

        Flash::success('Notificacion deleted successfully.');

        return redirect(route('notificaciones.index'));
    }
	
    public function cambiarEstado()
    {
        $notificacion = Notificacion::where('status',1)->update(['status' => 0]);
    }
}
