<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\type_handicap;

class TypeHandicapRepository implements TypeHandicapRepositoryInterface
{
    public function all()
    {
        return type_handicap::paginate(4);
        
    }

    // public function search($keyword)
    // {
    //     return type_handicap::where('type_handicaps', 'LIKE', "%$keyword%")
    //         ->paginate(4);
    // }

    
    public function update(Request $request, $id){

        $request->validate([
            'type_handicap' => 'required|string',
            'description' => 'required|string',
        ]);

        $type_handicap = type_handicap::find($id);
        $type_handicap->nom = $request->type_handicap;
        $type_handicap->description = $request->description;
        $type_handicap->save();
    }

    
    public function store(Request $request){

        $request->validate([
            'type_handicap' => 'required|string',
            'description' => 'required|string',
        ]);

        $type_handicap = new type_handicap;
        $type_handicap->nom = $request->type_handicap;
        $type_handicap->description = $request->description;
        $type_handicap->save();
    }

    public function edit($id)
    {
        return type_handicap::find($id);
    }

    public function show($id)
    {
      return type_handicap::find($id);

    }

    public function destroy($id)
    {
        return type_handicap::find($id)->delete();

    }

    
}

