<?php

namespace App\Http\Controllers;

use App\Domain\User\UserDTO;
use App\Domain\User\UserService;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function profile(): JsonResponse
    {
        return $this->successResponse(new UserResource(auth()->user()));
    }

    public function update(UpdateProfileRequest $request, User $user): JsonResponse
    {
        $this->authorize('update', $user);

        $data = $request->validated();

        $user = $this->userService->updateById($user->uuid, new UserDTO($data));

        return $this->successResponse(new UserResource($user));
    }
}
