<?php

namespace App\Repositories;

use App\Models\type_handicap;

class TypeHandicapRepository implements TypeHandicapRepositoryInterface
{
    public function all()
    {
        return type_handicap::paginate(4);
        
    }

    public function search($keyword)
    {
        return type_handicap::where('type_handicaps', 'LIKE', "%$keyword%")
            ->paginate(4);
    }

    
}

