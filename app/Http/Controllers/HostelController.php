<?php

namespace App\Http\Controllers;

use App\Models\Hostel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HostelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hostel.create');
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
            'name' => 'required',
            'institution' => 'required|numeric',
            'hosteltype' => 'required|numeric',
            'description' => 'required|string|',
            'address' => 'required|string',
            'price' => 'required|numeric',
            'photos'  => 'required',
            'photos.*'  => 'image|mimes:png,jpg,jpeg|max:1024',
        ]);


        $inputs = $request->all();
        $inputs['institution_id'] = $request->get('institution');
        $inputs['hosteltype_id'] = $request->get('hosteltype');
        $inputs['user_id'] = Auth::user()->id;        

        if ($files = $request->file('photos')) {
            $hostel = Hostel::create($inputs);
            foreach ($files as $file) {
                $name = date('Y_m_d_his') . $file->getClientOriginalName();
                $file->move('images/hostels', $name);
                $hostel->photos()->create(['path' => $name]);
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hostel  $hostel
     * @return \Illuminate\Http\Response
     */
    public function show(Hostel $hostel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hostel  $hostel
     * @return \Illuminate\Http\Response
     */
    public function edit(Hostel $hostel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hostel  $hostel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hostel $hostel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hostel  $hostel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hostel $hostel)
    {
        //
    }
}
