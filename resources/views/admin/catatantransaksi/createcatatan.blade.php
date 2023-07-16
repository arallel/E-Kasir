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
                                    <label class="form-label" for="cari_barang">Nama Barang</label>
                                    <form id="searchform" autocomplete="off">
                                        @csrf
                                        <div class="form-control-wrap">   
                                            <div class="input-group">        
                                                <input type="text" name="cari_barang" class="form-control" autofocus id="cari_barang" placeholder="Cari Barang" required>
                                                <div class="input-group-append">  
                                                    <button class="btn btn-primary"> <em class="icon ni ni-search"></em></button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <form action="{{ route('Catatan-transaksi.store') }}" method="POST"
                            enctype="multipart/form-data" id="form" autocomplete="off" style="display:none;">
                            @csrf
                            <div class="row g-3">
                              <input type="hidden" class="id_barang"  name="id_barang">
                              <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="nama_potongan">Kode Barang</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="id_barang form-control"
                                         disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="nama_potongan">Nama Barang</label>
                                    <div class="form-control-wrap">
                                        <input type="text" id="nama_barang" name="nama_barang" class="form-control"
                                         disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="harga_barang">Harga Barang</label>
                                    <div class="form-control-wrap">    
                                        <div class="input-group">        
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Rp.</span>        
                                            </div>        
                                            <input type="number"  class="form-control" placeholder="Harga Barang" name="harga_barang" id="harga_barang" required>    
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="qty">Jumlah/QTY</label>
                                    <div class="form-control-wrap">    
                                        <div class="input-group">        
                                            <input type="number"  class="form-control" placeholder="Jumlah/Qty" name="qty" id="qty" required>    
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">PCS</span>        
                                            </div>        
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="no_pesanan">No Pesanan</label>
                                    <div class="form-control-wrap">    
                                        <div class="input-group">              
                                            <input type="text"  class="form-control" placeholder="No Pesanan" name="no_pesanan" id="no_pesanan" required>    
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="no_resi">No Resi</label>
                                    <div class="form-control-wrap">    
                                        <div class="input-group">           
                                            <input type="text"  class="form-control" placeholder="No Resi" name="no_resi" id="no_resi" required>    
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="total_pembayaran">Total Pembayaran</label>
                                    <div class="form-control-wrap">    
                                        <div class="input-group">           
                                            <input type="number"  class="form-control" placeholder="Total Pembayaran" name="total_pembayaran" id="total_pembayaran" required>    
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="jenis_pembelian">
                                        Jenis Pembelian
                                    </label>
                                    <div class="form-control-wrap">
                                        <select class="form-select" required name="pembelian">
                                            <option selected disabled>Pilih Jenis Pembelian</option>
                                            <option value="online">Online</option>
                                            <option value="offline">Offline</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-2">
                                <div class="form-group">
                                    <label class="form-label" for="tgl_transaksi">
                                        Tanggal Transaksi
                                    </label>
                                    <div class="form-control-wrap">
                                       <input type="date" required value="{{ date('Y-m-d') }}" class="form-control" name="tgl_transaksi">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-2">
                                <div class="form-group">
                                    <label class="form-label" for="waktu_transaksi">
                                        Waktu Transaksi
                                    </label>
                                    <div class="form-control-wrap">
                                       <input type="time" required value="{{ date('H:i') }}" class="form-control" name="waktu_transaksi">
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-6">
                                <h6 id="harga_normal"></h6>
                                <h6 id="harga_baru"></h6>
                            </div> --}}
                            <div class="col-12 text-end mt-3">
                                <a href="{{ route('Catatan-transaksi.index') }}" class="btn btn-secondary">Kembali</a> 
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
                                <th>Stok</th>
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
            row.append($('<td>').text(item.stok));
            if(item.stok > 0){
                 row.append($('<td>').append($('<button>')
             .attr('onclick', 'pilihbarang(' + index + ')')
             .attr('data-id',item.id_barang)
             .attr('data-nama',item.nama_barang)
             .attr('data-harga',item.harga_barang)
             .addClass('btn btn-success btn-pilih')
             .text('pilih')
             ));
             }else{
                row.append($("<td class='text-center' colspan='3'>").text('Stok Kosong'));
             }
           
            tableBody.append(row);
        });
            $('#modalTop').modal('show');
    }else{
        let row = $('<tr>');
        row.append($("<td class='text-start' colspan='3'>").text('Tidak Ada Data Barang'));
             tableBody.append(row); // Append row to table body
             $('#modalTop').modal('show');
         }
     },
     error: function(error) {}
 });
   }
   
   function pilihbarang(rowIndex) {
      $('#modalTop').modal('hide');
      document.getElementById('form').style.display = 'block';
      const row = $('table tbody tr:eq(' + rowIndex + ')');
      const button = document.getElementsByClassName('btn-pilih')[rowIndex];
      const idbarang = button.getAttribute('data-id');
      const hargabarang = button.getAttribute('data-harga');
      const namabarang = button.getAttribute('data-nama');

       $('.id_barang').val(idbarang);
       $('#cari_barang').val(namabarang);
       $('#harga_barang').val(hargabarang);
       $('#nama_barang').val(namabarang);
  }
  const totalsemua = document.getElementById('total_pembayaran');
  const qty = document.getElementById('qty');
  qty.addEventListener('change',function (){
    const hitung = $('#harga_barang').val() * qty.value;
    totalsemua.value = hitung;
  })
</script>
@endsection
