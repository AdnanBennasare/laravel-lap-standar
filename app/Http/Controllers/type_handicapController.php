<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\type_handicap;

use App\Repositories\TypeHandicapRepositoryInterface;

class type_handicapController extends Controller
{

    private $typeHandicapRepositoryHome;
    //

    public function __construct(TypeHandicapRepositoryInterface $typeHandicapRepository)
    {
        $this->typeHandicapRepositoryHome = $typeHandicapRepository;
    }

    public function index()
    {
        $data = $this->typeHandicapRepositoryHome->all();
        return view('type handicap.index', compact('data'));
    }


    // New method for handling search
    public function search(Request $request)
    {
        $keyword = $request->input('table_search');
        $data = $this->typeHandicapRepository->search($keyword);
        

        return view('type handicap.index', compact('data'));
    }


    // public function search(Request $request)
    // {
    //     $keyword = $request->input('table_search');
    //     $dataoo = $this->typeHandicapRepository->search($keyword);
    
    //     return response()->json($dataoo);
    // }

    

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
