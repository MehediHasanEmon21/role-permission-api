<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionCreateRequest;
use App\Http\Requests\PermissionUpdateRequest;
use App\Repositories\PermissionRepository;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;

class PermissionController extends Controller
{   
    use ResponseTrait;

    public function __construct(private PermissionRepository $permission){}

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        try {

            $permissions = $this->permission->getAll(request()->all());

            return $this->responseSuccess($permissions, 'Permission Found Successfully');

        } catch (Exception $e) {
            
            return $this->responseError([], $e->getMessage(), $e->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionCreateRequest $request): JsonResponse
    {
        try {
       
            $permission = $this->permission->create($request->validated());
            return $this->responseSuccess($permission, 'Permission Created Successfully', 201);

        } catch (Exception $e) {
            dd('ok');
            return $this->responseError([], $e->getMessage(), $e->getCode());

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        try {

            $permission = $this->permission->findById($id);

            return $this->responseSuccess($permission, 'permission Found Successfully');

        } catch (Exception $e) {

            return $this->responseError([], $e->getMessage(), $e->getCode());

        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermissionUpdateRequest $request, int $id)
    {
        try {

            $permission = $this->permission->update($request->validated(), $id);

            return $this->responseSuccess($permission, 'permission Update Successfully');

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

            $permission = $this->permission->delete($id);

            return $this->responseSuccess($permission, 'Permission Deleted Successfully');

        } catch (Exception $e) {

            return $this->responseError([], $e->getMessage(), $e->getCode());

        }
    }

    
}
