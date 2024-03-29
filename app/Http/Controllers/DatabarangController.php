<?php

namespace App\Http\Controllers;

use App\Models\databarang;
use App\Models\kategory;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Storage;
use Illuminate\Support\Str;
use Image;
use Illuminate\Validation\Rule;

class DatabarangController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
    $status = $request->status;
    $id_category = $request->kategory;
    $urutkan = $request->urutkan;

    $query = databarang::with('kategory');
    $kategory = kategory::get();

    $emptyQueries = true; // Flag to check if all queries are empty

    $orderBy = '';
    switch ($urutkan) {
        case 'asc':
            $orderBy = 'asc';
            break;
        case 'desc':
            $orderBy = 'desc';
            break;
        default:
            $orderBy = 'asc';
            break;
    }

    if (!empty($search)) {
        $query->where('nama_barang', 'like', '%' . $search . '%');
        $emptyQueries = false;
    }

    if (!empty($status)) {
        if($status == 'semua'){}
        if($status == 'tidak_tersedia'){
            $query->where('status_barang', 'tidak_aktif');
        }
        if($status == 'tersedia'){
            $query->where('status_barang', 'aktif');
        }
        if($status == 'stok_kosong'){
            $query->where('stok', 0);
        }
        $emptyQueries = false;
    }

    if (!empty($id_category)) {
        $query->where('id_kategory', $id_category);
        $emptyQueries = false;
    }

    if ($emptyQueries) {
        $databarang = $query->orderBy('kode_barang',$orderBy)->get();
          return view('admin.databarang.indexbarang',compact('databarang','kategory'));
    } else {
       $databarang = $query->orderBy('kode_barang',$orderBy)->get();
          return view('admin.databarang.indexbarang',compact('databarang','kategory'));
    }   
    }
    public function create()
    {
     $kategory = kategory::all();
      return view('admin.databarang.indexbarang',compact('kategory'));

    }
    public function printlabel(Request $request,$id)
    {
        $data = databarang::findOrFail($id);
        $jumlah = $request->jumlah;
        if($jumlah == null && $data == null){abort(404);}
        return view('admin.databarang.printlabelharga',compact('data','jumlah'));
    }
    public function printbarcode(Request $request,$id)
    {
      $data = databarang::findOrFail($id);
      $jumlah = $request->jumlah;
      if($jumlah == null && $data == null){abort(404);}
      return view('admin.databarang.printbarcodebarang',compact('data','jumlah'));
    }
    public function store(ProductRequest $request)
    {
        $validate = $request->validate([
         'barcode' => 'required|unique:databarang,barcode',
         'kode_barang' => 'required|unique:App\Models\databarang,kode_barang',
        ], [
         'kode_barang.unique' => 'kode barang Sudah Ada.',
         'kode_barang.required' => 'kode barang harus diisi.',
         'barcode.required' => 'Kode barcode harus diisi.',
         'barcode.unique' => 'Kode barcode sudah digunakan.',
        ]);
        
        if($request->foto_barang){
             $image = $request->file('foto_barang');
             $input['imagename'] = 'fotobarang-'.date('d-m-y').time().'.jpg';
             $destinationPath = storage_path('app/images');
             $img = Image::make($image->path());
             $img->resize(1200, 1200, function ($constraint) {
             $constraint->aspectRatio();
                    // $constraint->upsize();
             })->save($destinationPath.'/'.$input['imagename']);
        }
        $data = databarang::create([
            'id_barang' => Str::uuid(),
            'kode_barang' => $request->kode_barang,
            'foto_barang' => ($request->foto_barang)?'images/'.$img->basename:null,
            'nama_barang' => $request->nama_barang,
            'stok' => $request->stok,
            'id_kategory' => $request->id_kategory,
            'status_barang' => 'aktif',
            'barcode' => $request->barcode,
            'harga_barang' => $request->harga_barang,
            'harga_pembelian' => $request->harga_pembelian,
        ]);
        if ($data) {
          return redirect()->route('databarang.index')->with('success', 'Data Berhasil Disimpan');
        } else {
          return redirect()
             ->back()
             ->withErrors($validate)
             ->withInput();
        }
    }
    public function update(ProductRequest $request, $databarang)
    {
        $validate = $request->validate([
         'barcode' => ['required', Rule::unique('App\Models\databarang')->ignore($request->barcode, 'barcode')],
         'kode_barang' => ['required', Rule::unique('App\Models\databarang')->ignore($request->kode_barang, 'kode_barang')],
        ], [
         'kode_barang.unique' => 'kode barang Sudah Ada.',
         'kode_barang.required' => 'kode barang harus diisi.',
         'barcode.required' => 'Kode barcode harus diisi.',
         'barcode.unique' => 'Kode Barcode Sudah Ada.',
        ]);
        $data = databarang::findOrFail($databarang);
        if($request->foto_barang)
        {
            if($data->foto_barang != null){
             Storage::delete($data->foto_barang);
            }
            $image = $request->file('foto_barang');
            $input['imagename'] = 'fotobarang-'.date('d-m-y').time().'.'.$image->extension();
            $destinationPath = storage_path('app/images');
            $img = Image::make($image->path());
            $img->resize(1200, 1200, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$input['imagename']);
        }
        if($data == null){abort(404);}
        $data->update([
            'nama_barang' => $request->nama_barang,
            'kode_barang' => $request->kode_barang,
            'stok' => $request->stok,
            'foto_barang' => ($request->foto_barang)?'images/'.$img->basename:null,
            'id_kategory' => $request->id_kategory,
            'status_barang' => $request->status_barang,
            'barcode' => $request->barcode,
            'harga_barang' => $request->harga_barang,
            'harga_pembelian' => $request->harga_pembelian,
        ]);
        if ($data) {
          return redirect()->route('databarang.index')->with('success', 'Data Berhasil Disimpan');
        } else {
          return redirect()
                ->back()
                ->withErrors($validate)
                ->with('error', 'Gagal Menyimpan Data')
                ->withInput();
        }
    }
    public function show($databarang)
    {
        $data = databarang::with('kategory')->findOrFail($databarang);
        $kategory = kategory::all();
        if($data == null && $kategory == null){abort(404);}
        return view('admin.databarang.detailbarang',compact('data','kategory'));
    }
    public function edit($databarang)
    {
        $data = databarang::with('kategory')->findOrFail($databarang);
        $kategory = kategory::all();
        if($kategory == null && $data == null){abort(404);}
        return view('admin.databarang.editbarang',compact('data','kategory'));
    }
    public function destroy($databarang)
    {
        $data = databarang::findOrFail($databarang);
        if($data == null){abort(404);}
        if ($data->foto_barang != null) {
        Storage::delete($data->foto_barang);
        $data->delete();
        }else{
            $data->delete();
        }
        return redirect()->route('databarang.index')->with('success', 'Data Berhasil Di Hapus');
    }
    public function addstok(Request $request,$id)
    {
        $data = databarang::findOrFail($id);
        if($data == null){abort(404);}
        if($data){
            $data->update([
                'stok' => $data->stok + $request->jumlah
            ]);
            return redirect()->route('databarang.index')->with('success', 'Stok Berhasil Ditambahkan');
        }else{
            return redirect()->route('databarang.index')->with('danger', 'Data Tidak Ditemukan Atau Hilang');
        }
    }
}

