@extends('admin.layout.main')
@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head-content mb-3">
                    <h3 class="nk-block-title page-title ">Tambah Potongan Harga</h3>
                </div><!-- .nk-block-head-content -->
                <div class="col-12">
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

                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label" for="nama_barang">Nama Barang</label>
                                    <form id="searchform" autocomplete="off">
                                        @csrf
                                        <div class="form-control-wrap">   
                                            <div class="input-group">        
                                                <input type="text" name="cari_barang" class="form-control"  id="cari_barang" placeholder="Cari Barang" required>
                                                <div class="input-group-append">  
                                                    <button class="btn btn-primary"> <em class="icon ni ni-search"></em></button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <form action="{{ route('potongan.store') }}" method="POST"
                            enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <div class="row g-3">
                              <input type="hidden" id="id_barang"  name="id_barang">
                              <input type="hidden" id="harga_setelah_potongan"  name="harga_setelah_potongan">
                              <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="nama_potongan">Nama Potongan</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control"
                                        name="nama_potongan" value="{{ old('nama_potongan') }}" id="nama_potongan"
                                        placeholder="Nama potongan" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="harga_potongan">Harga Potongan</label>
                                    <div class="form-control-wrap">    
                                        <div class="input-group">        
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Rp.</span>        
                                            </div>        
                                            <input type="number" class="form-control" placeholder="Harga Potongan" name="harga_potongan" id="harga_potongan" required>    
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="tgl_awal_potongan">
                                        Mulai potongan
                                    </label>
                                    <div class="form-control-wrap">
                                        <input type="date" class="form-control"
                                        name="tgl_awal_potongan" value="{{ date('Y-m-d') }}" id="tgl_awal_potongan"
                                        placeholder="Nama potongan" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="tgl_akhir_potongan">
                                        Tanggal Berakhir potongan
                                    </label>
                                    <div class="form-control-wrap">
                                        <input type="date" class="form-control"
                                        name="tgl_akhir_potongan" value="" id="tgl_akhir_potongan"
                                        placeholder="Nama potongan" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <h6 id="harga_normal"></h6>
                                <h6 id="harga_baru"></h6>
                            </div>
                            <div class="col-6 text-end mt-3">
                                <a href="{{ route('potongan.index') }}" class="btn btn-secondary">Kembali</a> 
                                <button class="btn btn-success" >Simpan Data</button>   
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
                <h5 class="modal-title">Pilih Barang</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="col-12">
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                            <tr>
                                <th>no</th>
                                <th>nama barang</th>
                                <th>aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
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
   $('#searchform').submit(function(event) {
    event.preventDefault(); 
    const cari = $('#cari_barang').val();
    getListItemByName(cari);
});
   function getListItemByName(nama_barang) {
       $.ajax({
        url: '{{ route('potongan.searchbarang') }}',
        method: "GET",
        data: {
          cari_barang: nama_barang
      },
      success: function(response) {
       const data = response.data;
       let tableBody = $('#dataTable tbody');
       tableBody.empty();
       if(data){
        $.each(data, function(index, item) {
            let row = $('<tr>');
            row.append($('<td>').text(index + 1));
            row.append($('<td>').text(item.nama_barang));
            row.append($('<td>').append($('<button>')
             .attr('onclick', 'pilihbarang(' + index + ')')
             .attr('data-id',item.id_barang)
             .attr('data-nama',item.nama_barang)
             .attr('data-harga',item.harga_barang)
             .addClass('btn btn-success btn-pilih')
             .text('pilih')
             ));
            tableBody.append(row);
            $('#modalTop').modal('show');
        });
    }else{
        let row = $('<tr>');
        row.append($("<td class='text-center' colspan='3'>").text('Tidak Ada Data Barang'));
             tableBody.append(row); // Append row to table body
             $('#modalTop').modal('show');
         }
     },
     error: function(error) {}
 });
   }

   function pilihbarang(rowIndex) {
      const row = $('table tbody tr:eq(' + rowIndex + ')');
      const button = document.getElementsByClassName('btn-pilih')[rowIndex];
      const idbarang = button.getAttribute('data-id');
      const hargabarang = button.getAttribute('data-harga');
      const namabarang = button.getAttribute('data-nama');
      document.getElementsByClassName('id_barang').value = idbarang;
      document.getElementById('cari_barang').value = namabarang;
      document.getElementById('harga_normal').innerHTML = 'Harga Normal: Rp.' + button.getAttribute('data-harga');

      const hargapotongan = document.getElementById('harga_potongan');
      const hargabaru = document.getElementById('harga_baru');

      hargapotongan.addEventListener("change", function () {
        const valuebarang = button.getAttribute('data-harga');
        const valuepotongan = hargapotongan.value;
        const hitung = valuebarang - valuepotongan;
        document.getElementById('harga_setelah_potongan').value = hitung;
        if (valuebarang > valuepotongan || hitung >= 0) {
          hargabaru.innerHTML = 'Harga Baru Setelah Potongan: Rp.' + hitung.toLocaleString('id-ID');
      } else {
          alert('Harga Potongan Melebihi Harga Normal');
      }
  });

      $('#modalTop').modal('hide');
  }
</script>
@endsection
