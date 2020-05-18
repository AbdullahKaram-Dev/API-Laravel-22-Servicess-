<?php

namespace App\Http\Controllers;

use App\Models\Governorate;
use Illuminate\Http\Request;

class GovernorateController extends Controller
{
    public function index()
    {
        $records = Governorate::paginate(20);
        return view('back-end.governorates.index', compact('records'));
    }


    public function create()
    {

    }


    public function store(Request $request)
    {

    }


    public function show($id)
    {

    }


    public function edit($id)
    {
        $record = Governorate::findOrFail($id);
        return view('back-end.governorates.edit', compact('record'));
    }


    public function update($id, Request $request)
    {
        Governorate::where('id',$id)->update(['name'=>$request->name]);
        return redirect('Governorate');
    }


}

?>