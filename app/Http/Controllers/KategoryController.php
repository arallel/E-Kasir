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
        $datakategory = kategory::select('nama_kategory','id_kategory')->limit(100)->paginate(10);
        return view('admin.kategory.indexkategory',compact('datakategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     return view('admin.kategory.kategorycreate');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
         'nama_kategory' => 'required|unique:kategory',
         ], [
          'nama_kategory.unique' => 'Kategory dengan nama yang sama sudah ada.',
        ]);
        $data = kategory::create([
            'nama_kategory' => $request->nama_kategory,
        ]);

        if ($data) {
          return redirect()->route('Kategory.index')->with('success', 'Data Berhasil Disimpan');;
        } else {
            return redirect()
                ->back()
                ->withErrors($validate)
                ->with('danger', 'Gagal Menyimpan Data')
                ->withInput();
        }        
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
      return view('admin.kategory.editkategory',compact('data'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\kategory  $kategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$kategory)
    { 
        $request->validate([
         'nama_kategory' => 'required|unique:kategory',
         ], [
          'nama_kategory.unique' => 'Kategory dengan nama yang sama sudah ada.',
        ]);

        $data = kategory::findOrFail($kategory);

        $data->update([
            'nama_kategory' => $request->nama_kategory,
        ]);

        if ($data) {
          return redirect()->route('Kategory.index')->with('success', 'Data Berhasil Disimpan');;
        } else {
            return redirect()
                ->back()
                ->withErrors($validate)
                ->with('danger', 'Gagal Menyimpan Data')
                ->withInput();
        }  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\kategory  $kategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($kategory)
    {
        $data = kategory::findOrFail($kategory);
        $data->delete();
        return redirect()->route('Kategory.index');
    }
    public function search(Request $request)
    {
        $datakategory =kategory::select('nama_kategory','id_kategory')
            ->where('nama_kategory','like','%'.$request->search.'%')
            ->limit(100)
            ->paginate(10);
            return view('admin.kategory.indexkategory',compact('datakategory'));
    }
}
