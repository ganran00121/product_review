<?php

namespace App\Repositories\Product;


interface ProductRepositoryInterface {
    public function getAll();
    public function paginate(int $perPage = 12);
    public function find(int $id);
    public function create(array $data);
    
}

