@extends('admin.layout.main')
@section('title', 'Data Barang')
@section('content')
<div class="nk-content-inner">
    <div class="nk-content-body">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">Catatan Transaksi No: {{ $data->no_transaksi }}</h3>
                       <a href="{{ route('Catatan-transaksi.index') }}" class="btn btn-primary"><em class="icon ni ni-chevron-left"></em><span>Kembali</span></a>
                </div><!-- .nk-block-head-content -->
                <div class="nk-block-head-content">
                    <div class="toggle-wrap nk-block-tools-toggle">
                        <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em
                            class="icon ni ni-more-v"></em></a>
                            <div class="toggle-expand-content" data-content="pageMenu">
                                <ul class="nk-block-tools g-3"> 
                                </ul>
                            </div>
                        </div>
                    </div><!-- .nk-block-head-content -->
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->
            <div class="nk-block">
                <div class="card">
                    <div class="card-inner-group">
                        <div class="card-inner ">
                        	<div class="container">
                        		<div class="row">
                        			<div class="col-4 mt-2">
                        			  <div class="form-group">
                                        <label class="form-label" for="kode_promo">No Invoice</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control"
                                             value="{{ $data->no_transaksi }}" disabled>
                                        </div>
                                      </div>
                        			</div>
                                    <div class="col-4 mt-2">
                        			  <div class="form-group">
                                        <label class="form-label" for="kode_promo">Kasir Yang Bertugas</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control"
                                             value="{{ $data->user->nama_pengguna }}" disabled>
                                        </div>
                                      </div>
                        			</div>
                                    @if($data->no_pesanan && $data->no_resi)
                                    <div class="col-4 mt-2">
                                      <div class="form-group">
                                        <label class="form-label" for="kode_promo">No Pesanan</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control"
                                             value="{{ $data->no_pesanan }}" disabled>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-4 mt-2">
                                      <div class="form-group">
                                        <label class="form-label" for="kode_promo">No Resi</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control"
                                             value="{{ $data->no_resi }}" disabled>
                                        </div>
                                      </div>
                                    </div>
                                    @endif
                                    @if($data->uang_dibayarkan)
                                    <div class="col-4 mt-2">
                        			  <div class="form-group">
                                        <label class="form-label" for="kode_promo">Uang Dibayarkan Oleh Pembeli</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control"
                                             value="{{ $data->uang_dibayarkan }}" disabled>
                                        </div>
                                      </div>
                        			</div>
                                    @endif
                                    <div class="col-4 mt-2">
                        			  <div class="form-group">
                                        <label class="form-label" for="kode_promo">Total Harga Semua Barang</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control"
                                             value="{{ $data->total_pembayaran }}" disabled>
                                        </div>
                                      </div>
                        			</div>
                                    @if($data->total_kembalian)
                                    <div class="col-4 mt-2">
                        			  <div class="form-group">
                                        <label class="form-label" for="kode_promo">Kembalian Yang Diterima Pengguna</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control"
                                             value="{{ $data->total_kembalian }}" disabled>
                                        </div>
                                      </div>
                        			</div>
                                    @endif
                                    <div class="col-2 mt-2">
                        			  <div class="form-group">
                                        <label class="form-label" for="kode_promo">Tanggal Transaksi</label>
                                        <div class="form-control-wrap">
                                            <input type="date" class="form-control"
                                             value="{{ $data->tgl_transaksi }}" disabled>
                                        </div>
                                      </div>
                        			</div><div class="col-2 mt-2">
                                      <div class="form-group">
                                        <label class="form-label" for="kode_promo">Jam  Transaksi</label>
                                        <div class="form-control-wrap">
                                            <input type="time" class="form-control"
                                             value="{{ $data->waktu_transaksi }}" disabled>
                                        </div>
                                      </div>
                                    </div>
                        		</div>
                                <h4 class="mt-4 text-center">Barang Yang Di Beli</h4>
                                <table class="datatable-init nk-tb-list nk-tb-ulist mt-3" data-auto-responsive="false">
                                    <thead>
                                        <tr class="nk-tb-item nk-tb-head">
                                            <th class="nk-tb-col ">
                                                <span class="sub-text">No</span>
                                            </th>
                                            <th class="nk-tb-col"><span class="sub-text">Nama Barang</span></th>
                                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Quantity</span></th>
                                            <th class="nk-tb-col tb-col-md"><span class="sub-text">Harga Per Item</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data->detailtransaksi as $item)
                                        <tr class="nk-tb-item">
                                            <td class="nk-tb-col ">
                                               <span class="sub-text">{{ $loop->iteration }}</span>
                                            </td>
                                            <td class="nk-tb-col">
                                                <span class="sub-text">{{ ($item->databarang != null)?$item->databarang->nama_barang:'Barang DI Hapus ' }}</span>
                                            </td>
                                            <td class="nk-tb-col tb-col-mb">
                                                <span class="sub-text">{{ $item->qty }}</span>
                                            </td>
                                            <td class="nk-tb-col tb-col-md">
                                                <span class="sub-text">Rp.{{ $item->harga_item }}</span>
                                            </td>
                                        </tr><!-- .nk-tb-item  -->  
                                        @endforeach 
                                    </tbody>
                                </table>
                        	</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection