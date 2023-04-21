@extends('admin.layout.main')
@section('title', 'Transaksi')
@section('content')
<style>
.imgbarang{
    cursor: pointer;
}
</style>   
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
                                    <form id="barcode_form">
                                        <div class="row">
                                            @csrf
                                            <div class="col-6 mb-3">
                                                <input type="text" autofocus class="form-control" name="barcode"
                                                id="barcode" placeholder="Scan Barcode">
                                            </div>
                                        </form>
                                        <div class="col-6 mb-3">
                                            <input type="text" autofocus class="form-control" name="nama_barang"
                                            id="nama_barang" placeholder="Search By Name">
                                        </div>
                                    </div>
                                    <div class="row">
                                        @foreach ($databarang as $data)
                                        <div class="col-12 col-md-4 mt-2">
                                            <div class="card imgbarang shadow" data-barcode="{{ $data->barcode }}" >
                                                <div class="card-inner text-center">
                                                    @if ($data->foto_barang == null)
                                                    <img src="{{ asset('assets/images/no-image.png') }}" alt=""
                                                    class="">
                                                    @else
                                                    <img src="storage/{{ $data->foto_barang }}"
                                                    class="" alt="">
                                                    @endif
                                                    <h6 class="fw-medium">{{ $data->nama_barang }}</h6>
                                                    <p class="text-muted">Stok : {{ $data->stok }}</p>
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
                                        <h4 class="text-center">Transaksi</h4>
                                        <hr class="m-2">
                                        @if($datasementara != null)
                                        @foreach ($datasementara as $dataitem)
                                        @if ($dataitem != null)
                                        <div class="row mt-3">
                                            <div class="col-3 ">
                                                @if ($dataitem['foto_barang'] == null)
                                                <div class="col-12">
                                                    <img src="{{ asset('assets/images/no-image.png') }}"
                                                    alt="" class="user-avatar md sq bg-white">
                                                </div>
                                                @else
                                                <div class="col-8">
                                                    <img src="storage/{{ $dataitem['foto_barang'] }}"
                                                    class="user-avatar md sq bg-white" alt="">
                                                </div>
                                                @endif
                                            </div>

                                            <div class="col-5 ">
                                                <h5 class="fw-medium  text-capitalize">
                                                    {{ $loop->iteration }}.

                                                    {{ $dataitem['nama_barang'] }}
                                                </h5>
                                                <div class="row mt-3">
                                                    <h5 class="text-primary fw-bold">
                                                        Rp.{{ $dataitem['harga_barang'] * $dataitem['qty']  }}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="ms-auto  form-group col-12 col-md-9 m-auto ">
                                                <form id="ubah_qty">
                                                    @csrf
                                                    <div class="form-control-wrap number-spinner-wrap">
                                                        <button class="btn btn-icon btn-outline-light number-spinner-btn number-minus btn-primary"
                                                        data-number="kurang">
                                                        <em class="icon ni ni-minus text-white"></em>
                                                    </button>
                                                    <input type="number" disabled  name="qty[]" class="form-control disabled number-spinner test"
                                                    value="{{ $dataitem['qty'] }}" data-id="{{ $dataitem['id_barang'] }}"
                                                    data-harga="{{ $dataitem['harga_barang'] }}" data-qty="{{ $dataitem['qty'] }}">
                                                    <button class="btn btn-icon btn-outline-light number-spinner-btn number-plus btn-primary"
                                                    data-number="tambah">
                                                    <em class="icon ni ni-plus text-white"></em>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                            @endif
                            <form action="{{ route('Transaksi.store') }}" method="post">
                                @csrf
                            <div class="form-control-wrap mt-4">
                                <label class="form-label">Uang Dibayarkan</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="jumlah_uang" placeholder="Jumlah Uang Dibayarkan">
                                </div>
                            </div>


                            <div class="card mt-3 bg-light">
                                <div class="card-inner mb-2">
                                    <h4 class="fw-bold">Harga</h4>
                                    <div class="row">
                                        <div class="col-8">
                                            <p><strong>SubTotal</strong></p>
                                        </div>
                                        <div class="text-end col-4">
                                            <p id="SubTotal">Rp.0</p>
                                        </div>
                                        {{-- <div class="col-8">
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
                                        </div> --}}
                                        <br>
                                        <hr class="m-2">
                                        <div class="col-8">
                                            <h5><strong>Total Belanja</strong></h5>
                                        </div>
                                        <div class="text-end col-4">
                                            <h5 id="total">Rp.0</h5>
                                        </div>
                                        <div class="col-8">
                                            <h6><strong>Total Kembalian</strong></h6>
                                        </div>
                                        <div class="text-end col-4">
                                            <h6 id="kembalian">Rp.0</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <button class="btn  btn-secondary col-12 justify-content-center mt-2">Bersihkan Items</button> --}}
                            
                                <button class="btn btn-success col-12 justify-content-center mt-2 ">Bayar</button>
                            </form>
                        </div>
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
<script>
    getdata();
    $(document).ready(function () {
        $('#barcode').on('input', function () {
            var barcode = $('#barcode').val().trim();
            if (barcode == '') {
                return;
            }
            var formData = $('#barcode_form').serialize();
            $.ajax({
                type: "POST",
                url: "{{ route('Transaksi.store.session') }}",
                data: formData,
                success: function (data) {
                    var pesan = 'data berhasil Ditambahkan';
                    location.reload(true);
                      $('#barcode').val('');
                    toaster(pesan);
                },
                error: function (xhr, status, error) {
                     var pesan = 'barang tidak ditemukan';
                    toastergagal(pesan);
                      $('#barcode').val('');
                }
            });        
        });
        $('.number-spinner-btn').click(function(event) {
            event.preventDefault();
            var input = $(this).parent().find('input');
            var id_barang = input.data('id');
            var harga_barang = input.data('harga');
            var qty = parseInt(input.val());
            var action = $(this).data('number');
            if (action == 'tambah') {
                qty++;
            } else if (action == 'kurang') {
                qty--;
            }
            if (qty > 0) {
                updateCartItem(id_barang, qty, '{{ route('update.cart') }}');
                getdata();
            } else {
                removeFromCart(id_barang, '{{ route('remove-from-cart') }}');
                getdata();
            }
            input.val(qty);
        });
        $('input[name="jumlah_uang"]').on('blur', function() {
            getdata();
        });
         $('.imgbarang').click(function (barcode) {
            var barcode = $(this).data('barcode');
            $.ajax({
                type: "POST",
                url: "{{ route('Transaksi.store.session') }}",
                data: {
                    barcode:barcode,
                    _token: '{{ csrf_token() }}'
                },
                success: function (data) {
                    var pesan = 'data berhasil Ditambahkan';
                    location.reload(true);
                    toaster(pesan);
                },
                error: function (xhr, status, error) {
                    alert('error');
                }
            });     
         });
    });


    function kembalian(total_barang){    
        var jumlah_uang = $('input[name="jumlah_uang"]').val();
        if(jumlah_uang){
            var hitungkembalian = jumlah_uang - total_barang;
            $('#kembalian').text('Rp.' + hitungkembalian.toLocaleString('id-ID'));
        }
    }
    function toaster(pesan)
    {
        var mes = pesan;
        toastr.clear();
        NioApp.Toast(pesan, 'success', {
          position: 'top-right',
          showDuration: "100",
          preventDuplicates: true,
          progressBar: true,
          showMethod: "fadeIn",
          hideMethod: "fadeOut"
      });
    }
    function toastergagal(pesan)
    {
        var mes = pesan;
        toastr.clear();
        NioApp.Toast(pesan, 'error', {
          position: 'top-right',
          showDuration: "100",
          preventDuplicates: true,
          progressBar: true,
          showMethod: "fadeIn",
          hideMethod: "fadeOut"
      });
    }

    function getdata()
    {
        $.ajax({
            type: 'POST',
            url: '/get-session-data',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                var databarang = response;
                var total_barang = 0;
                $.each(databarang, function (index, barang) {
                    var hitung = barang.harga_barang * barang.qty;
                    total_barang += hitung;
                });
                $('#SubTotal').text('Rp.' + total_barang.toLocaleString('id-ID'));
                $('#total').text('Rp.' + total_barang.toLocaleString('id-ID'));
                kembalian(total_barang);

            },
            error: function(xhr) {
                console.log('Error retrieving session data');
            }
        });
    }
    function updateCartItem(id_barang, qty, url) {
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                id_barang: id_barang,
                qty: qty,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                var pesan = 'data berhasil diubah';
                toaster(pesan);
                getdata();
            },
            error: function(xhr) {
             alert('gagal update data');
         }
     });
    }

    function removeFromCart(id_barang, url) {
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                id_barang: id_barang,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
               location.reload(true);
               var pesan = 'data berhasil di hapus';
               toaster(pesan);
               getdata();
           },
           error: function(xhr) {
           }
       });
    }
</script>
@endsection
