<?php

namespace App\Repositories;

use Illuminate\Http\Request;

interface TypeHandicapRepositoryInterface
{
    public function all();
    // update function 
    public function update(Request $request, $id);
    // store function
    public function store(Request $request);

    // edit function
    
    public function edit($id);
    // show function

    public function show($id);
// destroy dunction 
    public function destroy($id);
   

    // public function search($keyword);


}

