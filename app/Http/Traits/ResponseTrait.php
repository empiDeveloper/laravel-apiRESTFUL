<?php

namespace App\Http\Traits;

use Illuminate\Http\JsonResponse;

class ResponseTrait {
    /**
     * Función para retornar mensajes de éxito con estructura personalizada.
     *
     * @param $status = Código de respuesta.
     * @param $data = Información a retornar.
     */
    public static function responseSuccess($data = [], int $status = 200) : JsonResponse
    {
        return response()->json([
            'meta' => [
                'success' => true,
                'errors' => [],
            ],
            'data' => $data,
        ], $status);
    }
    /**
     * Función para retornar mensajes de error con estructura personalizada.
     *
     * @param $status = Código de respuesta.
     * @param $error = Mensaje de error.
     */
    public static function responseError(string $error = 'Ocurrio un error durante la ejecución', int $status = 500) : JsonResponse
    {
        return response()->json([
            'meta' => [
                'success' => false,
                'errors' => $error,
            ],
        ], $status);
    }
}
