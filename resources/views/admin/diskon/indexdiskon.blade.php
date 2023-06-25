@extends('admin.layout.main')
@section('content')
<div class="nk-content-inner">
	<div class="nk-content-body">
		<div class="nk-block-head nk-block-head-sm">
			<div class="nk-block-between">
				<div class="nk-block-head-content">
					<h3 class="nk-block-title page-title">Data Diskon</h3>
				</div><!-- .nk-block-head-content -->
				<div class="nk-block-head-content">
					<div class="toggle-wrap nk-block-tools-toggle">
						<a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em
							class="icon ni ni-more-v"></em></a>
							<div class="toggle-expand-content" data-content="pageMenu">
								<ul class="nk-block-tools g-3">
									{{-- <li>
										<div class="form-control-wrap">
											<div class="form-icon form-icon-right">
												<em class="icon ni ni-search"></em>
											</div>
											<form action="{{ route('search.kategory') }}" method="post">
												@csrf
												<input type="text" class="form-control" name="search" id="default-04"
												placeholder="Cari Kategory">
											</form>
										</div>
									</li> --}}
									<li class="nk-block-tools-opt">
										{{-- <a href="{{ route('diskon.create') }}" data-target="addProduct"
										class="toggle btn btn-icon btn-primary d-md-none"><em
										class="icon ni ni-plus"></em></a> --}}
										<a href="{{ route('diskon.create') }}" 
										class=" btn btn-primary d-none d-md-inline-flex"><em
										class="icon ni ni-plus"></em><span>Tambah Diskon</span></a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="nk-block">
				<div class="card">
					<div class="card-inner-group">
						<div class="card-inner ">
							<table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
								<thead>
									<tr class="nk-tb-item nk-tb-head">
										<th class="nk-tb-col ">
											No
										</th>
										<th class="nk-tb-col"><span class="sub-text">Kode Promo</span></th>
										<th class="nk-tb-col tb-col-mb"><span class="sub-text">Jumlah Diskon</span></th>
										<th class="nk-tb-col tb-col-md"><span class="sub-text">Tgl Mulai Promo</span></th>
										<th class="nk-tb-col tb-col-lg"><span class="sub-text">Tgl Selesai Promo</span></th>
										<th class="nk-tb-col tb-col-md"><span class="sub-text">Status potongan</span></th>
										<th class="nk-tb-col nk-tb-col-tools text-end">
										</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($data as $diskon)
									<tr class="nk-tb-item">
										<td class="nk-tb-col ">
											<span>{{ $loop->iteration }}</span>
										</td>
										<td class="nk-tb-col">
											<span class="title text-center">{{ $diskon->kode_promo }}</span>
										</td>
										<td class="nk-tb-col" >
											<span class="title text-center">{{ $diskon->persen_diskon }}%</span>
										</td>
										<td class="nk-tb-col tb-col-md">
											
											<span class="tb-sub">{{ \Carbon\Carbon::parse($diskon->tgl_mulai_promo)->isoFormat('D MMMM Y') }}</span>
										</td>
										<td class="nk-tb-col tb-col-lg">
											<span class="tb-sub">{{ \Carbon\Carbon::parse($diskon->tgl_selesai_promo)->isoFormat('D MMMM Y') }}</span>
										</td>
										<td class="nk-tb-col tb-col-md">
											@if ($diskon->status_diskon == 'aktif')
											<span class="badge rounded-pill bg-success badge-md">Aktif</span>
											@else
											<span class="badge rounded-pill bg-secondary badge-md">Tidak
											Aktif</span>
											@endif
										</td>
										<td class="nk-tb-col nk-tb-col-tools">
											<ul class="nk-tb-actions gx-1">
												<li>
													<div class="drodown">
														<a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
														<div class="dropdown-menu dropdown-menu-end">
															<ul class="link-list-opt no-bdr">
																<li><a href="{{ route('diskon.edit', $diskon->id_diskon) }}"><em class="icon ni ni-edit"></em><span>Edit diskon</span></a></li>
																{{-- <li><a href="{{ route('diskon.show', $diskon->id_diskon) }}"><em class="icon ni ni-eye"></em><span>Tampilkan</span></a></li> --}}
																<li><a type="button" class="btn-delete" data-id="{{ $diskon->id_diskon }}"><em class="icon ni ni-trash btn-delete"></em><span>Hapus Diskon</span></a>
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
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
		$(document).on('click', '.btn-delete', function() {
			var id = $(this).data('id');
			$('#form-edit').attr('action', '/diskon/delete/' + id);
			$('#form-edit').append('<input type="hidden" name="_method" value="DELETE">');
			$('#delete').modal('show');
		});
	</script>
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
	@endsection