@extends('admin.layout.main')
@section('content')
<div class="nk-content">
  <div class="container-fluid">
    <div class="nk-content-inner">
      <div class="nk-content-body">
        <div class="nk-block-head-content mb-3">
          <h3 class="nk-block-title page-title">Edit Potongan Harga</h3>
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
                        <input type="text" name="cari_barang" class="form-control" id="cari_barang" placeholder="Cari Barang" value="{{ $data->databarang->nama_barang }}" required>
                        <div class="input-group-append">
                          <button class="btn btn-primary"><em class="icon ni ni-search"></em></button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
               <form action="{{ route('potongan.update',$data->id_potongan) }}" method="POST"enctype="multipart/form-data">
                @csrf
                @method('patch')
                <input type="hidden" id="id_barang"  value="{{ $data->id_barang }}" name="id_barang">
                <input type="hidden" id="harga_awal" name="harga_awal" value="{{ $data->harga_awal }}">
                <input type="hidden" id="harga_setelah_potongan" value="{{ $data->harga_setelah_potongan }}" name="harga_setelah_potongan">
                <div class="row g-3">
                  <div class="col-12 ">
                    <div class="form-group">
                      <label class="form-label" for="kode_promo">Kode Promo</label>
                      <div class="form-control-wrap">
                        <input type="text" class="form-control"
                        name="kode_promo" value="{{ $data->kode_promo }}" id="kode_promo"
                        placeholder="Kode Promo">
                        <span class="fw-bold">Tidak Wajib Di isi</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-12">
                    <label>Pilih Tipe potongan</label>
                    <select class="form-select" id="tipe_potongan">
                      <option selected disabled>pilih Tipe Potongan</option>
                      <option {{ ($data->harga_potongan_rp != null)?'selected':'' }} value="diskon_rp">Diskon Dalam Bentuk Rp.</option>
                      <option {{ ($data->harga_potongan_persen != null)?'selected':'' }} value="diskon_%">Diskon dalam bentuk %</option>
                    </select>
                  </div>
                  <div class="col-12" id="view_potongan_rp" style="display:none;">
                    <div class="form-group">
                      <label class="form-label" for="harga_potongan">Harga Potongan</label>
                      <div class="form-control-wrap">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Rp.</span>
                          </div>
                          <input type="number" value="{{ $data->harga_potongan_rp }}" class="form-control " placeholder="Harga Potongan" name="harga_potongan_rp" id="harga_potongan">
                        </div>
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
                          <input type="number"  value="{{ $data->harga_potongan_persen }}"  class="form-control " placeholder="Jumlah % diskon" name="harga_persen" id="harga_persen">
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
                        <input type="date" class="form-control" name="tgl_awal_potongan" value="{{ $data->tgl_awal_potongan }}"  id="tgl_awal_potongan" placeholder="Nama potongan">
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="form-group">
                      <label class="form-label" for="tgl_akhir_potongan">
                        Tanggal Berakhir potongan
                      </label>
                      <div class="form-control-wrap">
                        <input type="date" class="form-control"  value="{{ $data->tgl_akhir_potongan}}"  name="tgl_akhir_potongan" value="" id="tgl_akhir_potongan" placeholder="Nama potongan">
                      </div>
                    </div>
                  </div>
                  <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="tgl_akhir_potongan">
                                            Status potongan
                                        </label>
                                        <div class="form-control-wrap">
                                         <select class="form-select js-select2" 
                                         name="status_potongan">
                                             <option disabled>Status</option>
                                             <option value="aktif" {{ ($data->status_potongan == 'aktif') ? 'selected' : '' }}>Aktif</option>
                                             <option value="tidak_aktif" {{ ($data->status_potongan == 'tidak_aktif') ? 'selected' : '' }}>Tidak Aktif</option>
                                         </select>
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
const harga_baru_potongan = document.getElementById('harga_setelah_potongan');
const htmlhargabaru = document.getElementById('harga_baru');
const htmlharganormal = document.getElementById('harga_normal');


//input
const inputpersen = document.getElementById('harga_persen');
const inputpotongan = document.getElementById('harga_potongan');
const inputidbarang = document.getElementById('id_barang');
const inputcaribarang = document.getElementById('cari_barang');
const inputhargaawal = document.getElementById('harga_awal');

const tglAwalPotongan = document.getElementById('tgl_awal_potongan');
const tglAkhirPotongan = document.getElementById('tgl_akhir_potongan');

  tglAwalPotongan.addEventListener('change', function() {
    const startDate = new Date(this.value);
    const endDate = new Date(tglAkhirPotongan.value);

    if (endDate < startDate) {
      tglAkhirPotongan.value = '{{ $data->tgl_akhir_potongan }}';
       Swal.fire("Error Invalid Date", "Tanggal Berakhir Potongan Tidak Dapat Melebihi Tanggal Mulai Potongan", "error");
    }
  });

  tglAkhirPotongan.addEventListener('change', function() {
    const startDate = new Date(tglAwalPotongan.value);
    const endDate = new Date(this.value);

    if (endDate < startDate) {
      this.value = '{{  $data->tgl_akhir_potongan }}';
       Swal.fire("Error", "Tanggal Berakhir Potongan Tidak Dapat Melebihi Tanggal Mulai Potongan", "error");
    }
  });

@if($data->harga_potongan_rp)
    potonganRp.style.display = 'block';
    potonganPersen.style.display = 'none';
    inputpersen.value = '';
    htmlhargabaru.innerHTML = '';
    document.getElementById('btn-submit').classList.remove("disabled");
    const data ={
        id:'{{ $data->id_barang }}',
        harga:'{{ $data->harga_awal }}',
        harga_baru:'{{ $data->harga_setelah_potongan }}',
        nama:'{{ $data->databarang->nama_barang }}',
    }
    newrow(data);
@else
    potonganPersen.style.display = 'block';
    inputpotongan.value = '';
    htmlhargabaru.innerHTML = '';
    potonganRp.style.display = 'none';
    document.getElementById('btn-submit').classList.remove("disabled");
     const data ={
        id:'{{ $data->id_barang }}',
        harga:'{{ $data->harga_awal }}',
        harga_baru:'{{ $data->harga_setelah_potongan }}',
        nama:'{{ $data->databarang->nama_barang }}',
    }
    newrow(data);
@endif

selectTipe.addEventListener("change", function() {
  const valueSelect = selectTipe.value;
  if (valueSelect === 'diskon_rp') {
    potonganRp.style.display = 'block';
    potonganPersen.style.display = 'none';
    inputpersen.value = '';
    htmlhargabaru.innerHTML = '';
    harga_baru_potongan.value = '';
    document.getElementById('btn-submit').classList.remove("disabled");
  } else {
    potonganPersen.style.display = 'block';
    inputpotongan.value = '';
    htmlhargabaru.innerHTML = '';
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
  htmlhargabaru.innerHTML = '';
  harga_baru_potongan.value = '';
  const row = $('table tbody tr:eq(' + rowIndex + ')');
  const button = document.getElementsByClassName('btn-pilih')[rowIndex];
  const data = {
    id:button.getAttribute('data-id'),
    harga:button.getAttribute('data-harga'),
    nama:button.getAttribute('data-nama'),
  }
  inputidbarang.value = data.id;
  inputcaribarang.value = data.nama;
  htmlharganormal.innerHTML = 'Harga Normal:' + formatrupiah(data.harga);
  inputhargaawal.value = data.harga;
  inputpersen.value = '';

  inputpotongan.addEventListener('change',function(){
    const valuepotongan = inputpotongan.value;
    const hitung = data.harga - valuepotongan;
    harga_baru_potongan.value = hitung;
    if (data.harga > valuepotongan || hitung >= 0) {
      htmlhargabaru.innerHTML = 'Harga Baru Setelah Potongan:' + formatrupiah(hitung);
  } else {
    inputpersen.value = '';
       Swal.fire("Error", "Harga Potongan Melebihi Harga Normal", "error");
  }
   });

  inputpersen.addEventListener('change',function(){
   const hitung = data.harga - (data.harga * (inputpersen.value / 100));
    harga_baru_potongan.value = hitung;
   if (data.harga < hitung || hitung >= 0) {
   htmlhargabaru.innerHTML = 'Harga Baru Setelah Diskon:' + formatrupiah(hitung);
  } else {
    inputpersen.value = '';
       Swal.fire("Error", "Harga Diskon Melebihi Harga Normal", "error");
  }
  });
  $('#modalTop').modal('hide');
}

function newrow(data) {
  const data_id = data.id;
  const data_harga = data.harga;
  const data_nama = data.nama;

  inputidbarang.value = data_id;
  inputcaribarang.value = data_nama;
  inputhargaawal.value = data_harga;
  htmlhargabaru.innerHTML = 'Harga Baru:' + formatrupiah(data.harga_baru);
  htmlharganormal.innerHTML = 'Harga Normal:' + formatrupiah(data_harga);

  inputpotongan.addEventListener('change',function(){
    const valuepotongan = inputpotongan.value;
    const hitung = data_harga - valuepotongan;
    harga_baru_potongan.value = hitung;
    if (data_harga > valuepotongan || hitung >= 0) {
      htmlhargabaru.innerHTML = 'Harga Baru Setelah Potongan:' + formatrupiah(hitung);
    } else {
      harga_setelah_potongan.value =  data.harga_baru;
      inputpersen.value = '';
      Swal.fire("Error", "Harga Potongan Melebihi Harga Normal", "error");
    }
  });

  inputpersen.addEventListener('change',function(){
   const hitung = data_harga - (data_harga * (inputpersen.value / 100));
   harga_baru_potongan.value = hitung;
   if (data_harga < hitung || hitung >= 0) {
     htmlhargabaru.innerHTML = 'Harga Baru Setelah Diskon:' + formatrupiah(hitung);
   } else {
    harga_setelah_potongan.value =  data.harga_baru;
    inputpersen.value = '';
    Swal.fire("Error", "Harga Diskon Melebihi Harga Normal", "error");
  }
});
}
function formatrupiah(num)
 {
  const locale = 'id-ID';
  const options = {
    style: 'currency',
    currency: 'IDR',
  };
  const numberFormat = new Intl.NumberFormat(locale, options);
  return numberFormat.format(num).replace(',00', '');;
 }

</script>

@endsection
