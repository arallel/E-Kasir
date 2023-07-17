    @extends('admin.layout.main')
    @section('title', 'Data Barang')
    @section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Data Barang</h3>
                    </div><!-- .nk-block-head-content -->
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em
                                class="icon ni ni-more-v"></em></a>
                                <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                        <li>
                                            <form action="{{ route('databarang.index') }}" method="Get" id="filter">
                                                @csrf
                                                <div class="form-control-select">
                                                    <select class="form-control" name="status" id="filter-select">
                                                        <option selected disabled>Status</option>
                                                        <option {{ (request()->get('status') == 'semua')?'selected':'' }} value="semua"><span>Semua</span></option>
                                                        <option {{ (request()->get('status') == 'tidak_tersedia')?'selected':'' }} value="tidak_tersedia"><span>Tidak Tersedia</span></option>
                                                        <option {{ (request()->get('status') == 'tersedia')?'selected':'' }} value="tersedia"><span>Tersedia</span></option>
                                                        <option {{ (request()->get('status') == 'stok_kosong')?'selected':'' }} value="stok_kosong"><span>Stok Kosong</span></option>
                                                    </select>
                                                </div>
                                            </form>
                                        </li>
                                        <li>
                                            <form action="{{ route('databarang.index') }}" method="Get"
                                            id="filter-kategory">
                                            @csrf
                                            <div class="form-control-select">
                                                <select class="form-control" name="kategory" id="filter-select-kategory">
                                                    <option selected disabled>Kategory</option>
                                                    @foreach ($kategory as $katef)
                                                    <option {{ (request()->get('kategory') == $katef->id_kategory)?'selected':'' }} value="{{ $katef->id_kategory }}">
                                                        <span>{{ $katef->nama_kategory }}</span>
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </form>
                                    </li>
                                    <li class="nk-block-tools-opt">
                                        <a href="#" onclick="storebarang()"  data-target="addProduct"
                                        class="toggle btn btn-icon btn-primary d-md-none"><em
                                        class="icon ni ni-plus"></em></a>
                                        <a href="#" data-target="addProduct" onclick="storebarang()" 
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
                        <div class="card-inner">
                            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                <thead>
                                    <tr class="nk-tb-item nk-tb-head">
                                        <th class="nk-tb-col ">
                                            <span>No</span>
                                        </th>
                                        <th class="nk-tb-col tb-col-sm"><span>Kode barang</span></th>
                                        <th class="nk-tb-col"><span>Nama Barang</span></th>
                                        <th class="nk-tb-col"><span>Harga Beli</span></th>
                                        <th class="nk-tb-col tb-col-md"><span>Harga Jual</span></th>
                                        <th class="nk-tb-col tb-col-md"><span>Stok</span></th>
                                        <th class="nk-tb-col tb-col-md"><span>Kategory</span></th>
                                        <th class="nk-tb-col tb-col-md"><span>Status Barang</span></th>
                                        <th class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1 my-n1">
                                                <li class="me-n1">
                                                    <div class="dropdown">
                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </th>
                                    </tr><!-- .nk-tb-item -->
                                </thead>
                                <tbody>
                                    @foreach ($databarang as $barang)
                                    <tr class="nk-tb-item">
                                        <td class="nk-tb-col">
                                         <span class="tb-lead">{{ $loop->iteration }}</span>
                                     </td> 
                                     <td class="nk-tb-col">
                                         <span class="tb-lead">{{ $barang->id_barang }}</span>
                                     </td>
                                     <td class="nk-tb-col tb-col-sm">
                                        <span class="tb-product">
                                            @if ($barang->foto_barang == null)
                                            <img src="{{ asset('assets/images/no-image.jpg') }}" alt=""
                                            class="thumb" style="height:3rem;">
                                            @else
                                            <img src="storage/{{ $barang->foto_barang }}" alt=""class="thumb" style="height:3rem;">
                                            {{-- <img src="{{ $barang->foto_barang }}"class="thumb" style="height:3rem;"> --}}
                                            @endif
                                            <span class="title text-start">{{ Str::limit($barang->nama_barang,50) }}</span>
                                        </span>
                                    </td>
                                    <td class="nk-tb-col">
                                     <span class="tb-lead">Rp.{{ number_format($barang->harga_pembelian, 0, ',', '.') }}</span>
                                 </td>
                                 <td class="nk-tb-col">
                                     <span class="tb-lead">Rp.{{ number_format($barang->harga_barang, 0, ',', '.'); }}</span>
                                 </td>
                                 <td class="nk-tb-col tb-col-md"><span class="tb-sub">{{ $barang->stok }}</span></td>
                                 <td class="nk-tb-col tb-col-md"><span class="tb-sub">{{ $barang->kategory->nama_kategory }}</span></td>
                                 <td class="nk-tb-col tb-col-md">
                                    @if ($barang->stok == 0)
                                    <span class="badge rounded-pill bg-warning badge-md">Stok Kosong</span>
                                    @elseif($barang->status_barang == 'aktif')
                                    <span class="badge rounded-pill bg-success badge-md">Tersedia</span>
                                    @else
                                    <span class="badge rounded-pill bg-secondary badge-md">Tidak
                                    Tersedia</span>
                                    @endif
                                </td>
                                <td class="nk-tb-col nk-tb-col-tools">
                                    <ul class="nk-tb-actions gx-1">
                                        <li class="me-n1">
                                            <div class="dropdown">
                                                <a href="#"
                                                class="dropdown-toggle btn btn-icon btn-trigger"
                                                data-bs-toggle="dropdown"><em
                                                class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li>
                                                            <a type="button" data-id="{{ $barang->id_barang }}"  class="btn-stokjumlah"><em class="icon ni ni-edit"></em><span>Tambah Stok</span></a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('databarang.edit', $barang->id_barang) }}">    <em class="icon ni ni-edit"></em><span>Edit Barang</span></a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('databarang.show', $barang->id_barang) }}"><em class="icon ni ni-eye"></em><span>Tampilkan
                                                            Barang</span></a>
                                                        </li>
                                                        <li>
                                                            <a type="button" class="btn-jumlah"data-id="{{ $barang->id_barang }}" data-route="{{ route('print.label.barang', $barang->id_barang) }}"><em class="icon ni ni-label btn-jumlah"></em><span>Print Label Harga</span></a>
                                                        </li>
                                                        <li> 
                                                            <a type="button" class="btn-jumlah"
                                                                data-id="{{ $barang->id_barang }}"
                                                                data-route="{{ route('print.barcode.barang', $barang->id_barang) }}"><em
                                                                class="icon ni ni-qr btn-jumlah"></em><span>Print
                                                                Barcode Barang</span></a>
                                                        </li>
                                                        <li>
                                                            <a type="button" class="btn-delete"data-id="{{ $barang->id_barang }}"><em class="icon ni ni-trash btn-delete"></em><span>Hapus Barang</span></a>
                                                        </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </td>
                                </tr><!-- .nk-tb-item -->
                                @endforeach
                            </tbody>
                        </table><!-- .nk-tb-list -->
                    </div>
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>
<div class="nk-add-product toggle-slide toggle-slide-right" data-content="addProduct"
data-toggle-screen="any" data-toggle-overlay="true" data-toggle-body="true" data-simplebar id="storebarang">
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
            <label class="form-label" for="nama_barang">Nama Barang</label>
            <div class="form-control-wrap">
                <input type="text" class="form-control" value="{{ old('nama_barang') }}"
                name="nama_barang" id="nama_barang" placeholder="Nama Barang" required>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label" for="harga_pembelian">Harga Pembelian</label>
            <div class="form-control-wrap">
                <div class="form-text-hint">
                    <span class="overline-title">Rp</span>
                </div>
                <input type="number" min="1" name="harga_pembelian" class="form-control"
                value="{{ old('harga_pembelian') }}" id="harga_pembelian" placeholder="Harga Pembelian"
                required>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label" for="harga_barang">Harga Jual</label>
            <div class="form-control-wrap">
                <div class="form-text-hint">
                    <span class="overline-title">Rp</span>
                </div>
                <input type="number" class="form-control" required
                value="{{ old('harga_barang') }}" name="harga_barang" id="default-05"
                placeholder="Harga Barang">

            </div>
        </div>
    </div>
    <div class="col-12">
     <div class="form-group">
        <label class="form-label" for="stok">Stok</label>
        <div class="form-control-wrap">
            <input type="number" min="1" name="stok" class="form-control"
            value="{{ old('stok') }}" id="stok" placeholder="Stok Barang"
            required>
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
                            <a href="#" class="btn btn-lg btn-mw btn-light" data-bs-dismiss="modal">Kembali</a>
                            <button class="btn btn-danger btn-lg">Hapus</button>
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
                        <a href="#" class="btn btn-lg btn-mw btn-light" data-bs-dismiss="modal">Kembali</a>
                        <button class="btn btn-primary btn-lg">Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="tmbhstok" aria-modal="true" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Stok Yang Akan Ditambahkan</h5><a href="#" class="close" data-bs-dismiss="modal"
                aria-label="Close"><em class="icon ni ni-cross"></em></a>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" id="form-addstok" class="form-validate" novalidate="novalidate">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label class="form-label" for="jumlah">Jumlah</label>
                        <div class="form-control-wrap">
                            <input type="number" class="form-control" 
                            name="jumlah" id="Jumlah" placeholder="Jumlah" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <a href="#" class="btn btn-lg btn-mw btn-light" data-bs-dismiss="modal">kembali</a>
                        <button class="btn btn-primary btn-lg">Tambah Stok</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script> 
    function storebarang()
    {
        const barcode = document.getElementById('barcode');
        barcode.focus();
    }
    $(document).ready(function() {
        const formEdit = $('#form-edit');
        const formjumlah = $('#form-jumlah');
        const formaddstok = $('#form-addstok');
        const filterForm = $('#filter');
        const filterCategoryForm = $('#filter-kategory');
        const filterSelect = $('#filter-select');
        const filterSelectCategory = $('#filter-select-kategory');
        const deleteModal = $('#delete');
        const jumlahModal = $('#jumlah');
        const addstokModal = $('#tmbhstok');

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
        $(document).on('click', '.btn-stokjumlah', function() {
            const id = $(this).data('id');
            formaddstok.attr('action', '/databarang/update-stok/'+ id);
            addstokModal.modal('show');
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
