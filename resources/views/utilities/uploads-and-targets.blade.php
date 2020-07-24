@extends('layouts.app')

@section('extra-lib-css')
<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
<!-- END: Page CSS-->
@endsection
@section('extra-lib-js')
{{-- BEGIN: Page Vendor JS --}}
<script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>

@endsection
@section('extra-script')
{{-- Treeview --}}
<script type="text/javascript">
	$('#kolomEnterprise').hide();
	$('#kolomConsumer').show();
	// Change
	$("#select_survey").change(function() {
		$('#kolomEnterprise').hide();
		$('#kolomConsumer').hide();
		$('#kolom'+$(this).val()).show();
	});

	$('#kolomConsumer').on('submit', function(e){
		e.preventDefault();
		var btnSubmit = $(':submit', this);
		btnSubmit.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
		var list_input = $('#kolomConsumer input');
		for (var i = list_input.length - 1; i >= 0; i--) {
			$("<input />").attr("type", "hidden")
			.attr("name", list_input[i]['name'])
			.attr("value", list_input[i]['value'])
			.appendTo("#form-file");
		}
		$('#form-file').trigger('submit');
	});
	$('#kolomEnterprise').on('submit', function(e){
		e.preventDefault();
		var btnSubmit = $(':submit', this);
		btnSubmit.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
		var list_input = $('#kolomConsumer input');
		for (var i = list_input.length - 1; i >= 0; i--) {
			$("<input />").attr("type", "hidden")
			.attr("name", list_input[i]['name'])
			.attr("value", list_input[i]['value'])
			.appendTo("#form-file");
		}
		$('#form-file').trigger('submit');
	});
	/*$('#form-file').on('submit', function(e){
		e.preventDefault();
		var dataForm = $( this ).serializeArray();
		console.log(dataForm)
	});*/
</script>
@endsection

@section('content')

<div class="content-overlay"></div>
<div class="content-wrapper">
	<div class="content-header row">
	</div>
	<div class="content-body">
		<div class="row">
        	<div class="col-9">
    			<div class="card">
    				<div class="card-header">
    					<h4 class="card-title">Target</h4>
    					<div class="heading-elements">
    						<ul class="list-inline mb-0">
    							<li><a data-action="#"><i class="feather icon-refresh-cw"></i></a></li>
    							<li><a data-action="#"><i class="feather icon-plus-square"></i></a></li>
    						</ul>
    					</div>
    				</div>
    				<div class="card-content">
    					<div class="card-body card-dashboard">
    						<table class="table table-striped table-bordered" id="target-survey">
    							<thead>
    								<tr>
    									<th>Tanggal</th>
    									<th>Nama Agent</th>
    									<th>Target</th>
    									<th>Realisasi</th>
    									<th>Tools</th>
    								</tr>
    							</thead>
    							<tbody>
    								
    							</tbody>
    						</table>
    					</div>
    				</div>
    			</div>
    		</div>
    		<div class="col-3">
    			<div class="card">
    				<div class="card-header">
    					<h4 class="card-title">Upload File</h4>
    				</div>
    				<div class="card-content">
    					<div class="card-body card-dashboard">
    						<form id="form-file" action="{{ route('utilities.upload-data') }}" method="post" enctype="multipart/form-data">
    							@csrf
	    						<div class="row">
	    							<div class="col-md-12">
	    								<div class="form-group">
	    									<label for="select_survey">Jenis Survey</label>
	    									<select class="form-control" id="select_survey" name="survey">
	    										<option value="Consumer">Consumer</option>
	    										<option value="Enterprise">Enterprise</option>
	    									</select>
	    								</div>
	    								<div class="form-group">
	    									<div class="custom-file">
	    										<input type="file" class="custom-file-input" id="inputFile" name="file" required>
	    										<label class="custom-file-label" for="inputFile">Pilih File</label>
	    									</div>
	    								</div>
	    							</div>
	    						</div>
    						</form>

    						<div class="row">
    							<div class="col-md-12">
    								<label>Isi nomor kolom berikut</label>
    							</div>
    						</div>
    						<form class="form" id="kolomConsumer">
	    						<div class="row form-body" >
	    							<div class="col-md-4">
	    								<div class="form-group">
	    									<input type="text" class="form-control" placeholder="NPSID" name="kolom_npsid" required>
	    								</div>
	    							</div>
	    							<div class="col-md-4">
	    								<div class="form-group">
	    									<input type="text" class="form-control" placeholder="Nama" name="kolom_nama_pelanggan" required>
	    								</div>
	    							</div>
	    							<div class="col-md-4">
	    								<div class="form-group">
	    									<input type="text" class="form-control" placeholder="No HP" name="kolom_no_hp" required>
	    								</div>
	    							</div>
	    							<div class="col-md-3">
	    								<div class="form-group">
	    									<input type="text" class="form-control" placeholder="ND" name="kolom_nd" required>
	    								</div>
	    							</div>
	    							<div class="col-md-5">
	    								<div class="form-group">
	    									<input type="text" class="form-control" placeholder="ND Reference" name="kolom_nd_reference" required>
	    								</div>
	    							</div>
	    							<div class="col-md-4">
	    								<div class="form-group">
	    									<input type="text" class="form-control" placeholder="Episode" name="kolom_episode" required>
	    								</div>
	    							</div>
	    							<div class="col-md-4">
	    								<div class="form-group">
	    									<input type="text" class="form-control" placeholder="TREG" name="kolom_treg" required>
	    								</div>
	    							</div>
	    							<div class="col-md-4">
	    								<div class="form-group">
	    									<input type="text" class="form-control" placeholder="Witel" name="kolom_witel" required>
	    								</div>
	    							</div>
	    							<div class="col-md-4">
	    								<div class="form-group">
	    									<input type="text" class="form-control" placeholder="Produk" name="kolom_produk" required>
	    								</div>
	    							</div>
	    							<div class="col-md-4">
	    								<div class="form-group">
	    									<input type="text" class="form-control" placeholder="NCLI" name="kolom_ncli" required>
	    								</div>
	    							</div>
	    							<div class="col-md-8">
	    								<div class="form-group">
	    									<input type="text" class="form-control" placeholder="Alamat" name="kolom_alamat" required>
	    								</div>
	    							</div>    							
	    						</div>
	    						<div class="form-actions right">
	    							<button type="reset" class="btn btn-warning mr-1">
	    								<i class="feather icon-x"></i> Ulangi
	    							</button>
	    							<button type="submit" class="btn btn-primary">
	    								<i class="fa fa-check-square-o"></i> Upload
	    							</button>
	    						</div>
    						</form>
    						<form class="form" id="kolomEnterprise">
	    						<div class="row form-body" >
	    							<div class="col-md-4">
	    								<div class="form-group">
	    									<input type="text" class="form-control" placeholder="NPSID" name="kolom_npsid" required>
	    								</div>
	    							</div>
	    							<div class="col-md-4">
	    								<div class="form-group">
	    									<input type="text" class="form-control" placeholder="Seg" name="kolom_seg" required>
	    								</div>
	    							</div>
	    							<div class="col-md-4">
	    								<div class="form-group">
	    									<input type="text" class="form-control" placeholder="No HP" name="kolom_no_hp" required>
	    								</div>
	    							</div>
	    							<div class="col-md-3">
	    								<div class="form-group">
	    									<input type="text" class="form-control" placeholder="BP" name="kolom_business_partner" required>
	    								</div>
	    							</div>
	    							<div class="col-md-4">
	    								<div class="form-group">
	    									<input type="text" class="form-control" placeholder="PIC" name="kolom_pic" required>
	    								</div>
	    							</div>
	    							<div class="col-md-5">
	    								<div class="form-group">
	    									<input type="text" class="form-control" placeholder="Episode" name="kolom_episode" required>
	    								</div>
	    							</div>
	    							<div class="col-md-4">
	    								<div class="form-group">
	    									<input type="text" class="form-control" placeholder="TREG" name="kolom_treg" required>
	    								</div>
	    							</div>
	    							<div class="col-md-4">
	    								<div class="form-group">
	    									<input type="text" class="form-control" placeholder="Witel" name="kolom_witel" required>
	    								</div>
	    							</div>
	    							<div class="col-md-4">
	    								<div class="form-group">
	    									<input type="text" class="form-control" placeholder="Produk" name="kolom_produk" required>
	    								</div>
	    							</div>
	    							<div class="col-md-12">
	    								<div class="form-group">
	    									<input type="text" class="form-control" placeholder="BP Name" name="kolom_bp_name" required>
	    								</div>
	    							</div>
	    						</div>
	    						<div class="form-actions right">
	    							<button type="reset" class="btn btn-warning mr-1">
	    								<i class="feather icon-x"></i> Ulangi
	    							</button>
	    							<button type="submit" class="btn btn-primary">
	    								<i class="fa fa-check-square-o"></i> Upload
	    							</button>
	    						</div>
    						</form>
    					</div>
    				</div>
    			</div>
    		</div>
        </div>
	</div>
	<div class="content-body">
		<div class="row">
			<div class="col-md-12">
				asd
			</div>
		</div>
	</div>
</div>
<div class="modal fade text-left" id="add-user-target" tabindex="-1" role="dialog" aria-labelledby="user-level-label" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content border-pink ">
			<div class="modal-header bg-pink bg-accent-2 white">
				<h4 class="modal-title" id="user-level-label">Users Target</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form-add-user-target">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>User Level</label>
								<input type="text" name="user_level" class="form-control" placeholder="User Level">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8">
							<div class="form-group">
								<label>User Level Deskripsi</label>
								<input type="text" name="user_level_desc" class="form-control" placeholder="Deskripsi">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Aktif</label>
								<input type="checkbox" name="is_enabled" class="switch" checked="checked" data-on-label="Ya" data-off-label="Tidak" />
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-outline-primary">Simpan Perubahan</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
