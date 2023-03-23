@extends('admin.layout.main')
@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head-content mb-3">
                    <h3 class="nk-block-title page-title ">Tambah Diskon</h3>
                </div><!-- .nk-block-head-content -->
                <div class="col-6">
                    <div class="card">
                        <div class="card-inner">
                            @if ($errors->any())
                            <div class="alert alert-icon alert-danger" role="alert"> <em
                                class="icon ni ni-cross-circle"></em>
                                @foreach ($errors->default->all() as $error)
                                <strong>Error</strong>.{{ $error }}.
                                @endforeach
                            </div>
                            @endif
                            <div id="alert-container"></div>
                            <div class="row g-3">
                                {{-- <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="nama_barang">Nama Barang</label>
                                        <form action="{{ route('Diskon.search.edit',$data->id_diskon) }}" method="post" autocomplete="off">
                                            @csrf
                                            <div class="form-control-wrap">   
                                                <div class="input-group">        
                                                    <input type="text" name="cari_barang" class="form-control" value="{{ $data->databarang->nama_barang }}" id="cari_barang" placeholder="Cari Barang" required>
                                                    <div class="input-group-append">  
                                                        <button class="btn btn-primary"> <em class="icon ni ni-search"></em></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div> --}}
                                
                                <form action="{{ route('Diskon.update',$data->id_diskon) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('patch')
                                <input type="hidden" value="{{ $data->id_barang }}" id="id_barang"  name="id_barang">
                                  <input type="hidden" id="harga_setelah_potongan"  name="harga_setelah_potongan">

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="nama_diskon">Nama Diskon</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control"
                                            name="nama_diskon" value="{{ $data->nama_diskon }}" id="nama_diskon"
                                            placeholder="Nama Diskon" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="harga_potongan">Harga Potongan</label>
                                        <div class="form-control-wrap">    
                                            <div class="input-group">        
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Rp.</span>        
                                                </div>        
                                                <input type="number" value="{{ $data->harga_potongan }}" class="form-control" placeholder="Harga Potongan" name="harga_potongan" id="harga_potongan" required>    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="tgl_awal_diskon">
                                            Mulai Diskon
                                        </label>
                                        <div class="form-control-wrap">
                                            <input type="date" class="form-control"
                                            name="tgl_awal_diskon" value="{{ $data->tgl_awal_diskon }}" id="tgl_awal_diskon"
                                            placeholder="Nama Diskon" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="tgl_akhir_diskon">
                                            Tanggal Berakhir Diskon
                                        </label>
                                        <div class="form-control-wrap">
                                            <input type="date" class="form-control"
                                            name="tgl_akhir_diskon" value="{{ $data->tgl_akhir_diskon }}" id="tgl_akhir_diskon"
                                            placeholder="Nama Diskon" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="tgl_akhir_diskon">
                                            Status Diskon
                                        </label>
                                        <div class="form-control-wrap">
                                         <select class="form-select js-select2" 
                                         name="status_diskon">
                                             <option disabled>Status</option>
                                             <option value="aktif" {{ ($data->status_diskon == 'aktif') ? 'selected' : '' }}>Aktif</option>
                                             <option value="tidak_aktif" {{ ($data->status_diskon == 'tidak_aktif') ? 'selected' : '' }}>Tidak Aktif</option>
                                         </select>
                                     </div>
                                 </div>
                             </div>
                             <div class="mt-2">
                                <h6 id="harga_normal"></h6>
                                <h6 id="harga_baru"></h6>
                            </div>
                            <div class="row">
                                <div class="col-4 mt-3">
                                    <a href="{{ route('Diskon.index') }}" class="btn btn-secondary">Kembali</a> 
                                </div>
                                <div class="col-4 mt-3">
                                    <button class="btn btn-success" >Simpan  Data</button>   
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<div class="modal fade" tabindex="-1" id="modalTop">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal Title</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="col-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>no</th>
                                <th>nama barang</th>
                                <th>aksi</th>
                            </tr>
                        </thead>
                        <tbody>                 
                          @if($searchbarang)
                          @foreach($searchbarang as $barang)
                          <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $barang->nama_barang }}</td>
                            <td>        
                                <button onclick="pilihBarang({{ $loop->index }})"data-id="{{ $barang->id_barang }}" data-nama="{{ $barang->nama_barang }}" data-harga="{{ $barang->harga_barang }}" class="btn btn-success btn-pilih">pilih</button>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

        </div>
        <div class="modal-footer bg-light">
            <button data-bs-dismiss="modal" class="btn btn-secondary">Tutup</button>
        </div>
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    var hargaawal= {!! $data->databarang->harga_barang !!}
    var hargapotongan = document.getElementById('harga_potongan');
    var hargabaru = document.getElementById('harga_baru');
    window.onload = function(){
     var harganormal = document.getElementById('harga_normal').innerHTML = 
     'Harga Normal: Rp.'+ hargaawal; 
     var valuebarang = hargaawal;
     var valuepotongan = hargapotongan.value;
     var hitung = valuebarang - valuepotongan;
     var inputhargapotongan = document.getElementById('harga_setelah_potongan').value = hitung;
     if (valuebarang > valuepotongan || hitung >= 0) {
      hargabaru.innerHTML = 'Harga Baru Setelah Potongan: Rp.'+hitung;
  }else{
    alert('Harga Potongan Melebihi Harga Normal');
  }
}
 // $(document).ready(function() {
 //        @if ($show_modal)
 //        $('#modalTop').modal('show');
 //        @endif
 //    });

    hargapotongan.addEventListener("change", function(){
      var valuebarang = hargaawal;
      var valuepotongan = hargapotongan.value;
      var hitung = valuebarang - valuepotongan;
     var inputhargapotongan = document.getElementById('harga_setelah_potongan').value = hitung; 
      if (valuebarang > valuepotongan || hitung >= 0) {
          hargabaru.innerHTML = 'Harga Baru Setelah Potongan: Rp.'+hitung;
      }else{
        alert('Harga Potongan Melebihi Harga Normal');
    }
});A

// function pilihBarang(rowIndex) {
//    var namaBarang = $('table tbody tr:eq(' + rowIndex + ') td:eq(1)').html();
//    var button = document.getElementsByClassName('btn-pilih')[rowIndex];
//    var idbarang = button.getAttribute('data-id');
//    var namabarang = button.getAttribute('data-nama');
//    var inputidbarang = document.getElementById('id_barang').value = idbarang;
//    var namabarang = document.getElementById('cari_barang').value = namabarang;
//    var harganormal = document.getElementById('harga_normal').innerHTML = 
//    'Harga Normal: Rp.'+button.getAttribute('data-harga');            
   
//    $('#modalTop').modal('hide');
// }
</script>
@endsection
