@extends('admin.layout.main')
@section('title','Transaksi')
@section('content')
@livewireStyles

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
                    <form id="test">
                        <div class="row">
                          @csrf
                          <div class="col-6 mb-3">
                            <input type="text" autofocus class="form-control" name="barcode" id="barcode" placeholder="Scan Barcode" >
                        </div>
                    </form>
                    <div class="col-6 mb-3">
                        <input type="text" autofocus class="form-control" name="nama_barang" id="nama_barang" placeholder="Search By Name" >
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
                         <p>Stok : {{ $data->stok }}</p>
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
                    {{-- <div>
                   <livewire:cartcomponent wire.poll.2s/>
               </div> --}}
               @foreach($datasementara as $data => $dataitem)
               <div class="col-8">
                   <div class="col-8">
                       <p><strong>{{ $data }}.{{ $dataitem[0]->nama_barang }}</strong>Barang <a href="" class="text-dark">
                           <em class="icon ni ni-edit ni-lg"></em>
                       </a></p>
                   </div>
               </div> 
               <div class="text-end col-4">
                <p>Rp.{{ $dataitem[0]->harga_barang }}</p>
            </div> 
            @endforeach 
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
   $(document).ready(function () {
    $('#barcode').on('blur', function () {
        // Mengambil nilai input field
        // var barcode = $('#barcode').val().trim();
        var barcode = $('#barcode').val().trim();
        // Menambahkan validasi jika ada input field yang kosong
        if (barcode == '') {
            return; // Kembali tanpa mengirim Ajax request
        }
        var formData = $('#test').serialize();
        $.ajax({
            type: "POST",
            url: "{{ route('Transaksi.store.session') }}",
            data: formData,
            success: function (data) {
                alert('success');
            },
            error: function (xhr, status, error) {
                alert('error');
            }
        });        
    });
});

</script>
@livewireScripts

@endsection