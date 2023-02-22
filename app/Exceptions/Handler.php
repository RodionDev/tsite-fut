<?php
namespace App\Exceptions;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Response;
class Handler extends ExceptionHandler
{
    protected $dontReport = [
    ];
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];
    public function report(Exception $exception)
    {
        parent::report($exception);
    }
    public function render($request, Exception $exception)
    {
        if( $exception instanceof TokenExpiredException){
            return Response::json(['Error' => 'Token Expired'], $exception->getStatusCode());
        }elseif($exception instanceof TokenInvalidException) {
            return Response::json(['Error' => 'Token Invalid'], $exception->getStatusCode());
        }
        elseif($exception instanceof TokenInvalidException) {
            return Response::json(['Error' => 'Token Invalid'], $exception->getStatusCode());
        }
        elseif($exception instanceof JWTExeption) {
            return Response::json(['Error' => 'Error fetching token'], $exception->getStatusCode());
        }
        return parent::render($request, $exception);
    }
}
