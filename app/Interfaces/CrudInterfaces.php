<?php

namespace App\Interfaces;

use Illuminate\Contracts\Pagination\Paginator;
use PhpParser\Node\Expr\Cast\Object_;

interface CrudInterfaces {

    // public function getAll(): Paginator;

    public function create(array $data): object|null;

    // public function findById(object $model): object|null;

    // public function update(array $data, object $model): object|null;

    // public function delete(object $model): object|null;

    
}