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
                        <div class="card-inner">
                            <table class="datatable-init table ">
                                <thead class="table-light">
                                    <tr>
                                        <th class="tb-col-os"><span class="overline-title">No</span></th>
                                        <th class="tb-col-os"><span class="overline-title">Nama Pengguna</span></th>
                                        <th class="tb-col-os tb-col-mb"><span class="overline-title">Browser</span></th>
                                        <th class="tb-col-ip tb-col-mb"><span class="overline-title">IP</span></th>
                                        <th class="tb-col-time tb-col-mb"><span class="overline-title">Tanggal Dan Jam Login</span></th>
                                        <th class="tb-col-time tb-col-mb"><span class="overline-title">Tanggal Dan Jam Logout</span></th>
                                        <th class="tb-col-time"><span class="overline-title">Total Jam Login Harian</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($datauser as $data)
                                    @if($data->time_logout_at && $data->date_logout_at)
                                    @php
                                    $start = \Carbon\Carbon::createFromTimeString($data->time_login_at);
                                    $end = \Carbon\Carbon::createFromTimeString($data->time_logout_at);
                                    $diff = $end->diff($start);
                                    $hours = $diff->h;
                                    $minutes = $diff->i;
                                    $seconds = $diff->s;
                                    $timeString = '';
                                    if ($hours > 0) {
                                        $timeString .= $hours . " jam ";
                                    }
                                    if ($minutes > 0) {
                                        $timeString .= $minutes . " menit ";
                                    }
                                    if ($seconds > 0) {
                                        $timeString .= $seconds . " detik";
                                    }
                                    @endphp
                                    @endif
                                    <tr>
                                        <td class="tb-col-os">{{ $loop->iteration }}</td>
                                        <td class="tb-col-os">{{ $data->users->nama_pengguna }}</td>
                                        <td class="tb-col-os tb-col-mb">{{ $data->user_agent }}</td>
                                        <td class="tb-col-ip tb-col-mb"><span class="sub-text">{{ $data->ip_address  }}</span></td>
                                        <td class="tb-col-time tb-col-mb"><span class="sub-text">{{ $data->date_login_at }}   {{ $data->time_login_at }}</span></td>
                                        <td class="tb-col-time tb-col-mb"><span class="sub-text">{{ $data->date_logout_at }}  {{ $data->time_logout_at }}</span></td>
                                        <td class="tb-col-time "><span class="title text-success">{{ ($data->time_logout_at && $data->date_logout_at)?$timeString:'-' }}</span></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div><!-- .card-inner -->
                    </div><!-- .card-inner-group -->
                </div><!-- .card -->
            </div><!-- .nk-block -->
        </div>
    </div>
    @endsection
