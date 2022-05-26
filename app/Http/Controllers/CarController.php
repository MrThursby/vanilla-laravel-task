<?php

namespace App\Http\Controllers;

use App\Actions\CreateCarAction;
use App\Actions\DeleteCarAction;
use App\Actions\GetCarByIdAction;
use App\Actions\GetCarPaginatorAction;
use App\Actions\UpdateCarAction;
use App\Exceptions\CarNotFoundException;
use App\Http\Requests\CarRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class CarController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/cars",
     *     summary="Get cars paginator",
     *     @OA\Response(response=200, description="success")
     * )
     */
    public function index(): JsonResponse
    {
        $response = app(GetCarPaginatorAction::class)->run();
        return Response::success(...$response);
    }

    /**
     * @OA\Post(
     *     path="/api/cars",
     *     summary="Create car",
     *     @OA\Parameter(name="title", in="query", required=true, @OA\Schema(type="string")),
     *     @OA\Response(response=201, description="success"),
     * )
     */
    public function store(CarRequest $request): JsonResponse
    {
        app(CreateCarAction::class)->run($request->input('title'));
        return Response::success(status: 201);
    }

    /**
     * @OA\Get(
     *     path="/api/cars/{carId}",
     *     summary="Get car",
     *     @OA\Parameter(name="carId", in="path", required=true, @OA\Schema(type="integer", format="int64")),
     *     @OA\Response(response=200, description="success"),
     *     @OA\Response(response=404, description="not found")
     * )
     */
    public function show(int $id): JsonResponse
    {
        try {
            $car = app(GetCarByIdAction::class)->run($id);
            return Response::success($car->toArray());
        } catch (CarNotFoundException) {
            return $this->abortNotFound();
        }
    }

    /**
     * @OA\Put(
     *     path="/api/cars/{carId}",
     *     summary="Update car",
     *     @OA\Parameter(name="carId", in="path", required=true, @OA\Schema(type="integer", format="int64")),
     *     @OA\Parameter(name="title", in="query", required=true, @OA\Schema(type="string")),
     *     @OA\Response(response=200, description="success"),
     *     @OA\Response(response=404, description="not found"),
     * )
     */
    public function update(CarRequest $request, int $id): JsonResponse
    {
        try {
            app(UpdateCarAction::class)->run($id, $request->input('title'));
            return Response::success();
        } catch (CarNotFoundException) {
            return $this->abortNotFound();
        }
    }

    /**
     * @OA\Delete (
     *     path="/api/cars/{carId}",
     *     summary="Delete car",
     *     @OA\Parameter(name="carId", in="path", required=true, @OA\Schema(type="integer", format="int64")),
     *     @OA\Response(response=200, description="success"),
     *     @OA\Response(response=404, description="not found"),
     * )
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            app(DeleteCarAction::class)->run($id);
            return Response::success();
        } catch (CarNotFoundException) {
            return $this->abortNotFound();
        }
    }

    private function abortNotFound(): JsonResponse
    {
        return Response::error('Car not found', 404);
    }
}
