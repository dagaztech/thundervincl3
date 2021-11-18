<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
    
        
        /*
        if ($exception->getStatusCode() == 404) {
            return response()->view('errors.404', [], 404);
        }

        if ($exception->getStatusCode() == 401) {
            return response()->view('errors.401', [], 401);
        }

        if ($exception->getStatusCode() == 403) {
            return response()->view('errors.403', [], 403);
        }

        if ($exception->getStatusCode() == 400) {
            return response()->view('errors.400', [], 400);
        }

        if ($exception->getStatusCode() == 405) {
            return response()->view('errors.405', [], 405);
        }

        if ($exception->getStatusCode() == 406) {
            return response()->view('errors.406', [], 406);
        }

        if ($exception->getStatusCode() == 408) {
            return response()->view('errors.408', [], 408);
        }

        if ($exception->getStatusCode() == 500) {
            return response()->view('errors.500', [], 500);
        }

        if ($exception->getStatusCode() == 501) {
            return response()->view('errors.501', [], 501);
        }

        if ($exception->getStatusCode() == 502) {
            return response()->view('errors.502', [], 502);
        }

        if ($exception->getStatusCode() == 503) {
            return response()->view('errors.503', [], 503);
        }

        if ($exception->getStatusCode() == 504) {
            return response()->view('errors.504', [], 504);
        }

        if ($exception->getStatusCode() == 505) {
            return response()->view('errors.505', [], 505);
        }
        
        if($this->isHttpException($exception)){
			return response()->view('errors.503',[],500);    
        }
        */
        
        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest('/admin/login');
    }
}
