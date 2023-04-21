@extends('admin.layout.main')
@section('title', 'Data Barang')
@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Products</h3>
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
                                            <form action="{{ route('search.barang') }}" method="post">
                                                @csrf
                                                <input type="text" class="form-control" name="search" id="default-04"
                                                    placeholder="Cari Barang">
                                            </form>
                                        </div>
                                    </li>
                                    <li>
                                        <form action="{{ route('filter.barang') }}" method="post" id="filter">
                                            @csrf
                                            <div class="form-control-select">
                                                <select class="form-control" name="filter" id="filter-select">
                                                    <option selected disabled>Status</option>
                                                    <option value="semua"><span>Semua</span></option>
                                                    <option value="tidak_aktif"><span>Tidak Aktif</span></option>
                                                    <option value="aktif"><span>Aktif</span></option>
                                                    <option value="stok_kosong"><span>Stok Kosong</span></option>
                                                </select>
                                            </div>
                                        </form>
                                    </li>
                                    <li>
                                        <form action="{{ route('filter.kategory.barang') }}" method="post"
                                            id="filter-kategory">
                                            @csrf
                                            <div class="form-control-select">
                                                <select class="form-control" name="filter" id="filter-select-kategory">
                                                    <option selected disabled>Kategory</option>
                                                    @foreach ($kategory as $katef)
                                                        <option value="{{ $katef->id_kategory }}">
                                                            <span>{{ $katef->nama_kategory }}</span>
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </form>
                                    </li>
                                    <li class="nk-block-tools-opt">
                                        <a href="#" data-target="addProduct"
                                            class="toggle btn btn-icon btn-primary d-md-none"><em
                                                class="icon ni ni-plus"></em></a>
                                        <a href="#" data-target="addProduct"
                                            class="toggle btn btn-primary d-none d-md-inline-flex"><em
                                                class="icon ni ni-plus"></em><span>Tambah Barang</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div><!-- .nk-block-head-content -->
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->
            <div class="nk-block">
                <div class="card">
                    <div class="card-inner-group">
                        <div class="card-inner p-0">
                            <div class="nk-tb-list">
                                <div class="nk-tb-item nk-tb-head">
                                    <div class="nk-tb-col tb-col-sm"><span>No</span></div>
                                    <div class="nk-tb-col tb-col-sm"><span>Nama Barang</span></div>
                                    <div class="nk-tb-col"><span>Barcode</span></div>
                                    <div class="nk-tb-col"><span>Harga</span></div>
                                    <div class="nk-tb-col"><span>Stok</span></div>
                                    <div class="nk-tb-col tb-col-md"><span>kategory</span></div>
                                    <div class="nk-tb-col tb-col-md"><span>Status Barang</span></div>
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
                                <!-- .nk-tb-item -->
                                @if (count($databarang) == 0)
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
                                            <span class="tb-lead text-center">Tidak Ada Data</span>
                                        </div>
                                    </div>
                                @else
                                    @foreach ($databarang as $barang)
                                        <div class="nk-tb-item">
                                            <div class="nk-tb-col">
                                                <span class="tb-lead">{{ $loop->iteration }}</span>
                                            </div>
                                            <div class="nk-tb-col tb-col-sm">
                                                <span class="tb-product">
                                                    @if ($barang->foto_barang == null)
                                                        <img src="{{ asset('assets/images/no-image.png') }}" alt=""
                                                            class="thumb">
                                                    @else
                                                        <img src="storage/{{ $barang->foto_barang }}" alt=""
                                                            class="thumb">
                                                    @endif
                                                    <span class="title">{{ $barang->nama_barang }}</span>
                                                </span>
                                            </div>
                                            <div class="nk-tb-col">
                                                <span class="tb-sub"> {!! DNS1D::getBarcodeSVG($barang->barcode, 'C128', 1.5, 50, true) !!}</span>
                                            </div>
                                            @php
                                                $number = $barang->harga_barang;
                                                $formatted = 'Rp ' . number_format($number, 1, ',', '.');
                                                
                                            @endphp
                                            <div class="nk-tb-col">
                                                <span class="tb-lead">{{ $formatted }}</span>
                                            </div>
                                            <div class="nk-tb-col">
                                                <span class="tb-sub">{{ $barang->stok }}</span>
                                            </div>
                                            <div class="nk-tb-col tb-col-md">
                                                <span class="tb-sub">{{ $barang->kategory->nama_kategory }}</span>
                                            </div>
                                            <div class="nk-tb-col tb-col-md">
                                                @if ($barang->status_barang == 'aktif')
                                                    <span class="badge rounded-pill bg-success badge-md">Aktif</span>
                                                @elseif($barang->stok == '0')
                                                    <span class="badge rounded-pill bg-warning badge-md">Stok Kosong</span>
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
                                                                    <li><a
                                                                            href="{{ route('databarang.edit', $barang->id_barang) }}"><em
                                                                                class="icon ni ni-edit"></em><span>Edit
                                                                                Barang</span></a></li>
                                                                    <li><a
                                                                            href="{{ route('databarang.show', $barang->id_barang) }}"><em
                                                                                class="icon ni ni-eye"></em><span>Tampilkan
                                                                                Barang</span></a></li>
                                                                    <li><a type="button" class="btn-jumlah"
                                                                            data-id="{{ $barang->id_barang }}"
                                                                            data-route="{{ route('print.label.barang', $barang->id_barang) }}"><em
                                                                                class="icon ni ni-label btn-jumlah"></em><span>Print
                                                                                Label Harga</span></a>
                                                                    </li>
                                                                    <li> <a type="button" class="btn-jumlah"
                                                                            data-id="{{ $barang->id_barang }}"
                                                                            data-route="{{ route('print.barcode.barang', $barang->id_barang) }}"><em
                                                                                class="icon ni ni-qr btn-jumlah"></em><span>Print
                                                                                Barcode Barang</span></a></li>
                                                                    <li>
                                                                        <a type="button" class="btn-delete"
                                                                            data-id="{{ $barang->id_barang }}"><em
                                                                                class="icon ni ni-trash btn-delete"></em><span>Hapus
                                                                                Barang</span></a>
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
                                <!-- .nk-tb-item -->
                            </div><!-- .nk-tb-list -->
                        </div>
                        <div class="card-inner">
                            <div class="nk-block-between-md g-3">
                                <div class="g">
                                    {{ $databarang->links() }}
                                </div>
                                <div class="g">
                                    @php
                                        $total = DB::table('databarang')->count();
                                    @endphp
                                    <div>Total <strong>{{ $total }}</strong></div>
                                </div><!-- .nk-block-between -->
                            </div>
                        </div>
                    </div>
                </div><!-- .nk-block -->
                <div class="nk-add-product toggle-slide toggle-slide-right" data-content="addProduct"
                    data-toggle-screen="any" data-toggle-overlay="true" data-toggle-body="true" data-simplebar>
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h5 class="nk-block-title">Produk Baru</h5>
                            <div class="nk-block-des">
                                <p>Tambah data Informasi Produk Baru</p>
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
                        <form action="{{ route('databarang.store') }}" method="POST" enctype="multipart/form-data"
                            class="form-validate">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="nama_barang">Nama Barang</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" value="{{ old('nama_barang') }}"
                                                name="nama_barang" id="nama_barang" placeholder="Nama Barang" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="stok">Stok</label>
                                        <div class="form-control-wrap">
                                            <input type="number" min="1" name="stok" class="form-control"
                                                value="{{ old('stok') }}" id="stok" placeholder="Stok Barang"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="harga_barang">Harga Barang</label>
                                        <div class="form-control-wrap">
                                            <div class="form-text-hint">
                                                <span class="overline-title">Rp</span>
                                            </div>
                                            <input type="text" class="form-control" required
                                                value="{{ old('harga_barang') }}" name="harga_barang" id="default-05"
                                                placeholder="Harga Barang">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="barcode">Barcode Barang</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" required
                                                value="{{ old('barcode') }}" name="barcode" id="barcode"
                                                placeholder="Barcode Barang">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="category">Category</label>
                                        <div class="form-control-wrap">
                                            <div class="form-control-select">
                                                <select class="form-control" required name="id_kategory" id="category">
                                                    <option value="default_option" selected disabled>Pilih Kategory
                                                    </option>
                                                    @foreach ($kategory as $kate)
                                                        <option
                                                            {{ old('id_kategory') == $kate->id_kategory ? 'selected' : '' }}
                                                            value="{{ $kate->id_kategory }}">
                                                            {{ $kate->nama_kategory }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label" for="customMultipleFiles">Foto Barang</label>
                                    <div class="form-file">
                                        <input type="file" multiple class="form-file-input" name="foto_barang"
                                            id="customMultipleFiles"
                                            accept="image/jpeg,image/png,image/jpg,image/bmp, image/webp,image/svg+xml">
                                        <label class="form-file-label" for="customMultipleFiles">Choose files</label>
                                    </div>
                                </div>
                                <div class="col-12 ">
                                    <button class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Tambah
                                            Barang</span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>

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
    <div class="modal fade" id="jumlah" aria-modal="true" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Jumlah Yang Ingin Di Print</h5><a href="#" class="close" data-bs-dismiss="modal"
                        aria-label="Close"><em class="icon ni ni-cross"></em></a>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST" id="form-jumlah" class="form-validate" novalidate="novalidate">
                        @csrf
                        <div class="form-group">
                            <label class="form-label" for="jumlah">Jumlah</label>
                            <div class="form-control-wrap">
                                <input type="number" class="form-control" 
                                    name="jumlah" id="Jumlah" placeholder="Jumlah" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <a href="#" class="btn btn-lg btn-mw btn-light" data-bs-dismiss="modal">Return</a>
                            <button class="btn btn-primary btn-lg">Print</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
   
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            const formEdit = $('#form-edit');
            const formjumlah = $('#form-jumlah');
            const filterForm = $('#filter');
            const filterCategoryForm = $('#filter-kategory');
            const filterSelect = $('#filter-select');
            const filterSelectCategory = $('#filter-select-kategory');
            const deleteModal = $('#delete');
            const jumlahModal = $('#jumlah');

            $(document).on('click', '.btn-delete', function() {
                const id = $(this).data('id');
                formEdit.attr('action', '/databarang/delete/' + id);
                formEdit.append('<input type="hidden" name="_method" value="DELETE">');
                deleteModal.modal('show');
            });
            $(document).on('click', '.btn-jumlah', function() {
                const id = $(this).data('id');
                const route = $(this).data('route');
                formjumlah.attr('action', route);
                jumlahModal.modal('show');
            });

            filterSelect.on('change', function() {
                filterForm.find('[name=filter]').val(this.value);
                filterForm.submit();
            });

            filterSelectCategory.on('change', function() {
                filterCategoryForm.find('[name=filter]').val(this.value);
                filterCategoryForm.submit();
            });
        });
    </script>
@endsection
