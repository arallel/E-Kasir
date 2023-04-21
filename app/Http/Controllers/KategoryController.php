<?php

namespace App\Http\Controllers;

use App\Models\kategory;
use Illuminate\Http\Request;

class KategoryController extends Controller
{
    public function index()
    {
        $datakategory = kategory::select('nama_kategory','id_kategory')->paginate(10);
        return view('admin.kategory.indexkategory',compact('datakategory'));
    }
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
    public function edit($kategory)
    {
        $data = kategory::findOrFail($kategory);
      return view('admin.kategory.editkategory',compact('data'));

    }
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
            
            ->paginate(10);
            return view('admin.kategory.indexkategory',compact('datakategory'));
    }
}
