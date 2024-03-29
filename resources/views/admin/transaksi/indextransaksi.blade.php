@extends('admin.layout.main')
@section('title', 'Transaksi')
@section('content')
<style>

</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
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
                                <div class="card-inner">
                                    <form id="barcode_form">
                                        <div class="row">
                                            <div class="col-12 col-md-6 mb-3">
                                                <input type="text" autofocus class="form-control" name="barcode"
                                                id="barcode" placeholder="Scan Barcode">
                                            </div>
                                        </form>
                                        <div class="col-12 col-md-6 mb-3">
                                            <div class="form-control-wrap">    
                                                <div class="input-group">        
                                                 <input type="text" autofocus class="form-control" name="nama_barang"
                                                 id="search_namabarang" placeholder="Search By Name">
                                                 <div class="input-group-append">          
                                                    <button type="button" id="btn-search" class="btn btn-primary"><em class="icon ni ni-search"></em></button>        
                                                </div>    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-inner overflow-y-scroll">
                                <div class="row ">
                                    @foreach ($databarang as $data)
                                    <div class="col-md-4 col-sm-7 mt-2">
                                        <div class="card product-card  {{ ($data->stok == 0)?'disabled-card':'imgbarang' }} shadow" 
                                            data-barcode="{{ $data->barcode }}"
                                            data-stok="{{ $data->stok }}" data-nama="{{ $data->nama_barang }}"
                                            data-foto="{{ $data->foto_barang }}" data-id="{{ $data->id_barang }}"
                                            data-harga="{{ ($data->checkpotongan != null && $data->checkpotongan->status_potongan == 'aktif' && $data->checkpotongan->kode_promo == null)?$data->checkpotongan->harga_setelah_potongan : $data->harga_barang }}">
                                            <div class="product-thumb">
                                                <a href="">
                                                    @if ($data->foto_barang == null)
                                                    <img src="{{ asset('assets/images/no-image.jpg') }}">
                                                    @else
                                                    <img class="card-img-top img-fluid lazyload" src=" storage/{{ $data->foto_barang }}">
                                                    {{-- <img class="card-img-top img-fluid lazyload" src="{{ $data->foto_barang }}"/> --}}
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="card-inner text-center">
                                                <h6 class="product-title">{{ Str::limit($data->nama_barang,20) }}</h6>
                                                <p>Stok:{{ $data->stok }}</p>
                                                <div class="product-price text-primary h5  fw-medium">
                                                @if($data->checkpotongan != null && $data->checkpotongan->status_potongan == 'aktif' && $data->checkpotongan->harga_potongan_persen && $data->checkpotongan->kode_promo == null)
                                                    <small class="text-muted fs-16px text-primary">Diskon:<span class="badge bg-primary">%{{ $data->checkpotongan->harga_potongan_persen }}</span></small>
                                                {{ 'Rp.'.number_format($data->checkpotongan->harga_setelah_potongan) }}
                                                @elseif($data->checkpotongan != null && $data->checkpotongan->status_potongan == 'aktif' && $data->checkpotongan->harga_potongan_rp && $data->checkpotongan->kode_promo == null)
                                                <small class="text-muted del fs-13px">Rp.{{ $data->checkpotongan->harga_potongan_rp }}</small>
                                                {{ 'Rp'.number_format($data->checkpotongan->harga_setelah_potongan) }}
                                                @else
                                                {{ 'Rp'.number_format($data->harga_barang) }}
                                                @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- .col -->
                                    @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card shadow">
                            <div class="card-inner">
                                <h4 class="text-center">Transaksi</h4>
                                <hr class="m-2">
                                <div class="row"  style="">
                                    <div class="overflow-y-scroll-transaksi" id="show-cart"></div>
                                </div>
                                <div class="mt-4" id="show-count">
                                    <h5 class="total-cart"></h5>
                                    <h5 class="total-count"></h5>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-3 shadow">
                            <div class="card-inner" id="show-btn" >
                                <button type="button" class="btn btn-warning clear-cart">Bersihkan Cart</button>
                                <button id="btn-bayar" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalDefault">Bayar</button>
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
<!-- Modal Trigger Code -->

<!-- Modal Content Code -->
<div class="modal fade" tabindex="-1" id="modalDefault">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('Transaksi.store') }}" method="post">
                    @csrf
                    <input type="hidden" id="datastorageweb" name="datastorageweb">
                    <input type="hidden" id="total-harga" name="total_harga">
                    <div class="form-group">
                        <label>Jumlah Uang Dibayarkan</label>
                        <input type="number" id="uang_dibayar" class="form-control" name="uang_dibayarkan">
                        <p class="text-danger ml-1" id="alert-text"></p>
                    </div> 
                        {{-- <div class="form-group">
                            <label>Diskon</label>
                            <input type="text" class="form-control" name="diskon">
                        </div> --}}
                        <div class="form-group" style="display: none;" id="display-kembalian">
                            <label>Kembalian</label>
                            <input type="text" class="form-control" id="kembalian_disabled" disabled>
                            <input  type="hidden" class="form-control" id="kembalian"   name="kembalian">
                        </div>

                    </div>
                    <div class="modal-footer bg-light">
                        <button class="btn btn-secondary " id="dismis-modal" type="button" data-bs-dismiss="modal">Kembali</button>
                        <button class="btn btn-success">Bayar</button>
                    </form>
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
<script src="https://cdn.jsdelivr.net/npm/lazyload@2.0.0-rc.2/lazyload.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    const inputsearchnama = document.getElementById('search_namabarang');
    const btnsearchnama = document.getElementById('btn-search');
    const inputbarcode = document.getElementById('barcode');
    const btnbayar = document.getElementById('btn-bayar');

    btnsearchnama.addEventListener('click',function(){
        getbarangbyname(inputsearchnama.value);
    });
    inputbarcode.addEventListener('change',function(){
        const value = this.value;
        getListItemByBarcode(value);
    });
    function getbarangbyname(nama_barang) {
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
                  .attr('data-harga', item.checkpotongan != null ? item.checkpotongan.harga_setelah_potongan : item.harga_barang)
                  .attr('data-stok', item.stok)
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
      const row = $('table tbody tr:eq(' + rowIndex + ')');
      const button = document.getElementsByClassName('btn-pilih')[rowIndex];
      const id = button.getAttribute('data-id');
      const price = button.getAttribute('data-harga');
      const name = button.getAttribute('data-nama');
      const qtymax = button.getAttribute('data-stok');
      shoppingCart.addItemToCart(name, price,id, 1,qtymax);
        displayCart();
        checkscroll();
        inputsearchnama.value = '';
     $('#modalTop').modal('hide');
  }
 function getListItemByBarcode(barcode) {
     $.ajax({
        url: "api/getitembybarcode",
        method: "GET",
        data: {
          barcode: barcode
      },
      success: function(data) {
        event.preventDefault();
        if(data.nama_barang != null && data.harga_barang != null && data.id_barang != null){
            const name = data.nama_barang;
            const id = data.id_barang;
            const price = Number(data.harga_barang);
            const qtymax = data.stok;

            shoppingCart.addItemToCart(name, price,id, 1,qtymax);
            displayCart();
            checkscroll();
            inputbarcode.value = '';
            NioApp.Toast('Barang Berhasil Ditambahkan Kedalam Cart', 'success', {
               position: 'top-right'
           });
        }else{
           toastr.clear();
           NioApp.Toast('Barang Tidak Tersedia Atau Barcode Tidak Tersedia', 'error', {
               position: 'top-right'
           });
       }
   },
   error: function(error) {
   }
});
 }
 document.getElementById('uang_dibayar').addEventListener('input',function(){
    const totaluang = shoppingCart.totalCart();
    const text = document.getElementById('alert-text');
    const displaykembalian = document.getElementById('display-kembalian');
    const kembalian = document.getElementById("kembalian");
    const kembaliandisabled = document.getElementById("kembalian_disabled");
    let hitung = totaluang - parseInt(this.value);
    const format = hitung.toLocaleString('id-ID', {style: 'currency',currency: 'IDR',}).replace(/,00/g, "");
    if(hitung == 0){
                //uang pas
        text.innerHTML = 'Jumlah Uang Yang Dibayarkan Pas';
        text.classList.remove('text-danger');
        text.classList.add('text-success');
    }else if(hitung < 0){
                //kembalian
     text.classList.remove('text-danger');
     text.classList.add('text-success');
     text.innerHTML = ' Mendapat Kembalian '+ format.replace(/-/g, "");
     displaykembalian.style.display = 'block';
     kembalian.value = hitung.toString().replace(/-/g, "");
     kembaliandisabled.value = hitung.toString().replace(/-/g, "");
 } else if (!isNaN(hitung)) {
    text.innerHTML = "Jumlah Uang Yang Dibayarkan Kurang: " + format;
    text.classList.remove('text-success');
    text.classList.add('text-danger');
    kembalian.value = '';
    kembaliandisabled.value = '';
    displaykembalian.style.display = 'none';
} else {
    text.innerHTML = '';
    kembalian.value = '';
    kembaliandisabled.value = '';
    displaykembalian.style.display = 'none';
}
});
 function checkscroll(){
    const cart = document.querySelector('.overflow-y-scroll-transaksi');
    const btn = document.getElementById('show-btn');
    const showcount = document.getElementById('show-count');
    const data = JSON.parse(sessionStorage.getItem("shoppingCart"));
    if(sessionStorage.getItem('shoppingCart') != null){
     if(data.length >= 1){
      cart.style.overflowY = 'scroll';
      btn.style.display = 'block';
      showcount.style.display = 'block';
      cart.style.maxHeight = 'calc(100vh - 200px)';
  }else{
      cart.style.overflowY = 'hidden';
      btn.style.display = 'none';
      showcount.style.display = 'none';
      cart.style.height = 'auto';
  }
}else{
    cart.style.overflowY = 'hidden';
    btn.style.display = 'none';
    showcount.style.display = 'none';
    cart.style.height = 'auto';
}
}
checkscroll();

var shoppingCart = (function() {

  cart = [];

      // Constructor
  function Item(name, price, id,count,qtymax) {
    this.name = name;
    this.price = price;
    this.count = count;
    this.id = id;
    this.qtymax = qtymax;
}

      // Save cart
function saveCart() {
    sessionStorage.setItem('shoppingCart', JSON.stringify(cart));
}

        // Load cart
function loadCart() {
    cart = JSON.parse(sessionStorage.getItem('shoppingCart'));
}
if (sessionStorage.getItem("shoppingCart") != null) {
    loadCart();
}


      // =============================
      // Public methods and propeties
      // =============================
var obj = {};

      // Add to cart
obj.addItemToCart = function(name, price, id,count,qtymax) {
    const check = sessionStorage.getItem('shoppingCart');
    for(var item in cart) {
      if(cart[item].name === name) {
        if (cart[item].count == qtymax) {
           toastr.clear();
           NioApp.Toast('Barang Di Input Melebihi Stok Tersedia', 'error', {
               position: 'top-right'
           });
           return;
       } else {
        cart[item].count++;
        saveCart();
        return;
    }

}
}
var item = new Item(name, price,id, count,qtymax);
cart.push(item);
saveCart();
}
      // Set count from item
obj.setCountForItem = function(name, count) {
    for(var i in cart) {
      if (cart[i].name === name) {
        cart[i].count = count;
        break;
    }
}
};
      // Remove item from cart
obj.removeItemFromCart = function(name) {
  for(var item in cart) {
    if(cart[item].name === name) {
      cart[item].count --;
      if(cart[item].count === 0) {
        cart.splice(item, 1);
    }
    break;
}
}
saveCart();
}

      // Remove all items from cart
obj.removeItemFromCartAll = function(name) {
    for(var item in cart) {
      if(cart[item].name === name) {
        cart.splice(item, 1);
        break;
    }
}
saveCart();
}

      // Clear cart
obj.clearCart = function() {
    cart = [];
    saveCart();
}

      // Count cart 
obj.totalCount = function() {
    var totalCount = 0;
    for(var item in cart) {
      totalCount += cart[item].count;
  }
  return totalCount;
}

      // Total cart
obj.totalCart = function() {
    var totalCart = 0;
    for(var item in cart) {
      totalCart += cart[item].price * cart[item].count;
  }
//   const formattedNumber = totalCart.toLocaleString('id-ID', {
//   style: 'currency',
//   currency: 'IDR',
// }).replace(/,00/g, "");
  return totalCart;
}

      // List cart
obj.listCart = function() {
    var cartCopy = [];
    for(i in cart) {
      item = cart[i];
      itemCopy = {};
      for(p in item) {
        itemCopy[p] = item[p];

    }
    itemCopy.total = Number(item.price * item.count).toFixed(2);
    cartCopy.push(itemCopy)
}
return cartCopy;
}

      // cart : Array
      // Item : Object/Class
      // addItemToCart : Function
      // removeItemFromCart : Function
      // removeItemFromCartAll : Function
      // clearCart : Function
      // countCart : Function
      // totalCart : Function
      // listCart : Function
      // saveCart : Function
      // loadCart : Function
return obj;
})();

function rupiahformat(num){
    var formattedNumber = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(num);
    formattedNumber = formattedNumber.replace(/\,00$/, '');
    return formattedNumber;
}

function displayCart() {
  var cartArray = shoppingCart.listCart();
  var output = "";
  for(var i in cartArray) {
    output += '<div class="col-12 col-lg-12 mt-3">' +
    '<p class="fs-16px">'+ (parseInt(i)+ 1)+ '.' + cartArray[i].name +'</p>'+
    '</div><div class="col-12 col-lg-5 mt-3 pt-0">'+
    '<p class="fs-16px">'+rupiahformat(cartArray[i].total)+'</p>'+
    '</div><div class="col-12 col-lg-7"><div class="form-group mt-3"><div class="form-control-wrap number-spinner-wrap">'+            
    "<button class='minus-item btn btn-icon btn-primary number-spinner-btn number-minus' data-nama='"+ cartArray[i].name + "'><em class='icon ni ni-minus'></em></button>"+
    '<input type="number" max="1" min="1" class="form-control border-primary number-spinner" disabled value="'+cartArray[i].count  + '">' +
    "<button class='plus-item btn btn-icon btn-primary number-spinner-btn number-plus' data-nama='"+cartArray[i].name+"'><em class='icon ni ni-plus'></em></button>" +
    '</div></div></div>';

}
$('#show-cart').html(output);
$('.total-cart').html('Total Harga:'+ shoppingCart.totalCart().toLocaleString('id-ID', {style: 'currency',currency: 'IDR',}).replace(/,00/g, ""));
$('.total-count').html('Jumlah Barang: ' + shoppingCart.totalCount() + ' pcs');
$('#total-harga').val(shoppingCart.totalCart());
document.getElementById('datastorageweb').value = sessionStorage.getItem('shoppingCart');
// console.log();
}

    // *****************************************
    // Triggers / Events
    // ***************************************** 
    // Add item
$('.imgbarang').click(function(event) {
  event.preventDefault();
  const checkqty = sessionStorage.getItem('shoppingCart');
  var name = $(this).data('nama').replace("'"," ");
  var price = Number($(this).data('harga'));
  var id = $(this).data('id');
  var qtymax = $(this).data('stok');
  shoppingCart.addItemToCart(name, price,id, 1,qtymax);
  displayCart();
  checkscroll();
});

    // Clear items
$('.clear-cart').click(function() {
  shoppingCart.clearCart();
  displayCart();
  checkscroll();
});

    // Delete item button

$('#show-cart').on("click", ".delete-item", function(event) {
  var name = $(this).data('nama')
  shoppingCart.removeItemFromCartAll(name);
  displayCart();
})


    // -1
$('#show-cart').on("click", ".minus-item", function(event) {
  var name = $(this).data('nama')
  shoppingCart.removeItemFromCart(name);
  displayCart();
  checkscroll();
})
    // +1
$('#show-cart').on("click", ".plus-item", function(event) {
  var name = $(this).data('nama')
  shoppingCart.addItemToCart(name);
  displayCart();
})

    // Item count input
$('#show-cart').on("change", ".item-count", function(event) {
   var name = $(this).data('nama');
   var count = Number($(this).val());
   shoppingCart.setCountForItem(name, count);
   displayCart();
});

displayCart();
</script>
@endsection
