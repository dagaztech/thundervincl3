<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\Notificacion;
use Storage;
use League\Flysystem\Filesystem;
use League\Flysystem\Sftp\SftpAdapter;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
		Carbon::setLocale('es');
        view()->composer('*', function($view){
            if(Auth::user()){
                $notificationsArr = [];
                $notificaciones = Notificacion::where('status', 1);
                $notificaciones_count = $notificaciones->count();
                $notificaciones = $notificaciones->get();
                if ($notificaciones_count > 0) {
                    foreach ($notificaciones as $nk => $notification) {
                      $notificationsArr[$nk]['descripcion'] = $notification->descripcion;
                      $notificationsArr[$nk]['id'] = $notification->id;
                      $notificationsArr[$nk]['created'] = $notification->created_at->diffForHumans();
                    }
                }
                \View::share(['notifications'=>$notificationsArr,'notificaciones_count'=>$notificaciones_count]);
            }
        });
        Storage::extend('sftp', function ($app, $config) {
            return new Filesystem(new SftpAdapter($config));
        });
        //\URL::forceSchema('http');
        \URL::forceSchema('https');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('path.public', function() {
            return base_path('public_html');
        });
    }
}
