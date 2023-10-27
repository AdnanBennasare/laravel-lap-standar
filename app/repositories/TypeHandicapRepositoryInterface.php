<?php

namespace App\Repositories;

interface TypeHandicapRepositoryInterface
{
    public function all();
    public function search($keyword);
}

