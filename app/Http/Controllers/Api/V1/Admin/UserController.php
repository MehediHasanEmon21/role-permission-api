<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\UserRepository;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{   
    use ResponseTrait;

    public function __construct(private UserRepository $user){}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $roles = $this->user->getAll(request()->all());

            return $this->responseSuccess($roles, 'User Found Successfully');

        } catch (Exception $e) {

            return $this->responseError([], $e->getMessage(), $e->getCode());
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(UserCreateRequest $request)
    {
        try {

            $role = $this->user->create($request->validated());

            return $this->responseSuccess($role, 'User Created Successfully');

        } catch (Exception $e) {

            return $this->responseError([], $e->getMessage(), $e->getCode());

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {

            $user = $this->user->findById($id);

            return $this->responseSuccess($user, 'User Found Successfully');

        } catch (Exception $e) {

            return $this->responseError([], $e->getMessage(), $e->getCode());

        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, string $id)
    {
        try {

            $user = $this->user->update($request->validated(), $id);

            return $this->responseSuccess($user, 'User Update Successfully');

        } catch (Exception $e) {

            return $this->responseError([], $e->getMessage(), $e->getCode());

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {

            $user = $this->user->delete($id);

            return $this->responseSuccess($user, 'Role Deleted Successfully');

        } catch (Exception $e) {

            return $this->responseError([], $e->getMessage(), $e->getCode());

        }
    }
}
