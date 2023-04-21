@extends('admin.layout.main')
@section('title', 'Data Pengguna')
@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Users Lists</h3>
                        <div class="nk-block-des text-soft">
                            <p>You have total {{ count($datauser) }} users.</p>
                        </div>
                    </div><!-- .nk-block-head-content -->
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em
                                    class="icon ni ni-menu-alt-r"></em></a>
                            <div class="toggle-expand-content" data-content="pageMenu">
                                <ul class="nk-block-tools g-3">
                                   
                                </ul>
                            </div>
                        </div><!-- .toggle-wrap -->
                    </div><!-- .nk-block-head-content -->
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->
            <div class="nk-block">
                <div class="card card-stretch">
                    <div class="card-inner-group">
                        <div class="card-inner position-relative card-tools-toggle">
                            <div class="card-title-group">
                                <div class="card-tools">
                                    <div class="form-inline flex-nowrap gx-3">
                                        <div class="form-wrap w-150px">
                                            <select class="form-select js-select2" data-search="off"
                                                data-placeholder="Bulk Action">
                                                <option value="">Bulk Action</option>
                                                <option value="email">Send Email</option>
                                                <option value="group">Change Group</option>
                                                <option value="suspend">Suspend User</option>
                                                <option value="delete">Delete User</option>
                                            </select>
                                        </div>
                                        <div class="btn-wrap">
                                            <span class="d-none d-md-block"><button
                                                    class="btn btn-dim btn-outline-light disabled">Apply</button></span>
                                            <span class="d-md-none"><button
                                                    class="btn btn-dim btn-outline-light btn-icon disabled"><em
                                                        class="icon ni ni-arrow-right"></em></button></span>
                                        </div>
                                    </div><!-- .form-inline -->
                                </div><!-- .card-tools -->
                                <div class="card-tools me-n1">
                                    <ul class="btn-toolbar gx-1">
                                        <li>
                                            <a href="#" class="btn btn-icon search-toggle toggle-search"
                                                data-target="search"><em class="icon ni ni-search"></em></a>
                                        </li><!-- li -->
                                        <li class="btn-toolbar-sep"></li><!-- li -->
                                        <li>
                                            <div class="toggle-wrap">
                                                <a href="#" class="btn btn-icon btn-trigger toggle"
                                                    data-target="cardTools"><em class="icon ni ni-menu-right"></em></a>
                                                <div class="toggle-content" data-content="cardTools">
                                                    <ul class="btn-toolbar gx-1">
                                                        <li class="toggle-close">
                                                            <a href="#" class="btn btn-icon btn-trigger toggle"
                                                                data-target="cardTools"><em
                                                                    class="icon ni ni-arrow-left"></em></a>
                                                        </li><!-- li -->
                                                        <li>
                                                            <div class="dropdown">
                                                                <a href="#"
                                                                    class="btn btn-trigger btn-icon dropdown-toggle"
                                                                    data-bs-toggle="dropdown">
                                                                    <div class="dot dot-primary"></div>
                                                                    <em class="icon ni ni-filter-alt"></em>
                                                                </a>
                                                                <div
                                                                    class="filter-wg dropdown-menu dropdown-menu-xl dropdown-menu-end">
                                                                    <div class="dropdown-head">
                                                                        <span class="sub-title dropdown-title">Filter
                                                                            Users</span>
                                                                        <div class="dropdown">
                                                                            <a href="#" class="btn btn-sm btn-icon">
                                                                                <em class="icon ni ni-more-h"></em>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="dropdown-body dropdown-body-rg">
                                                                        <div class="row gx-6 gy-3">
                                                                            <div class="col-6">
                                                                                <div
                                                                                    class="custom-control custom-control-sm custom-checkbox">
                                                                                    <input type="checkbox"
                                                                                        class="custom-control-input"
                                                                                        id="hasBalance">
                                                                                    <label class="custom-control-label"
                                                                                        for="hasBalance"> Have
                                                                                        Balance</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-6">
                                                                                <div
                                                                                    class="custom-control custom-control-sm custom-checkbox">
                                                                                    <input type="checkbox"
                                                                                        class="custom-control-input"
                                                                                        id="hasKYC">
                                                                                    <label class="custom-control-label"
                                                                                        for="hasKYC"> KYC
                                                                                        Verified</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-6">
                                                                                <div class="form-group">
                                                                                    <label
                                                                                        class="overline-title overline-title-alt">Role</label>
                                                                                    <select class="form-select js-select2">
                                                                                        <option value="any">Any Role
                                                                                        </option>
                                                                                        <option value="investor">Investor
                                                                                        </option>
                                                                                        <option value="seller">Seller
                                                                                        </option>
                                                                                        <option value="buyer">Buyer
                                                                                        </option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-6">
                                                                                <div class="form-group">
                                                                                    <label
                                                                                        class="overline-title overline-title-alt">Status</label>
                                                                                    <select class="form-select js-select2">
                                                                                        <option value="any">Any Status
                                                                                        </option>
                                                                                        <option value="active">Active
                                                                                        </option>
                                                                                        <option value="pending">Pending
                                                                                        </option>
                                                                                        <option value="suspend">Suspend
                                                                                        </option>
                                                                                        <option value="deleted">Deleted
                                                                                        </option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <div class="form-group">
                                                                                    <button type="button"
                                                                                        class="btn btn-secondary">Filter</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="dropdown-foot between">
                                                                        <a class="clickable" href="#">Reset
                                                                            Filter</a>
                                                                        <a href="#">Save Filter</a>
                                                                    </div>
                                                                </div><!-- .filter-wg -->
                                                            </div><!-- .dropdown -->
                                                        </li><!-- li -->
                                                        <li>
                                                            <div class="dropdown">
                                                                <a href="#"
                                                                    class="btn btn-trigger btn-icon dropdown-toggle"
                                                                    data-bs-toggle="dropdown">
                                                                    <em class="icon ni ni-setting"></em>
                                                                </a>
                                                                <div
                                                                    class="dropdown-menu dropdown-menu-xs dropdown-menu-end">
                                                                    <ul class="link-check">
                                                                        <li><span>Show</span></li>
                                                                        <li class="active"><a href="#">10</a></li>
                                                                        <li><a href="#">20</a></li>
                                                                        <li><a href="#">50</a></li>
                                                                    </ul>
                                                                    <ul class="link-check">
                                                                        <li><span>Order</span></li>
                                                                        <li class="active"><a href="#">DESC</a></li>
                                                                        <li><a href="#">ASC</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div><!-- .dropdown -->
                                                        </li><!-- li -->
                                                    </ul><!-- .btn-toolbar -->
                                                </div><!-- .toggle-content -->
                                            </div><!-- .toggle-wrap -->
                                        </li><!-- li -->
                                    </ul><!-- .btn-toolbar -->
                                </div><!-- .card-tools -->
                            </div><!-- .card-title-group -->
                            <div class="card-search search-wrap" data-search="search">
                                <div class="card-body">
                                    <div class="search-content">
                                        <form action="#" method="post">
                                            @csrf
                                            <a href="#" class="search-back btn btn-icon toggle-search"
                                                data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                                            <input type="text" class="form-control border-transparent form-focus-none"
                                                placeholder="Search by user or email">
                                            <button class="search-submit btn btn-icon"><em
                                                    class="icon ni ni-search"></em></button>
                                        </form>

                                    </div>
                                </div>
                            </div><!-- .card-search -->
                        </div><!-- .card-inner -->
                        <div class="card-inner p-0">
                            <div class="nk-tb-list nk-tb-ulist">
                                <div class="nk-tb-item nk-tb-head">
                                    <div class="nk-tb-col ">
                                        <span class="sub-text">No</span>
                                    </div>
                                    <div class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Nama Pengguna</span></div>
                                    <div class="nk-tb-col tb-col-mb"><span class="sub-text">Email</span></div>
                                    <div class="nk-tb-col tb-col-lg"><span class="sub-text">Status Login</span></div>
                                    <div class="nk-tb-col tb-col-lg"><span class="sub-text">Status Akun</span></div>
                                    <div class="nk-tb-col tb-col-md"><span class="sub-text">Role</span></div>
                                    <div class="nk-tb-col nk-tb-col-tools text-end">
                                        <div class="dropdown">
                                            <a href="#"
                                                class="btn btn-xs btn-outline-light btn-icon dropdown-toggle"
                                                data-bs-toggle="dropdown" data-offset="0,5"><em
                                                    class="icon ni ni-plus"></em></a>
                                            <div class="dropdown-menu dropdown-menu-xs dropdown-menu-end">
                                                <ul class="link-tidy sm no-bdr">
                                                    <li>
                                                        <div class="custom-control custom-control-sm custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input"
                                                                checked="" id="bl">
                                                            <label class="custom-control-label"
                                                                for="bl">Balance</label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="custom-control custom-control-sm custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input"
                                                                checked="" id="ph">
                                                            <label class="custom-control-label"
                                                                for="ph">Phone</label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="custom-control custom-control-sm custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input"
                                                                id="vri">
                                                            <label class="custom-control-label"
                                                                for="vri">Verified</label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="custom-control custom-control-sm custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input"
                                                                id="st">
                                                            <label class="custom-control-label"
                                                                for="st">Status</label>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- .nk-tb-item -->
                                @foreach ($datauser as $data)
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col ">
                                       <span class="sub-text">{{ $loop->iteration }}</span>
                                    </div>
                                    <div class="nk-tb-col">
                                        <a href="#">
                                            @php
                                            $class = array('bg-primary','bg-danger','bg-info','bg-success','bg-warning')    
                                            @endphp
                                            <div class="user-card">
                                                <div class="user-avatar {{ $class[array_rand($class)]; }}">
                                                    <span>{{ strtoupper(substr(Auth::user()->nama_pengguna, 0, 3)) }}</span>
                                                </div>
                                                <div class="user-info">
                                                    <span class="tb-lead">
                                                        @if($data->nama_pengguna == null)
                                                       Tidak Ada Nama
                                                        @else
                                                       {{ $data->nama_pengguna }}
                                                        @endif
                                                        <span class="dot dot-success d-md-none ms-1"></span></span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="nk-tb-col tb-col-mb">
                                        <span class="tb-amount">{{ $data->email }}</span>
                                    </div>
                                    <div class="nk-tb-col tb-col-lg">
                                        @if ($data->status == 'online')
                                        <span class="tb-status text-success">Online</span>
                                    @else
                                    <span class="tb-status text-danger">Offline</span>
                                    @endif</span>
                                      
                                    </div>
                                    <div class="nk-tb-col tb-col-lg">
                                          <ul class="list-status">
                                            <li>
                                                  @if ($data->status_akun == 'aktif')
                                                  <em class="icon text-success ni ni-check-circle"></em> <span class="text-success">Aktif</span>
                                                  @elseif($data->status_akun == 'diblokir')
                                                  <em class="icon text-danger ni ni-na"></em> <span class="text-danger">Diblokir</span>
                                                  @else    
                                                  <em class="icon text-warning ni ni-alert-circle"></em> <span class="text-warning">Pending</span>
                                                  @endif
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="nk-tb-col tb-col-md">
                                        @if ($data->level == 'admin')
                                                    <span class="badge rounded-pill bg-success badge-md">Admin</span>
                                                @elseif($data->level == 'kasir')
                                                    <span class="badge rounded-pill bg-info badge-md">Kasir</span>
                                                @else    
                                                    <span class="badge rounded-pill bg-primary badge-md">Owner</span>
                                                @endif
                                    </div>
                                    <div class="nk-tb-col nk-tb-col-tools">
                                        <ul class="nk-tb-actions gx-1">
                                            <li class="nk-tb-action-hidden">
                                                <a href="#" class="btn btn-trigger btn-icon"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Suspend">
                                                    <em class="icon ni ni-na"></em>
                                                </a>
                                            </li>
                                            <li>
                                                <div class="drodown">
                                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger"
                                                        data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li><a href="{{ route('UserData.edit', $data->id_user) }}"><em
                                                                        class="icon ni ni-edit"></em><span>Edit User</span></a></li>
                                                            <li><a type="button" class="btn-delete"
                                                                data-id="{{ $data->id_user }}"><em
                                                                        class="icon ni ni-trash"></em><span>Delete user</span></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div><!-- .nk-tb-item -->
                                @endforeach
                            </div><!-- .nk-tb-list -->
                        </div><!-- .card-inner -->
                        <div class="card-inner">
                            <div class="nk-block-between-md g-3">
                                <div class="g">
                                    <ul class="pagination justify-content-center justify-content-md-start">
                                        {{ $datauser->links() }}
                                    </ul><!-- .pagination -->
                                </div>
                                <div class="g">
                                    @php
                                    $total = DB::table('users')->count();
                                @endphp
                                <div>Total <strong>{{ $total }}</strong></div>
                                </div><!-- .pagination-goto -->
                            </div><!-- .nk-block-between -->
                        </div><!-- .card-inner -->
                    </div><!-- .card-inner-group -->
                </div><!-- .card -->
            </div><!-- .nk-block -->
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).on('click', '.btn-delete', function() {
            var id = $(this).data('id');
            console.log(id);
            $('#form-edit').attr('action', '/UserData/delete/' + id);
            $('#form-edit').append('<input type="hidden" name="_method" value="DELETE">');
            $('#delete').modal('show');
        });
    </script>
    {{-- <script>
                    const select = document.getElementById("filter-select");
                    const form = document.getElementById("filter");

                    select.addEventListener("change", function() {
                        form.filter.value = select.value;
                        form.submit(); 
                    });
                </script> --}}
    {{-- <script>
                    const select_category = document.getElementById("filter-select-kategory");
                    const form_category = document.getElementById("filter-kategory");
                    select_category.addEventListener("change", function() {
    form_category.filter.value = select_category.value; // set value input filter
    form_category.submit(); 
});
</script> --}}
@endsection
