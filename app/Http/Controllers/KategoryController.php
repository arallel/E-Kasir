<?php

namespace App\Http\Controllers;

use App\Models\kategory;
use Illuminate\Http\Request;

class KategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.kategory.kategoryindex');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kategory.kategorycreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect()->route('kategory.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\kategory  $kategory
     * @return \Illuminate\Http\Response
     */
    public function show(kategory $kategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\kategory  $kategory
     * @return \Illuminate\Http\Response
     */
    public function edit($kategory)
    {
        $data = kategory::findOrFail($kategory);
      return view('admin.kategory.kategoryedit',compact('data'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\kategory  $kategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, kategory $kategory)
    {

        $data = kategory::findOrFail($kategory);


        return redirect()->route('kategory.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\kategory  $kategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(kategory $kategory)
    {
        $data = kategory::findOrFail($kategory);
        $data->delete();
        return redirect()->route('kategory.index');
    }
}
