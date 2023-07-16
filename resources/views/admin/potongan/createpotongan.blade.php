@extends('admin.layout.main')
@section('content')
<div class="nk-content">
  <div class="container-fluid">
    <div class="nk-content-inner">
      <div class="nk-content-body">
        <div class="nk-block-head-content mb-3">
          <h3 class="nk-block-title page-title">Tambah Potongan Harga</h3>
          <a href="{{ route('potongan.index') }}" class="btn btn-secondary"><em class="icon ni ni-chevron-left"></em><span>Kembali</span></a>
        </div><!-- .nk-block-head-content -->
        <div class="col-12">
          <div class="card">
            <div class="card-inner">
              @if ($errors->any())
              <div class="alert alert-icon alert-danger" role="alert">
                <em class="icon ni ni-cross-circle"></em>
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
                        <input type="text" name="cari_barang" class="form-control" id="cari_barang" placeholder="Cari Barang" required>
                        <div class="input-group-append">
                          <button class="btn btn-primary"><em class="icon ni ni-search"></em></button>
                        </div>
                      </div>
                        <p class="text-muted">Mencari Barang Dengan Search</p>
                    </div>
                  </form>
                </div>
              </div>
              <form action="{{ route('potongan.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off" id="form-potongan" style="display: none;">
                @csrf
                <input type="hidden" id="id_barang" name="id_barang">
                <input type="hidden" id="harga_awal" name="harga_awal">
                <input type="hidden" id="harga_setelah_potongan" name="harga_setelah_potongan">
                <div class="row g-3">
                  <div class="col-12">
                    <label>Pilih Tipe potongan</label>
                    <select class="form-select" id="tipe_potongan">
                      <option selected disabled>pilih Tipe Potongan</option>
                      <option value="diskon_rp">Diskon Dalam Bentuk Rp.</option>
                      <option value="diskon_%">Diskon dalam bentuk %</option>
                    </select>
                    <span class="fw-bold">Wajib Di isi</span>
                  </div>
                  <div class="col-12" id="view_potongan_rp" style="display:none;">
                    <div class="form-group">
                      <label class="form-label" for="harga_potongan">Harga Potongan</label>
                      <div class="form-control-wrap">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Rp.</span>
                          </div>
                          <input type="number" value="{{ old('harga_potongan_rp') }}" class="form-control " placeholder="Harga Potongan" name="harga_potongan_rp" id="harga_potongan">
                        </div>
                        <span class="fw-bold">Wajib Di isi</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-12" id="view_potongan_persen" style="display: none;">
                    <div class="form-group">
                      <label class="form-label" for="harga_persen">Jumlah % diskon</label>
                      <div class="form-control-wrap">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">%</span>
                          </div>
                          <input type="number"  value="{{ old('harga_persen') }}"  class="form-control " placeholder="Jumlah % diskon" name="harga_persen" id="harga_persen">
                        </div>
                        <span class="fw-bold">Wajib Di isi</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="form-group">
                      <label class="form-label" for="tgl_awal_potongan">
                        Mulai potongan
                      </label>
                      <div class="form-control-wrap">
                        <input type="date" class="form-control" name="tgl_awal_potongan" value="{{ date('Y-m-d') }}{{ old('tgl_awal_potongan') }}"  id="tgl_awal_potongan" placeholder="Nama potongan" required>
                        <span class="fw-bold">Wajib Di isi</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="form-group">
                      <label class="form-label" for="tgl_akhir_potongan">
                        Tanggal Berakhir potongan
                      </label>
                      <div class="form-control-wrap">
                        <input type="date" class="form-control"  value="{{ date('Y-m-d', strtotime(date('Y-m-d') . ' +3 days')) }}{{ old('tgl_akhir_potongan') }}"  name="tgl_akhir_potongan" value="" id="tgl_akhir_potongan" placeholder="Nama potongan" required>
                        <span class="fw-bold">Wajib Di isi</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <h6 id="harga_normal"></h6>
                    <h6 id="harga_baru"></h6>
                  </div>
                  <div class="col-6 text-end mt-3">
                    <button class="btn btn-success disabled" id="btn-submit">Simpan Data</button>
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
  const selectTipe = document.getElementById("tipe_potongan");
  const potonganRp = document.getElementById("view_potongan_rp");
  const potonganPersen = document.getElementById("view_potongan_persen");
  const hargabaru = document.getElementById('harga_baru');
  const inputpotongan = document.getElementById('harga_potongan');
  const inputpersen = document.getElementById('harga_persen');
  const harga_baru_potongan = document.getElementById('harga_setelah_potongan');

  const tglAwalPotongan = document.getElementById('tgl_awal_potongan');
  const tglAkhirPotongan = document.getElementById('tgl_akhir_potongan');

  tglAwalPotongan.addEventListener('change', function() {
    const startDate = new Date(this.value);
    const endDate = new Date(tglAkhirPotongan.value);

    if (endDate < startDate) {
      tglAkhirPotongan.value = '';
      Swal.fire("Error Invalid Date", "Tanggal Berakhir Potongan Tidak Dapat Melebihi Tanggal Mulai Potongan", "error");
    }
  });

  tglAkhirPotongan.addEventListener('change', function() {
    const startDate = new Date(tglAwalPotongan.value);
    const endDate = new Date(this.value);

    if (endDate < startDate) {
      this.value = '';
      Swal.fire("Error", "Tanggal Berakhir Potongan Tidak Dapat Melebihi Tanggal Mulai Potongan", "error");
    }
  });

  selectTipe.addEventListener("change", function() {
    const valueSelect = selectTipe.value;
    if (valueSelect === 'diskon_rp') {
      potonganRp.style.display = 'block';
      potonganPersen.style.display = 'none';
      inputpersen.value = '';
      hargabaru.innerHTML = '';
      harga_baru_potongan.value = '';
      document.getElementById('btn-submit').classList.remove("disabled");
    } else {
      potonganPersen.style.display = 'block';
      inputpotongan.value = '';
      hargabaru.innerHTML = '';
      harga_baru_potongan.value = '';
      potonganRp.style.display = 'none';
      document.getElementById('btn-submit').classList.remove("disabled");
    }
  });

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
        if (data) {
          $.each(data, function(index, item) {
            let row = $('<tr>');
            row.append($('<td>').text(index + 1));
            row.append($('<td>').text(item.nama_barang));
            row.append($('<td>').append($('<button>')
              .attr('onclick', 'pilihbarang(' + index + ')')
              .attr('data-id', item.id_barang)
              .attr('data-nama', item.nama_barang)
              .attr('data-harga', item.harga_barang)
              .addClass('btn btn-success btn-pilih')
              .text('pilih')
              ));
            tableBody.append(row);
            $('#modalTop').modal('show');
          });
        } else {
          let row = $('<tr>');
          row.append($("<td class='text-center' colspan='3'>").text('Tidak Ada Data Barang'));
          tableBody.append(row);
          $('#modalTop').modal('show');
        }
      },
      error: function(error) {}
    });
  }

  function pilihbarang(rowIndex) {
    document.getElementById('form-potongan').style.display = 'block';
    const row = $('table tbody tr:eq(' + rowIndex + ')');
    const button = document.getElementsByClassName('btn-pilih')[rowIndex];
    const idBarang = button.getAttribute('data-id');
    const hargaBarang = button.getAttribute('data-harga');
    const namaBarang = button.getAttribute('data-nama');
    const hargabaru = document.getElementById('harga_baru');
    document.getElementById('id_barang').value = idBarang;
    document.getElementById('cari_barang').value = namaBarang;
    document.getElementById('harga_normal').innerHTML = 'Harga Normal: Rp.' + hargaBarang;
    document.getElementById('harga_awal').value = hargaBarang;
    const valuebarang = button.getAttribute('data-harga');

    inputpotongan.addEventListener('change',function(){
      const valuepotongan = inputpotongan.value;
      const hitung = valuebarang - valuepotongan;
      harga_baru_potongan.value = hitung;
      if (valuebarang > valuepotongan || hitung >= 0) {
        hargabaru.innerHTML = 'Harga Baru Setelah Potongan: Rp.' + hitung.toLocaleString('id-ID');
      } else {
       Swal.fire("Error", "Harga Potongan Melebihi Harga Normal", "error");
     }
   });

    inputpersen.addEventListener('change',function(){
     const hitung = valuebarang - (valuebarang * (inputpersen.value / 100));
     harga_baru_potongan.value = hitung;
     if (valuebarang < hitung || hitung >= 0) {
       hargabaru.innerHTML = 'Harga Baru Setelah Diskon: Rp.' + hitung.toLocaleString('id-ID');
     } else {
       Swal.fire("Error", "Harga Diskon Melebihi Harga Normal", "error");
     }
   });
    $('#modalTop').modal('hide');
  }




</script>

@endsection
