<?php

namespace App\Http\Controllers;

use App\Actions\CreateUserAction;
use App\Actions\DeleteUserAction;
use App\Actions\getUserByIdAction;
use App\Actions\GetUserPaginatorAction;
use App\Actions\UpdateUserAction;
use App\Exceptions\UserNotFoundException;
use App\Http\Requests\UserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/users",
     *     summary="Get users paginator",
     *     @OA\Response(response=200, description="success")
     * )
     */
    public function index(): JsonResponse
    {
        $response = app(GetUserPaginatorAction::class)->run();
        return Response::success(...$response);
    }

    /**
     * @OA\Post(
     *     path="/api/users",
     *     summary="Create user",
     *     @OA\Response(response=201, description="success"),
     *     @OA\Parameter(name="name", in="query", required=true, @OA\Schema(type="string")),
     *     @OA\Parameter(name="car_id", in="query", @OA\Schema(type="integer", format="int64"))
     * )
     */
    public function store(UserRequest $request): JsonResponse
    {
        app(CreateUserAction::class)->run(
            $request->input('name'),
            $request->input('car_id')
        );
        return Response::success(status: 201);
    }

    /**
     * @OA\Get(
     *     path="/api/users/{userId}",
     *     summary="Get user",
     *     @OA\Parameter(name="userId", in="path", required=true, @OA\Schema(type="integer", format="int64")),
     *     @OA\Response(response=200, description="success"),
     *     @OA\Response(response=404, description="not found")
     * )
     */
    public function show(int $id): JsonResponse
    {
        try {
            $user = app(GetUserByIdAction::class)->run($id);
            return Response::success($user->toArray());
        } catch (UserNotFoundException) {
            return $this->abortNotFound();
        }
    }

    /**
     * @OA\Put(
     *     path="/api/users/{userId}",
     *     summary="Update user",
     *     @OA\Parameter(name="userId", in="path", required=true, @OA\Schema(type="integer", format="int64")),
     *     @OA\Parameter(name="name", in="query", required=true, @OA\Schema(type="string")),
     *     @OA\Parameter(name="car_id", in="query", @OA\Schema(type="integer", format="int64")),
     *     @OA\Response(response=200, description="success"),
     *     @OA\Response(response=404, description="not found"),
     * )
     */
    public function update(UserRequest $request, int $id): JsonResponse
    {
        try {
            app(UpdateUserAction::class)->run(
                $id,
                $request->input('name'),
                $request->input('car_id')
            );
            return Response::success();
        } catch (UserNotFoundException) {
            return $this->abortNotFound();
        }
    }

    /**
     * @OA\Delete (
     *     path="/api/users/{userId}",
     *     summary="Delete user",
     *     @OA\Parameter(name="userId", in="path", required=true, @OA\Schema(type="integer", format="int64")),
     *     @OA\Response(response=200, description="success"),
     *     @OA\Response(response=404, description="not found"),
     * )
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            app(DeleteUserAction::class)->run($id);
            return Response::success();
        } catch (UserNotFoundException) {
            return $this->abortNotFound();
        }
    }

    private function abortNotFound(): JsonResponse
    {
        return Response::error('User not found', 404);
    }
}
