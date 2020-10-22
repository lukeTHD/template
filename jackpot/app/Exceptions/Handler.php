<?php

namespace App\Exceptions;

use Illuminate\Validation\ValidationException;
use Exception;
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
     * Report or log an exception.
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
     * @return \Illuminate\Http\Response | \Illuminate\Http\JsonResponse
     */
    public function render($request, Exception $exception)
    {
        if($request->route() && is_route_api($request->route()->getName())) {
            $response = [
                'status' => false,
                'code' => 100,
                'message' => $exception->getMessage(),
                'data' => []
            ];

            // Input invalid
            if($exception instanceof ValidationException) {
                $response['code'] = code(ValidationException::class);
                $response['data'] = $exception->errors();
            }

            // Default response of 200
            $status = 200;

            // Return a JSON response with the response array and status code
            return response()->json($response, $status);
        }
        return parent::render($request, $exception);
    }
}
