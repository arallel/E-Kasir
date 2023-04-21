<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\KategoryResource;
use App\Models\kategory;


class KategoryApi extends Controller
{
     public function index()
    {
        $datakategory = kategory::select('nama_kategory','id_kategory')->paginate(10);
        return KategoryResource::collection($datakategory);
        // return response()->json(['data' => $datakategory], 200);
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
            return response()->json(['message' => 'Data Berhasil Disimpan'], 201);
        } else {
            return response()->json(['message' => 'Gagal Menyimpan Data'], 400);
        }        
    }

    public function show($id)
    {
        $data = kategory::findOrFail($id);
        return response()->json(['data' => $data], 200);
    }

    public function update(Request $request,$id)
    { 
        $request->validate([
            'nama_kategory' => 'required|unique:kategory,nama_kategory,'.$id.',id_kategory',
        ], [
            'nama_kategory.unique' => 'Kategory dengan nama yang sama sudah ada.',
        ]);

        $data = kategory::findOrFail($id);

        $data->update([
            'nama_kategory' => $request->nama_kategory,
        ]);

        if ($data) {
            return response()->json(['message' => 'Data Berhasil Disimpan'], 200);
        } else {
            return response()->json(['message' => 'Gagal Menyimpan Data'], 400);
        }  
    }

    public function destroy($id)
    {
        $data = kategory::findOrFail($id);
        $data->delete();
        return response()->json(['message' => 'Data Berhasil Dihapus'], 200);
    }

    public function search(Request $request)
    {
        $datakategory = kategory::select('nama_kategory','id_kategory')
            ->where('nama_kategory','like','%'.$request->search.'%')
            ->paginate(10);
        return response()->json(['data' => $datakategory], 200);
    }
}
