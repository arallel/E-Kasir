@extends('admin.layout.main')
@section('content')
<div class="nk-content-inner">
    <div class="nk-content-body">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">Data Potongan</h3>
                </div><!-- .nk-block-head-content -->
                <div class="nk-block-head-content">
                 <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em
                        class="icon ni ni-more-v"></em></a>
                        <div class="toggle-expand-content" data-content="pageMenu">
                            <ul class="nk-block-tools g-3">
                                <li>
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-right">
                                            <em class="icon ni ni-search"></em>
                                        </div>
                                        <form action="{{ route('potongan.search') }}" method="post">
                                            @csrf
                                            <input type="text" class="form-control" name="search" id="default-04"
                                            placeholder="Cari Potongan">
                                        </form>
                                    </div>
                                </li>
                                <li class="nk-block-tools-opt">
                                    <a href="{{ route('potongan.create') }}"
                                    class="btn btn-primary d-none d-md-inline-flex"><em
                                    class="icon ni ni-plus"></em><span>Tambah Data Potongan Harga</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="nk-block">
            <div class="card">
                <div class="card-inner-group">
                    <div class="card-inner p-0">
                     <div class="nk-tb-list">
                      <div class="nk-tb-item nk-tb-head">
                       <div class="nk-tb-col tb-col-sm"><span>No</span></div>
                       <div class="nk-tb-col tb-col-sm"><span>Nama Potongan</span></div>
                       <div class="nk-tb-col"><span>Nama Barang</span></div>
                       <div class="nk-tb-col"><span>Harga Potongan</span></div>
                       <div class="nk-tb-col "><span></span>Harga Normal</div>
                       <div class="nk-tb-col "><span>Tgl Awal potongan</span></div>
                       <div class="nk-tb-col "><span>Tgl Akhir potongan</span></div>
                       <div class="nk-tb-col "><span>Status potongan</span></div>
                       <div class="nk-tb-col nk-tb-col-tools">
                        <ul class="nk-tb-actions gx-1 my-n1">
                            <li class="me-n1">
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger"><em
                                        class="icon ni ni-more-h"></em></a>
                                        <div class="dropdown-menu dropdown-menu-end">

                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    @if (count($datapotongan) == 0)
                    <div class="nk-tb-item">
                        <div class="nk-tb-col">
                            <span class="tb-lead text-center"></span>
                        </div>
                        <div class="nk-tb-col">
                            <span class="tb-lead text-center"></span>
                        </div>
                        <div class="nk-tb-col">
                            <span class="tb-lead text-center"></span>
                        </div>
                        <div class="nk-tb-col">
                            <span class="tb-lead text-center"></span>
                        </div>
                        <div class="nk-tb-col">
                            <span class="tb-lead text-center">Tidak Ada Data</span>
                        </div>
                    </div>
                    @else
                    @foreach ($datapotongan as $potongan)
                    <div class="nk-tb-item">
                        <div class="nk-tb-col">
                            <span class="tb-lead">{{ $loop->iteration }}</span>
                        </div>
                        <div class="nk-tb-col tb-col-sm">
                            <span class="tb-product">
                               <span class="title">{{ $potongan->nama_potongan }}</span>
                           </span>
                       </div>
                       <div class="nk-tb-col tb-col-sm">
                        <span class="tb-product">
                           <span class="title">{{ $potongan->databarang->nama_barang }}</span>
                       </span>
                   </div>
                   <div class="nk-tb-col">
                    <span class="tb-sub">Rp.{{ number_format($potongan->harga_potongan, 0, ',', '.') }}</span>
                </div>
                <div class="nk-tb-col">
                    <span class="tb-sub">Rp.{{ number_format($potongan->harga_setelah_potongan, 0, ',', '.') }}</span>
                </div>
                <div class="nk-tb-col">
                    <span class="tb-sub">{{ $potongan->tgl_awal_potongan }}</span>
                </div>
                <div class="nk-tb-col">
                    <span class="tb-sub">{{ $potongan->tgl_akhir_potongan }}</span>
                </div>
                <div class="nk-tb-col">
                    @if ($potongan->status_potongan == 'aktif')
                   <span class="badge rounded-pill bg-success badge-md">Aktif</span>
                   @else
                   <span class="badge rounded-pill bg-secondary badge-md">Tidak
                   Aktif</span>
                   @endif
               </div>
               <div class="nk-tb-col nk-tb-col-tools">
                <ul class="nk-tb-actions gx-1 my-n1">
                    <li class="me-n1">
                        <div class="dropdown">
                            <a href="#"
                            class="dropdown-toggle btn btn-icon btn-trigger"
                            data-bs-toggle="dropdown"><em
                            class="icon ni ni-more-h"></em></a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <ul class="link-list-opt no-bdr">
                                    <li><a href="{{ route('potongan.edit', $potongan->id_potongan) }}"><em class="icon ni ni-edit"></em><span>Edit potongan</span></a></li>
                                    {{-- <li><a href="{{ route('potongan.show', $potongan->id_potongan) }}"><em class="icon ni ni-eye"></em><span>Tampilkan</span></a></li> --}}
                                    <li><a type="button" class="btn-delete" data-id="{{ $potongan->id_potongan }}"><em class="icon ni ni-trash btn-delete"></em><span>Hapus Barang</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>
<div class="card-inner">
    <div class="nk-block-between-md g-3">
        <div class="g">
            {{ $datapotongan->links() }}
        </div>
        <div class="g">
           
            <div>Total <strong>{{ count($datapotongan) }}</strong></div>
        </div><!-- .nk-block-between -->
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).on('click', '.btn-delete', function() {
        var id = $(this).data('id');
        $('#form-edit').attr('action', '/potongan/delete/' + id);
        $('#form-edit').append('<input type="hidden" name="_method" value="DELETE">');
        $('#delete').modal('show');
    });
</script>

<div class="modal fade" tabindex="-1" id="delete">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body modal-body-lg text-center">
                <div class="nk-modal">
                    <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-cross bg-danger"></em>
                    <h4 class="nk-modal-title">Apakah Kamu Yakin Untuk Hapus</h4>
                    <form action="#" method="POST" id="form-edit">
                        @csrf
                        {{-- @method('delete') --}}
                        <div class="nk-modal-action mt-5">
                            <a href="#" class="btn btn-lg btn-mw btn-light" data-bs-dismiss="modal">Return</a>
                            <button class="btn btn-danger btn-lg">Delete</button>
                        </div>                       
                    </form>
                </div>
            </div><!-- .modal-body -->
        </div>
    </div>
</div>


@endsection