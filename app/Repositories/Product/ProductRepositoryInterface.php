<?php

namespace App\Repositories\Product;


interface ProductRepositoryInterface {
    public function getAll();
    public function paginate(int $perPage = 12);
    public function update(int $id, array $data);
    public function find(int $id);
    public function create(array $data);
    public function delete(int $id);
    
}

