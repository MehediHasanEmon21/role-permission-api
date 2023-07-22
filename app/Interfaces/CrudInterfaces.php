<?php

namespace App\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CrudInterfaces
{
    public function getAll(array $filterData): LengthAwarePaginator;

    public function create(array $data): ?object;

    public function findById(int $id): ?object;

    public function update(array $data, int $id): ?object;

    public function delete(int $id): ?object;
}
