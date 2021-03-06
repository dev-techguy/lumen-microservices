<?php


namespace App\Traits;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait APIResponser
{
    /**
     * success response
     * @param $data
     * @param int $code
     * @return JsonResponse
     */
    public function successResponse($data, $code = Response::HTTP_OK)
    {
        return response()->json([
            'data' => $data
        ], $code);
    }


    /**
     * success response
     * @param $message
     * @param int $code
     * @return JsonResponse
     */
    public function errorResponse($message, $code)
    {
        return response()->json([
            'error' => $message,
            'code' => $code
        ], $code);
    }

}
