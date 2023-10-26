<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\type_handicap;



class type_handicapController extends Controller
{
    //
    public function index(){
        $data = type_handicap::all();
        return view('type handicap.index', compact('data'));
    }

    public function create(){
        return view('type handicap.create');
    }


    public function store(Request $request){

        $validatedData = $request->validate([
            'type_handicap' => 'required|string',
            'description' => 'required|string',
        ]);

        $type_handicap = new type_handicap;
        $type_handicap->nom = $request->type_handicap;
        $type_handicap->description = $request->description;
        $type_handicap->save();
        return redirect()->route('typeHandicap.index')->with('success', 'product added successfully');

        // return view('type handicap.create');
    }

    public function edit($id)
    {
        $type_handicap = type_handicap::find($id);
        return view('type handicap.edit', compact('type_handicap'));
    }

    

    public function update(Request $request, $id){

        $validatedData = $request->validate([
            'type_handicap' => 'required|string',
            'description' => 'required|string',
        ]);

        $type_handicap = type_handicap::find($id);
        $type_handicap->nom = $request->type_handicap;
        $type_handicap->description = $request->description;
        $type_handicap->save();
        return redirect()->route('typeHandicap.index');
    }

    public function destroy($id)
    {
        $delete = type_handicap::find($id)->delete();
        return redirect('typeHandicap');

    }

    public function show($id)
    {
        $type_handicap = type_handicap::find($id);
        return view('type handicap.view', compact('type_handicap'));
    }

}
