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
        $datakategory = kategory::withCount('databarang')->get();
         if(count($datakategory) == 0){
          return response()->json(['message' => 'Tidak Ada Data'],401);
         }else{
          return response()->json(KategoryResource::collection($datakategory));
         }
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
            return response()->json(['message' => 'Data Berhasil Ditambahkan'],200);
        } else {
            return response()->json(['message' => 'Gagal Menyimpan Data'], 401);
        }        
    }

    public function show($id)
    {
        $data = kategory::findOrFail($id);
        if($data){            
         return response()->json(new KategoryResource($data), 200);
        }else{
            return response()->json(['message' => 'Data Tidak Ada Di database'], 401);
        }
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
            return response()->json(['message' => 'Data Berhasil Diubah'], 200);
        } else {
            return response()->json(['message' => 'Gagal Menyimpan Data'], 401);
        }  
    }

    public function destroy($id)
    {
        $data = kategory::findOrFail($id);
        $data->delete();
        if ($data) {
          return response()->json(['message' => 'Data Berhasil Dihapus'], 200);
        }else{
            return response()->json(['message' => 'Gagal Hapus Data'], 401);
        }
    }

    public function search(Request $request)
    {
        $datakategory = kategory::select('nama_kategory','id_kategory')
            ->where('nama_kategory','like','%'.$request->search.'%')
            ->paginate(10);
        if(count($datakategory) == 0){
          return response()->json(['message' => 'Tidak Ada Data Dalam database'],401);
         }else{
          return response()->json(KategoryResource::collection($datakategory));
         }
    }
}
