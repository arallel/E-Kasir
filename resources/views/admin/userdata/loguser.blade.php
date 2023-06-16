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
                            <table class="datatable-init table table-ulogs">
                                <thead class="table-light">
                                    <tr>
                                        <th class="tb-col-os"><span class="overline-title">No</span></th>
                                        <th class="tb-col-os"><span class="overline-title">Browser</span></th>
                                        <th class="tb-col-ip"><span class="overline-title">IP</span></th>
                                        <th class="tb-col-time"><span class="overline-title">Time</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($datauser as $data)
                                    <tr>
                                        <td class="tb-col-os">{{ $loop->iteration }}</td>
                                        <td class="tb-col-os">{{ $data->user_agent }}</td>
                                        <td class="tb-col-ip"><span class="sub-text">{{ $data->ip_address }}</span></td>
                                        <td class="tb-col-time"><span class="sub-text">{{ $data->login_at }}</span></td>
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
