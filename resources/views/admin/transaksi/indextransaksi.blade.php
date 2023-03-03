@extends('admin.layout.main')
@section('title','Transaksi')
@section('content')
 <div class="nk-content-inner">
     <div class="nk-content-body">
       <div class="nk-block-head nk-block-head-sm">
          <div class="nk-block-between">
               <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Transaksi</h3>
                    </div><!-- .nk-block-head-content -->
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em
                                    class="icon ni ni-more-v"></em></a>
                            <div class="toggle-expand-content" data-content="pageMenu">
                                <ul class="nk-block-tools g-3">
                                    <li>
                                        <div class="form-control-wrap">
                                            {{-- <div class="form-icon form-icon-right">
                                                <em class="icon ni ni-search"></em>
                                            </div> --}}
                                            {{-- <form action="{{ route('search.barang') }}" method="post">
                                                @csrf
                                                <input type="text" class="form-control" name="search" id="default-04"
                                                    placeholder="Search By Name">
                                            </form> --}}
                                        </div>
                                    </li>
                                    <li>
                                        {{-- <form action="{{ route('filter.barang') }}" method="post" id="filter">
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
                                        </form> --}}
                                        <li>
                                           {{--  <form action="{{ route('filter.kategory.barang') }}" method="post" id="filter-kategory">
                                            @csrf
                                            <div class="form-control-select">
                                                <select class="form-control" name="filter" id="filter-select-kategory">
                                                    <option selected disabled>Kategory</option>
                                                    @foreach($kategory as $katef)
                                                    <option value="{{ $katef->id_kategory }}"><span>{{ $katef->nama_kategory }}</span></option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </form> --}}
                                        </li>
                                    </li>
                                    {{-- <li class="nk-block-tools-opt">
                                        <a href="#" data-target="addProduct"
                                            class="toggle btn btn-icon btn-primary d-md-none"><em
                                                class="icon ni ni-plus"></em></a>
                                        <a href="#" data-target="addProduct"
                                            class="toggle btn btn-primary d-none d-md-inline-flex"><em
                                                class="icon ni ni-plus"></em><span>Add Product</span></a>
                                    </li> --}}
                                </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <div class="nk-block">
     <div class="card">
                    <div class="card-inner">
                        <div class="row">
                            <div class="col-8">
                                <div class="card-inner shadow">
                                    <div class="row">
                                        <div class="col-6 mb-3">
                            <input type="text" class="form-control" name="search" id="default-04" placeholder="Scan Barcode" >
                        </div>
                        <div class="col-5 mb-3">
                            <input type="text" class="form-control" name="search" id="default-04" placeholder="Search By Name" >
                        </div>
                        </div>
                             <div class="row">
                                @foreach($databarang as $data)
                                 <div class="col-4 mt-2">
                                     <div class="card">
                                        @if ($data->foto_barang == null)
                                     <img src="{{ asset('assets/images/no-image.png') }}" alt=""class="card-img-top h-50">
                                     @else
                                     <img src="storage/{{ $data->foto_barang }}" class="card-img-top img-responsive" alt="">
                                     @endif
                                         <div class="card-inner text-center">
                                             <h6>{{ $data->nama_barang }}</h6>
                                             <p>Stok : {{ $data->stok_barang }}</p>
                                         </div>
                                     </div>
                                 </div>
                                 @endforeach
                             </div>           
                                </div>
                            </div>
                            <div class="col">
                                <div class="card">
                                    <div class="card-inner">
                                        <h4>Transaksi</h4>
                                        <div class="row">
                                            <div class="col-8">
                                               <p><strong>1.  </strong>Barang <a href="" class="text-dark">
                                                   <em class="icon ni ni-edit ni-lg"></em>
                                               </a></p>
                                            </div>
                                            <div class="text-end col-4">
                                                <p>100$</p>
                                            </div> 

                                        </div>
                                    </div>
                                </div>
                                <div class="card mt-3">
                                    <div class="card-inner">
                                        <h4>Kupon</h4>
                                        <div class="form-control-wrap">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Apply Cuppon">
        <div class="input-group-append">
            <button class="btn btn-primary ">Apply</button>
        </div>
    </div>
</div>
                                    </div>
                                </div>
                                <div class="card mt-3">
                                    <div class="card-inner">
                                        <h4>Harga</h4>
                                        <div class="row">
                                                <div class="col-8">
                                                   <p><strong>SubTotal</strong></p>
                                                </div>
                                                <div class="text-end col-4">
                                                    <p>100$</p>
                                                </div> 
                                                <div class="col-8">
                                                   <p><strong>Diskon</strong></p>
                                                </div>
                                                <div class="text-end col-4">
                                                    <p>5$</p>
                                                </div> 
                                                <div class="col-8">
                                                   <p><strong>Pajak</strong></p>
                                                </div>
                                                <div class="text-end col-4">
                                                    <p>5%</p>
                                                </div> 
                                                <br>
                                                <hr>
                                                <div class="col-8">
                                                   <h5><strong>Total Belanja</strong></h5>
                                                </div>
                                                <div class="text-end col-4">
                                                    <h5>$200</h5>
                                                </div> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-6">
                                       <button class="btn  btn-secondary">Bersihkan Items</button>
                                    </div>
                                    <div class="col-6">
                                        
                                        <button class="btn btn-xl btn-primary">Bayar</button>
                                    </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>        
    </div>
</div>{{-- nk-body-end --}}
</div> {{-- nk-content-end --}}
@endsection