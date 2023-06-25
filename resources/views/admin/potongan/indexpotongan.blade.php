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
                    <div class="card-inner">
                        <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                            <thead>
                                <tr class="nk-tb-item nk-tb-head">
                                    <th class="nk-tb-col ">
                                        No
                                    </th>
                                    <th class="nk-tb-col"><span class="sub-text">Nama Potongan</span></th>
                                    <th class="nk-tb-col tb-col-mb"><span class="sub-text">Nama Barang</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Harga Potongan</span></th>
                                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">Harga Normal</span></th>
                                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">Tgl Awal potongan</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Tgl Akhir potongan</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Status potongan</span></th>
                                    <th class="nk-tb-col nk-tb-col-tools text-end">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                             @foreach ($datapotongan as $potongan)
                             <tr class="nk-tb-item">
                                <td class="nk-tb-col ">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="nk-tb-col">
                                    {{ $potongan->nama_potongan }}
                                </td>
                                <td class="nk-tb-col tb-col-mb">
                                    <span class="tb-lead">{{ ($potongan->databarang != null)?$potongan->databarang->nama_barang:'Barang Di Hapus' }}</span>
                                </td>
                                <td class="nk-tb-col tb-col-md">
                                    <span>Rp.{{ number_format($potongan->harga_setelah_potongan, 0, ',', '.') }}</span>
                                </td> 
                                <td class="nk-tb-col tb-col-md">
                                    <span>Rp.{{ number_format($potongan->harga_potongan, 0, ',', '.') }}</span>
                                </td>
                                <td class="nk-tb-col tb-col-lg">
                                    <span>{{ \Carbon\Carbon::parse($potongan->tgl_awal_potongan)->isoFormat('D MMMM Y') }}</span>
                                </td>
                                <td class="nk-tb-col tb-col-lg">
                                    <span> {{ \Carbon\Carbon::parse($potongan->tgl_akhir_potongan)->isoFormat('D MMMM Y') }}</span>
                                </td>
                                <td class="nk-tb-col tb-col-md">
                                  @if ($potongan->status_potongan == 'aktif')
                                  <span class="badge rounded-pill bg-success badge-md">Aktif</span>
                                  @else
                                  <span class="badge rounded-pill bg-secondary badge-md">Tidak
                                  Aktif</span>
                                  @endif
                              </td>
                              <td class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1">
                                    <li>
                                        <div class="drodown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
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
                                <a href="#" class="btn btn-lg btn-mw btn-light" data-bs-dismiss="modal">Kembali</a>
                                <button class="btn btn-danger btn-lg">Hapus</button>
                            </div>                       
                        </form>
                    </div>
                </div><!-- .modal-body -->
            </div>
        </div>
    </div>


    @endsection