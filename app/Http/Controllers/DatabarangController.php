<?php

namespace App\Http\Controllers;

use App\Models\databarang;
use App\Models\kategory;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Storage;
use Illuminate\Support\Str;

class DatabarangController extends Controller
{
    public function index()
    {
        $databarang = databarang::with('kategory')->select('nama_barang','foto_barang','stok','harga_barang','status_barang'
        ,'barcode','id_kategory','id_barang','harga_pembelian')->paginate(10);
        $kategory = kategory::all();
       return view('admin.databarang.indexbarang',compact('databarang','kategory'));
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
        return view('admin.databarang.printlabelharga',compact('data','jumlah'));
    }
    public function printbarcode(Request $request,$id)
    {
      $data = databarang::findOrFail($id);
      $jumlah = $request->jumlah;
      return view('admin.databarang.printbarcodebarang',compact('data','jumlah'));
    }
    public function store(ProductRequest $request)
    {
        if ($request->foto_barang == null) {
            $validate = $request->safe()->except(['foto_barang']);
            $data = databarang::create([
            'id_barang' => Str::uuid()->toString(),
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
                ->with('error', 'Gagal Menyimpan Data')
                ->withInput();
            }
        } else {
             $validate = $request->validate();
             $data = databarang::create([
            'id_barang' => Str::uuid()->toString(),
            'nama_barang' => $request->nama_barang,
            'foto_barang' => $request->file('foto_barang')->store('images'),
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
                ->with('danger', 'Gagal Menyimpan Data')
                ->withInput();
            }
        }
        
    }
    public function update(Request $request, $databarang)
    {
       
        if ($request->foto_barang == null) {
            $validate = $request->validate([
                'nama_barang' => 'required|string|max:255',
                'stok' => 'required|min:1',
                'id_kategory' => 'required',
                 'barcode' => 'required',
            ]);
            $data = databarang::findOrFail($databarang);
            $data->update([
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
                ->with('error', 'Gagal Menyimpan Data')
                ->withInput();
            }
        } 
            else {
                $validate = $request->validate([
                    'nama_barang' => 'required|string|max:255',
                    'foto_barang' => 'image|max:10240|mimes:jpg,jpeg,png,svg',
                    'stok' => 'required|min:1',
                    'id_kategory' => 'required',
                     'barcode' => 'required',
                ]);
             $data = databarang::findOrFail($databarang);
            Storage::delete($data->foto_barang);
            $data->update([
            'nama_barang' => $request->nama_barang,
            'foto_barang' => $request->file('foto_barang')->store('images'),
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
                ->with('error', 'Gagal Menyimpan Data')
                ->withInput();
            }
        }
    }
    public function show($databarang)
    {
        $data = databarang::with('kategory')->findOrFail($databarang);
        $kategory = kategory::all();

        return view('admin.databarang.detailbarang',compact('data','kategory'));
    }
    public function edit($databarang)
    {
        $data = databarang::with('kategory')->findOrFail($databarang);
        $kategory = kategory::all();
        return view('admin.databarang.editbarang',compact('data','kategory'));
    }
    public function destroy($databarang)
    {
        $data = databarang::findOrFail($databarang);
        if ($data->foto_barang != null) {
        Storage::delete($data->foto_barang);
        $data->delete();
        }else{
            $data->delete();
        }
        return redirect()->route('databarang.index')->with('success', 'Data Berhasil Di Hapus');
    }
    public function filter(Request $request)
    {
        if ($request->filter == 'aktif') {
            $databarang = databarang::with('kategory')->select('nama_barang','foto_barang','stok','harga_barang','status_barang','barcode','id_kategory','id_barang','harga_pembelian')->where('status_barang','aktif')->paginate(10);
            $kategory = kategory::all();
            return view('admin.databarang.indexbarang',compact('databarang','kategory'));
        } elseif($request->filter == 'tidak_aktif') {
            $databarang = databarang::with('kategory')->select('nama_barang','foto_barang','stok','harga_barang','status_barang','barcode','id_kategory','id_barang','harga_pembelian')->where('status_barang','tidak_aktif')->paginate(10);
            $kategory = kategory::all();
            return view('admin.databarang.indexbarang',compact('databarang','kategory'));
        }elseif($request->filter == 'stok_kosong'){
            $databarang = databarang::with('kategory')->select('nama_barang','foto_barang','stok','harga_barang','status_barang','barcode','id_kategory','id_barang','harga_pembelian')->where('stok','0')->paginate(10);
            $kategory = kategory::all();
            return view('admin.databarang.indexbarang',compact('databarang','kategory'));
        }elseif($request->filter == 'semua'){
            $databarang = databarang::with('kategory')->select('nama_barang','foto_barang','stok','harga_barang','status_barang','barcode','id_kategory','id_barang','harga_pembelian')->paginate(10);
            $kategory = kategory::all();
            return view('admin.databarang.indexbarang',compact('databarang','kategory'));
        }
    }
    public function search(Request $request)
    {
        $databarang = databarang::with('kategory')->select('nama_barang','foto_barang','stok','harga_barang','status_barang','barcode','id_kategory','id_barang','harga_pembelian')
            ->where('nama_barang','like','%'.$request->search.'%')
            ->Orwhere('stok',$request->search)
            
            ->paginate(10);
            $kategory = kategory::all();
            return view('admin.databarang.indexbarang',compact('databarang','kategory'));
    }
    public function filterkategory(Request $request)
    {
        $kategory = $databarang = databarang::with('kategory')->select('nama_barang','foto_barang','stok','harga_barang','status_barang','barcode','id_kategory','id_barang','harga_pembelian')->where('id_kategory',$request->filter)->paginate(10);
       $kategory = kategory::all();
            return view('admin.databarang.indexbarang',compact('databarang','kategory'));
    }

}

