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



    public function update(Request $request, $id){
        $this->typeHandicapRepositoryHome->update($request, $id);
        return redirect()->route('typeHandicap.index');
    }



    public function store(Request $request){
        $this->typeHandicapRepositoryHome->store($request);
        return redirect()->route('typeHandicap.index')->with('success', 'product added successfully');
    }


 

    public function edit($id)
    {
        $type_handicap =  $this->typeHandicapRepositoryHome->edit($id);
        return view('type handicap.edit', compact('type_handicap'));
    }

    

    public function show($id)
    {
        $type_handicap =  $this->typeHandicapRepositoryHome->show($id);
        return view('type handicap.view', compact('type_handicap'));
    }


    public function destroy($id)
    {
        $this->typeHandicapRepositoryHome->destroy($id);
        return redirect('typeHandicap');
    }

   
    public function create(){
        return view('type handicap.create');
    }





    
    
    
    
    
    

    
    
    
    
    










    
    
    
        // public function filter(Request $request)
        // {
        //     // Retrieve filter parameters from the request
        //     $filterParam = $request->input('filterParam');
            
        //     // Perform filtering logic based on $filterParam
        //     $filteredData = type_handicap::where('nom', $filterParam)->get();
            
        //     // Return filtered data
        //     return response()->json($filteredData);
        // }
        
    

    // New method for handling search
    // public function search(Request $request)
    // {
    //     $keyword = $request->input('table_search');
    //     $data = $this->typeHandicapRepository->search($keyword);
        

    //     return view('type handicap.index', compact('data'));
    // }


    // public function search(Request $request)
    // {
    //     $keyword = $request->input('table_search');
    //     $dataoo = $this->typeHandicapRepository->search($keyword);
    
    //     return response()->json($dataoo);
    // }

  





 

   

}
