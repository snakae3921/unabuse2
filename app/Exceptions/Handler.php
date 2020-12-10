<?php

namespace App\Exceptions;

// 2020/12/03 insert http419err
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Session\TokenMismatchException; // add


use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        //
    }


    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
/*
     public function render($request, Exception $exception)
    {
        // 「the page has expired due to inactivity. please refresh and try again」を表示させない
        if ($exception instanceof TokenMismatchException) {
            return redirect('/login')->with('message', 'セッションの有効期限が切れました。再度ログインしてください。');
        }

        return parent::render($request, $exception);
    }
    */    
}
