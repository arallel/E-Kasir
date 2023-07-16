@extends('admin.layout.main')
@section('title', 'Laporan')
@section('content')
<div class="nk-content-inner">
    <div class="nk-content-body">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">Laporan</h3>
                </div><!-- .nk-block-head-content -->
                <div class="nk-block-head-content">
                    <div class="toggle-wrap nk-block-tools-toggle">
                        <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em
                            class="icon ni ni-more-v"></em></a>
                            <div class="toggle-expand-content" data-content="pageMenu">
                                <ul class="nk-block-tools g-3">
                                  {{-- <li class="nk-block-tools-opt">
                                     <a href="#" class=" btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                                    <a href="#"class=" btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>Tambah Catatan Transaksi</span></a>
                                </li>  --}}
                            </ul>
                        </div>
                    </div>
                </div><!-- .nk-block-head-content -->
            </div><!-- .nk-block-between -->
        </div><!-- .nk-block-head -->
        <div class="nk-block">
            <div class="card">
                <div class="card-inner-group">
                    <div class="card-inner">
                        <!-- Modal Trigger Code -->
                        <button  class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#LaporanHarian"><em class="icon ni ni-file-text"></em><span>Export Laporan Harian</span> </button>

                        <button  class="btn btn-info" data-bs-toggle="modal" data-bs-target="#LaporanBulanan"><em class="icon ni ni-file-text"></em><span>Export Laporan Bulanan</span> </button>

                        <a href="{{ route('export.databarang') }}" class="btn btn-success" id="export-databarang" ><em class="icon ni ni-box"></em><span>Export Databarang</span> </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" id="LaporanHarian" aria-modal="true" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Laporan Harian</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('export.laporan.Harian') }}" method="GET">
                    @csrf
                    <input type="hidden" value="laporanharian" name="tipe_laporan">
                    <div class="row">
                        <div class="col-12 mb-2">
                            <div class="form-group">
                                <label>Masukan Tanggal Yang Akan Di Export</label>
                                <input type="date" class="form-control" value="{{ date('Y-m-d') }}" name="tanggal">
                            </div>
                        </div>
                        <div class="text-end">
                          <button class="btn btn-success" id="export-harian" data-bs-dismiss="modal">Export</button>
                      </div>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" id="LaporanBulanan" aria-modal="true" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Laporan Bulanan</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('export.laporan.Harian') }}" method="GET">
                    @csrf
                    <input type="hidden" value="bulanan" name="tipe_laporan">
                    <div class="row">
                        <div class="col-12 mb-2">
                            <div class="form-group">
                                <label>Masukan Tanggal Yang Akan Di Export</label>
                                <input type="date" class="form-control" value="{{ date('Y-m-d') }}" name="tanggal">
                            </div>
                        </div>
                        <div class="text-end">
                          <button class="btn btn-success" id="export-bulanan" data-bs-dismiss="modal">Export</button>
                      </div>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>
<script>
    const btndatabarng = document.getElementById('export-databarang'); 
    const btnharian = document.getElementById('export-harian'); 
    const btnbulanan = document.getElementById('export-bulanan'); 
    function alert(){
        NioApp.Toast('Data Berhasil Di Export', 'success', {
               position: 'top-right'
           });
    }
    function handleClickWithDelay() {
        setTimeout(alert, 2000); // Delay of 2000 milliseconds (2 seconds)
    }
    btndatabarng.addEventListener('click', handleClickWithDelay);
    btnharian.addEventListener('click', handleClickWithDelay);
    btnbulanan.addEventListener('click', handleClickWithDelay);
</script>
@endsection