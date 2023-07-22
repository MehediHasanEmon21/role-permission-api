<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleCreateRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Repositories\RoleRepositoty;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;

class RoleController extends Controller
{
    use ResponseTrait;

    public function __construct(private RoleRepositoty $role)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        try {

            $roles = $this->role->getAll(request()->all());

            return $this->responseSuccess($roles, 'Role Found Successfully');

        } catch (Exception $e) {

            return $this->responseError([], $e->getMessage(), $e->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleCreateRequest $request): JsonResponse
    {
        try {

            $role = $this->role->create($request->validated());

            return $this->responseSuccess($role, 'Role Created Successfully');

        } catch (Exception $e) {

            return $this->responseError([], $e->getMessage(), $e->getCode());

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        try {

            $role = $this->role->findById($id);

            return $this->responseSuccess($role, 'Role Found Successfully');

        } catch (Exception $e) {

            return $this->responseError([], $e->getMessage(), $e->getCode());

        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleUpdateRequest $request, int $id)
    {
        try {

            $role = $this->role->update($request->validated(), $id);

            return $this->responseSuccess($role, 'Role Update Successfully');

        } catch (Exception $e) {

            return $this->responseError([], $e->getMessage(), $e->getCode());

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {

            $role = $this->role->delete($id);

            return $this->responseSuccess($role, 'Role Deleted Successfully');

        } catch (Exception $e) {

            return $this->responseError([], $e->getMessage(), $e->getCode());

        }
    }
}
