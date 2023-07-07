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
                                    <li class="nk-block-tools-opt">
                                    <a href="{{ route('UserData.create') }}" data-target="addProduct"
                                    class="toggle btn btn-icon btn-primary d-md-none"><em
                                    class="icon ni ni-plus"></em></a>
                                    <a href="{{ route('UserData.create') }}"
                                    class="btn btn-primary d-none d-md-inline-flex"><em
                                    class="icon ni ni-plus"></em><span>Tambah Pengguna</span></a>
                                   </li>
                                </ul>
                            </div>
                        </div><!-- .toggle-wrap -->
                    </div><!-- .nk-block-head-content -->
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->
           
            <div class="nk-block nk-block-lg">
                <div class="card card-bordered card-preview">
                    <div class="card-inner">
                        <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                            <thead>
                                <tr class="nk-tb-item nk-tb-head">
                                    <th class="nk-tb-col "><span class="sub-text">No</span></th>
                                    <th class="nk-tb-col"><span class="sub-text">Nama Pengguna</span></th>
                                    <th class="nk-tb-col tb-col-mb"><span class="sub-text">Email</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Status Login</span></th>
                                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">Status Akun</span></th>
                                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">Role</span></th>
                                    <th class="nk-tb-col nk-tb-col-tools text-end">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datauser as $data)
                                <tr class="nk-tb-item">
                                    <td class="nk-tb-col"><span>{{ $loop->iteration }}</span></td>
                                    <td class="nk-tb-col">
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
                                    </td>
                                    <td class="nk-tb-col tb-col-mb" data-order="35040.34">
                                         <span class="tb-amount">{{ $data->email }}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        @if ($data->status == 'online')
                                         <span class="tb-status text-success">Online</span>
                                        @else
                                         <span class="tb-status text-danger">Offline</span>
                                        @endif
                                    </td>
                                    <td class="nk-tb-col tb-col-lg" data-order="Email Verified - Kyc Unverified">
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
                                    </td>
                                    <td class="nk-tb-col tb-col-lg">
                                        @if ($data->level == 'admin')
                                         <span class="badge rounded-pill bg-success badge-md">Admin</span>
                                        @elseif($data->level == 'kasir')
                                         <span class="badge rounded-pill bg-info badge-md">Kasir</span>
                                        @else    
                                         <span class="badge rounded-pill bg-primary badge-md">Owner</span>
                                        @endif
                                    </td>
                                    <td class="nk-tb-col nk-tb-col-tools">
                                        <ul class="nk-tb-actions gx-1">
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
                                    </td>
                                </tr><!-- .nk-tb-item  -->
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!-- .card-preview -->
            </div> <!-- nk-block -->
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

@endsection
