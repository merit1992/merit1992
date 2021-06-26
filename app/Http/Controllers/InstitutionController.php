<?php

namespace App\Http\Controllers;

use App\Models\institution;
use Illuminate\Http\Request;

class InstitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $institutions= institution::latest()->paginate(5);

        return view('institutions.index', compact('institutions'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('institutions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'state_id'=>'required'
        ]);
        institution::create($request->all());

        return redirect()->route('institutions.index')
            ->with('status');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function show(institution $institution)
    {
        return view('institutions.show', compact('institution'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function edit(institution $institution)
    {
        return view('institutions.edit', compact('institution'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, institution $institution)
    {
        $request->validate([
            'name'=>'required',
            'state_id'=>'required'
        ]);
        
        institution::update($request->all());
        
        return redirect()->route('institutions.index')
            ->with('status', 'updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function destroy(institution $institution)
    {
        $institution->delete();

        return redirect()->route('institutions.index')
            ->with('status', 'deleted successfully');
    }
}
