<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Actions\Auth\GetCurrentUserAction;
use app\Actions\User\RegisterRequest;
use App\Actions\User\RegisterUserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterHttpRequest;
use App\Actions\Auth\AuthenticatedUserAction;
use App\Actions\Auth\AuthenticatedUserRequest;
use App\Contracts\ApiException;
use App\Http\Requests\AuthenticatedHttpRequest;
use App\Http\Resources\TokenResource;
use App\Http\Resources\UserResource;
use App\Http\Response\ApiResponse;

final class AuthController extends Controller
{
    private $authenticatedUserAction;
    private $getCurrentUserAction;
    private $registerUserAction;

    public function __construct(
        AuthenticatedUserAction $authenticatedUserAction,
        GetCurrentUserAction $getCurrentUserAction,
        RegisterUserAction $registerUserAction
    ) {
        $this->authenticatedUserAction = $authenticatedUserAction;
        $this->getCurrentUserAction = $getCurrentUserAction;
        $this->registerUserAction = $registerUserAction;
    }

    public function login(AuthenticatedHttpRequest $request): ApiResponse
    {
        try {
            $response = $this->authenticatedUserAction->execute(
                AuthenticatedUserRequest::fromRequest($request)
            );
        } catch (ApiException $exception) {
            return ApiResponse::error($exception);
        }

        return ApiResponse::success(new TokenResource($response));
    }

    public function register(RegisterHttpRequest $request): ApiResponse
    {
        $request = RegisterRequest::fromHttpRequest($request);
        $response = $this->registerUserAction->execute($request);

        return ApiResponse::success(new TokenResource($response));
    }

    public function getCurrentUser(): ApiResponse
    {
        $response = $this->getCurrentUserAction->execute();
        return ApiResponse::success(new UserResource($response->user()));
    }
}