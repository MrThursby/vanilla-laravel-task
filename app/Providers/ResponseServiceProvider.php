<?php

namespace App\Providers;

use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('success', function (array $data = null, array $meta = null, int $status = 200): JsonResponse {
            $response = ['success' => true];

            if(is_array($data)) $response['data'] = $data;
            if(is_array($meta)) $response['meta'] = $meta;

            return Response::json($response, $status);
        });

        Response::macro('error', function (string $message, int $status = 500): JsonResponse {
            $response = ['success' => false, 'message' => $message ];
            return Response::json($response, $status);
        });
    }
}
