<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\databarang;
use App\Models\transaksi_barang;
use App\Http\Resources\DatabarangResource;
use App\Http\Resources\databarangcollectionresource;
use Illuminate\Support\Str;
use Carbon\Carbon;
use DB;
use Storage;
use Image;

class DatabarangApi extends Controller
{ 
    public function getitembybarcode(Request $request){
        $barcode = $request->barcode;
        $databarang = Databarang::with('checkpotongan','kategory')->where('barcode',$request->barcode)->first();
        if($databarang != null){
          return response()->json(new databarangcollectionresource($databarang));
      }
      else
      {
        return response()->json(['message' => 'data Kosong']);
      }  
    }   
    public function getitembyname(Request $request){
     $nama_barang = $request->nama_barang;
     $databarang = Databarang::with('checkpotongan','kategory')->where('nama_barang',$nama_barang)->first();
     return response()->json(new databarangcollectionresource($databarang));
    }
    public function index(Request $request){
        if($request->search||$request->status_barang || $request->id_kategory || $request->urutkan_by_name || $request->urutkan_by_stok || $request->urutkan_by_datetoday){
            $search = $request->search;
            $status = $request->status_barang;
            $id_category = $request->id_kategory;
            $urutkan_by_name = $request->urutkan_by_name;
            $urutkan_by_stok = $request->urutkan_by_stok;
            $urutkan_by_datetoday = $request->urutkan_by_datetoday;

            $query = databarang::with('kategory','detailtransaksi');

            $emptyQueries = true;
            $jenisurut = '';
            $urut_by = '';
            if($urutkan_by_name != null){
               switch ($urutkan_by_name){
                case 'asc':
                $urut_by = 'nama_barang';
                $jenisurut = 'asc';
                break;
                case 'desc':
                $urut_by = 'nama_barang';
                $jenisurut = 'desc';
                break;
                default:
                $urut_by = 'nama_barang';
                $jenisurut = 'asc';
                break;
                }
            }
            elseif($urutkan_by_stok != null){
             switch ($urutkan_by_stok){
                case 'asc':
                $urut_by = 'stok';
                $jenisurut = 'asc';
                break;
                case 'desc':
                $urut_by = 'stok';
                $jenisurut = 'desc';
                break;
                default:
                $urut_by = 'stok';
                $jenisurut = 'asc';
                break;
                }
            }
            elseif($urutkan_by_datetoday != null){
             switch ($urutkan_by_datetoday){
                case 'asc':
                $urut_by = 'created_at';
                $jenisurut = 'asc';
                break;
                case 'desc':
                $urut_by = 'created_at';
                $jenisurut = 'desc';
                break;
                default:
                $urut_by = 'created_at';
                $jenisurut = 'asc';
                break;
                }
            }
            else{
                $urut_by = 'stok';
                $jenisurut = 'asc';
            }

            if (!empty($search)) {
                $query->where('nama_barang', 'like', '%' . $search . '%');
                $emptyQueries = false;
            }

            if (!empty($status)) {
                $query->where('status_barang', $status);
                $emptyQueries = false;
            }

            if (!empty($id_category)) {
                $query->where('id_kategory', $id_category);
                $emptyQueries = false;
            }

            if ($emptyQueries) {
                $results = $query->orderBy($urut_by,$jenisurut)->get();
                return response()->json(DatabarangResource::collection($results),200);
            } else {
                $results = $query->orderBy('id_barang',$jenisurut)->get();
                return response()->json(DatabarangResource::collection($results),200);
            }
        }else{
            $results = databarang::with('kategory')->orderBy('id_barang','asc')->get();
            return response()->json(DatabarangResource::collection($results),200);
        }
    }
    public function show($databarang){
    $databarang = databarang::with('kategory','detailtransaksi')->find($databarang);
    if($databarang != null){
    return new DatabarangResource($databarang);
    }else{
        return response()->json(['message' => 'gagal menampilkan Barang'],404);
    }
    }
public function store(Request $request){
if($request->foto_barang)
{
      $image = $request->file('foto_barang');
      $input['imagename'] = 'fotobarang-'.date('d-m-y').time().'.'.$image->extension();
      $destinationPath = storage_path('app/images');
      $img = Image::make($image->path());
      $img->resize(1200, 1200, function ($constraint) {
          $constraint->aspectRatio();
                    // $constraint->upsize();
      })->save($destinationPath.'/'.$input['imagename']);
  }
  $lastbarang = databarang::orderBy('id_transaksi','asc')->count();
  $prefix = 'A';
  $lastInvoiceNumber = $lastbarang + 1; 
  $kodebarang = $prefix . sprintf('%04d', $lastInvoiceNumber);
  $data = databarang::create([
    'id_barang' => $kodebarang,
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
    return response()->json(['message' => 'Berhasil Menambahkan Barang'], 200);
 } else {
    return response()->json(['message' => 'Gagal Menambahkan Barang'], 401);
 }
}
public function update(Request $request, $databarang){
    $data = databarang::findOrFail($databarang);
    if($data == null){
        return response()->json(['Data Tidak Ada'],404);
    }
    if($request->foto_barang && Storage::exists($data->foto_barang))
    {
        Storage::delete($data->foto_barang);
        $image = $request->file('foto_barang');
        $input['imagename'] = 'fotobarang-'.date('d-m-y').time().'.'.$image->extension();
        $destinationPath = storage_path('app/images');
        $img = Image::make($image->path());
        $img->resize(1200, 1200, function ($constraint) {
            $constraint->aspectRatio();
                    // $constraint->upsize();
        })->save($destinationPath.'/'.$input['imagename']);
    }
    $data->update([
        'nama_barang' => $request->nama_barang,
        'stok' => $request->stok,
        'foto_barang' => ($request->foto_barang)?'images/'.$img->basename:null,
        'id_kategory' => $request->id_kategory,
        'status_barang' => $request->status_barang,
        'barcode' => $request->barcode,
        'harga_barang' => $request->harga_barang,
        'harga_pembelian' => $request->harga_pembelian,
    ]);
    if ($data) {
        return response()->json(['message' => 'Berhasil Merubah Data Barang'], 200);
    } else {
        return response()->json(['message' => 'Gagal Update Data Barang'], 401);
    }
}
public function destroy($databarang){
    $data = databarang::findOrFail($databarang);
    if ($data->foto_barang != null) {
        Storage::delete($data->foto_barang);
        $data->delete();
    }else{
        $data->delete();
    }
    if ($data) {
        return response()->json(['message' => 'Barang Berhasil Dihapus'], 200);
    } else {
        return response()->json(['message' => 'Gagal Hapus Data Barang'], 401);
    }
}
public function chartpenjualan(){
    $startDate = Carbon::now()->startOfMonth();
    $endDate = Carbon::now()->endOfMonth();
    $datenow = Carbon::now();

    $databulanan = transaksi_barang::whereBetween('tgl_transaksi', [$startDate, $endDate])
    ->groupBy('tgl_transaksi')
    ->orderBy('tgl_transaksi')
    ->get([
        DB::raw('DATE(tgl_transaksi) as date'),
        DB::raw('SUM(total_pembayaran) as total')
    ]);
    $datamingguan = transaksi_barang::whereBetween('tgl_transaksi', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
    ->groupBy('tgl_transaksi')
    ->orderBy('tgl_transaksi')
    ->get([
        DB::raw('DATE(tgl_transaksi) as date'),
        DB::raw('SUM(total_pembayaran) as total')
    ]);

    $total_bulanan = transaksi_barang::whereBetween('tgl_transaksi', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
    ->sum('total_pembayaran');

    $total_mingguan = transaksi_barang::whereBetween('tgl_transaksi', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
    ->sum('total_pembayaran');

    return response()->json([
        'databulanan' => $databulanan,
        'datamingguan' => $datamingguan,
        'total_bulanan' => $total_bulanan,
        'total_mingguan' => $total_mingguan
    ]);
}
}
