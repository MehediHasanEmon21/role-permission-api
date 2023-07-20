<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Repositories\AuthRepository;
use Exception;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{   
    use ResponseTrait;

    public function __construct(public AuthRepository $auth){}
    
    public function login(LoginRequest $request): JsonResponse
    {
        try {

            $data = $this->auth->login($request->validated());
            return $this->responseSuccess($data, 'Logged in Successfully');

        } catch (Exception $e) {

            return $this->responseError([], $e->getMessage());

        }
    }

    
}
