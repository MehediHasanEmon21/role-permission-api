<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleCreateRequest;
use App\Interfaces\CrudInterfaces;
use App\Models\Role;
use App\Repositories\RoleRepositoty;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoleController extends Controller
{   
    use ResponseTrait;

    public function __construct(private RoleRepositoty $role){}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

            return $this->responseError([], $e->getMessage());
     
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
    }
}
