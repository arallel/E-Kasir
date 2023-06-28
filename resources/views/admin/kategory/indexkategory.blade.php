@extends('admin.layout.main')
@section('content')
<div class="nk-content-inner">
    <div class="nk-content-body">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">Data Kategory</h3>
                </div><!-- .nk-block-head-content -->
                <div class="nk-block-head-content">
                 <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em
                        class="icon ni ni-more-v"></em></a>
                        <div class="toggle-expand-content" data-content="pageMenu">
                            <ul class="nk-block-tools g-3">
                                <li class="nk-block-tools-opt">
                                    <a href="#" data-target="addProduct"
                                    class="toggle btn btn-icon btn-primary d-md-none"><em
                                    class="icon ni ni-plus"></em></a>
                                    <a href="#" data-target="addProduct"
                                    class="toggle btn btn-primary d-none d-md-inline-flex"><em
                                    class="icon ni ni-plus"></em><span>Tambah Kategory</span></a>
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
                    <div class="card-inner ">
                     <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                        <thead>
                            <tr class="nk-tb-item nk-tb-head">
                                <th class="nk-tb-col nk-tb-col-check">
                                    No
                                </th>
                                <th class="nk-tb-col text-center"><span class="sub-text">Nama Kategory</span></th>
                                
                                <th class="nk-tb-col nk-tb-col-tools text-end">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($datakategory as $kategory)
                           <tr class="nk-tb-item">
                            <td class="nk-tb-col">
                                <span class="tb-lead">{{ $loop->iteration }}</span>
                            </td>
                            <td class="nk-tb-col text-center" >
                                <span class="tb-lead">{{ $kategory->nama_kategory }}</span>
                            </td>
                            <td class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1">
                                    <li>
                                        <div class="drodown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a href="{{ route('Kategory.edit', $kategory->id_kategory) }}"><em class="icon ni ni-edit"></em><span>Edit kategory</span></a></li>
                                                    <li><a type="button" class="btn-delete" data-id="{{ $kategory->id_kategory }}"><em class="icon ni ni-trash btn-delete"></em><span>Hapus Kategory</span></a>
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
            // console.log(id);
        $('#form-edit').attr('action', '/Kategory/delete/' + id);
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

<div class="nk-add-product toggle-slide toggle-slide-right" data-content="addProduct"
data-toggle-screen="any" data-toggle-overlay="true" data-toggle-body="true" data-simplebar>
<div class="nk-block-head">
    <div class="nk-block-head-content">
        <h5 class="nk-block-title">Tambah Kategory</h5>
        <div class="nk-block-des">
            <p>Tambah Kategory</p>
        </div>
    </div>
</div><!-- .nk-block-head -->
<div class="nk-block">
    @if ($errors->any())
    <div class="alert alert-icon alert-danger" role="alert"> <em
        class="icon ni ni-cross-circle"></em>
        @foreach ($errors->default->all() as $error)
        <strong>Error</strong>.{{ $error }}.
        @endforeach
    </div>
    @endif
    <form action="{{ route('Kategory.store') }}" method="POST" enctype="multipart/form-data"
    class="form-validate">
    @csrf
    <div class="row g-3">
        <div class="col-12">
            <div class="form-group">
                <label class="form-label" for="nama_kategory">Nama Kategory</label>
                <div class="form-control-wrap">
                    <input type="text" class="form-control" value="{{ old('nama_kategory') }}"
                    name="nama_kategory" id="nama_kategory" placeholder="Nama Kategory" required>
                </div>
            </div>
        </div>
        <div class="col-12 ">
            <button class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Tambah
            Kategory</span></button>
        </div>
    </div>
</form>
</div>
</div><!-- .nk-block -->
</div>
@endsection