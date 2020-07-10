@extends('layouts.app')

@section('extra-lib-css')
<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/toggle/switchery.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/switch.min.css') }}">
<!-- END: Page CSS-->
@endsection
@section('extra-lib-js')
{{-- BEGIN: Page Vendor JS --}}
<script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/forms/toggle/switchery.min.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/forms/switch.min.js') }}"></script>
@endsection
@section('extra-script')
<script type="text/javascript">
	{{-- Properties --}}
	$.extend( true, $.fn.dataTable.defaults, {
		pageLength: 10,
		dom: 'Bftrip',
		ordering: false,
		searching: false,
		// scrollY: '364px',
	} );
	{{-- Document Ready --}}
	$( document ).ready(function() {
	    // 
	    f_get_list_level();
	});

	// Func
	function refresh_table(param1, param2) {
      table_1.ajax.reload(param1, param2);
      table_2.ajax.reload(param1, param2);
    }
    function f_edit_user(id, name, email, perner, username, posisi, user_level_id, is_enabled) {
    	$('<input>').attr({
	      type: 'hidden',
	      id: 'id_user',
	      name: 'id_user',
	      value: id
	    }).appendTo('#form-add-user');
	    $('#form-add-user input[name=name]').val(name);
	    $('#form-add-user input[name=perner]').val(perner);
	    $('#form-add-user input[name=username]').val(username);
	    $('#form-add-user input[name=email]').val(email);
	    $('#form-add-user input[name=posisi]').val(posisi);
	    $('#form-add-user select[name=user_level]').val(user_level_id).change();
	    $('#form-add-user input[name=is_enabled]').prop('checked', false);
	    if (is_enabled == 1) {$('#form-add-user input[name=is_enabled]').prop('checked', true)}
    }
	function f_edit_user_level(id, user_level, user_level_desc, is_enabled) {
    	$('<input>').attr({
	      type: 'hidden',
	      id: 'id_user_level',
	      name: 'id_user_level',
	      value: id
	    }).appendTo('#form-add-user-level');
	    $('#form-add-user-level input[name=user_level]').val(user_level);
	    $('#form-add-user-level input[name=user_level_desc]').val(user_level_desc);
	    $('#form-add-user-level input[name=is_enabled]').prop('checked', false);
	    if (is_enabled == 1) {$('#form-add-user-level input[name=is_enabled]').prop('checked', true)}
    }
	function f_get_list_level() {
		$.ajaxSetup({
	      headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	      }
	    });
		$.ajax({
		 type:"post",
		 url:'{{ route('utilities.user-managements.list-user-level-ajax') }}',
		 // data: dataForm,
		 success: function(data){
		  var content = '';
		  for (var i = 0; i < data.length; i++) {
		  	content += '<option value="'+ data[i]['id'] +'">'+ data[i]['user_level'] +'</option>'
		  }
		  $('#form-add-user select[name=user_level]').html(content);
		},
		  error: function(jqXhr, json, errorThrown){// this are default for ajax errors
		    var errors = jqXhr.responseJSON;
		    var errorsHtml = '<div class="alert alert-danger alert-dismissible" role="alert" style="margin-bottom: 0;"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Error ' + jqXhr.status + ': ' + errorThrown + '</div>';
		    toastr_me("error", "Error " + jqXhr.status, errorThrown);
		    $.each(errors['errors'], function (index, value) {
		      errorsHtml += '<div class="alert alert-danger alert-dismissible" role="alert" style="margin-bottom: 0;><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + value + '</div>';
		      toastr_me("error", "Error Field", value);
		    });
		  }
		}).done(function(){

		});
	}

	// Variable tabel
    var table_1 = $('#manajemen-user').DataTable({
      processing: true,
      serverSide: true,
      searching: true,
      buttons: [
	      {
	      	text: '<span class="fa fa-repeat"></span>',
	      	className: 'btn btn-icon btn-secondary mr-1 mb-1',
	      	action: function ( e, dt, node, config ) {
	      		dt.ajax.reload();
	      	}
	      },
	      {
	      	text: '<span class="fa fa-plus"></span>',
	      	className: 'btn btn-icon btn-secondary mr-1 mb-1',
	      	action: function ( e, dt, node, config ) {
	      		$('#add-user').modal('show')
	      	}
	      },

      ],
      ajax: {
        url: '{{ route('utilities.user-managements.list-user-datatables') }}'
      },
      columns: [
        { data: 'name', name: 'name' },
        { data: 'email', name: 'email' },
        { data: 'perner', name: 'perner' },
        { data: 'username', name: 'username' },
        { data: 'posisi', name: 'posisi' },
        { data: 'user_level', name: 'user_level' },
        { data: 'status', name: 'status' },
        { data: 'action', name: 'action' },
        
      ],
      language: {
        processing: '<i class="fa fa-gear spinner"></i>'
      },
    });
    var table_2 = $('#manajemen-user-level').DataTable({
      processing: true,
      serverSide: true,
      buttons: [
	      {
	      	text: '<span class="fa fa-repeat"></span>',
	      	className: 'btn btn-icon btn-secondary mr-1 mb-1',
	      	action: function ( e, dt, node, config ) {
	      		dt.ajax.reload();
	      	}
	      },
	      {
	      	text: '<span class="fa fa-plus"></span>',
	      	className: 'btn btn-icon btn-secondary mr-1 mb-1',
	      	action: function ( e, dt, node, config ) {
	      		$('#add-user-level').modal('show')
	      	}
	      },

      ],
      ajax: {
        url: '{{ route('utilities.user-managements.list-user-level-datatables') }}'
      },
      columns: [
        { data: 'user_level', name: 'user_level' },
        { data: 'user_level_desc', name: 'user_level_desc' },
        { data: 'status', name: 'status' },
        { data: 'action', name: 'action' },
        
      ],
      language: {
        processing: '<i class="fa fa-gear spinner"></i>'
      },
    });

    // Events
    // On Close Modal Events
	$('#add-user').on('hidden.bs.modal', function () {
		$("#form-add-user input[type='hidden']").remove();
		$("#form-add-user").trigger("reset");
		$("#form-add-user select").val('').change();
		$('#form-add-user input[name=is_enabled]').prop('checked', true)
	});
	$('#add-user-level').on('hidden.bs.modal', function () {
		$("#form-add-user-level input[type='hidden']").remove();
		$("#form-add-user-level").trigger("reset");
		$('#form-add-user-level input[name=is_enabled]').prop('checked', true)
	});
	// On Submit Events
	$('#form-add-user').on('submit', function(e){
		e.preventDefault();
		var btnSubmit = $(':submit', this);
		btnSubmit.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
		var dataForm = $( this ).serializeArray();
		$.ajaxSetup({
	      headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	      }
	    });
		$.ajax({
		 type:"post",
		 url:'{{ route('utilities.user-managements.save-user') }}',
		 data: dataForm,
		 success: function(data){
		  btnSubmit.html('Simpan Perubahan');
		  toastr_me("success", "Success", "Successfully submit form.");
		  $('#add-user').modal('hide');
		  refresh_table(null, false);
		},
		  error: function(jqXhr, json, errorThrown){// this are default for ajax errors
		    btnSubmit.html('Simpan Perubahan');
		    var errors = jqXhr.responseJSON;
		    var errorsHtml = '<div class="alert alert-danger alert-dismissible" role="alert" style="margin-bottom: 0;"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Error ' + jqXhr.status + ': ' + errorThrown + '</div>';
		    toastr_me("error", "Error " + jqXhr.status, errorThrown);
		    $.each(errors['errors'], function (index, value) {
		      errorsHtml += '<div class="alert alert-danger alert-dismissible" role="alert" style="margin-bottom: 0;><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + value + '</div>';
		      toastr_me("error", "Error Field", value);
		    });
		  }
		}).done(function(){

		});

	});
	$('#form-add-user-level').on('submit', function(e){
		e.preventDefault();
		var btnSubmit = $(':submit', this);
		btnSubmit.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
		var dataForm = $( this ).serializeArray();
		$.ajaxSetup({
	      headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	      }
	    });
		$.ajax({
		 type:"post",
		 url:'{{ route('utilities.user-managements.save-user-level') }}',
		 data: dataForm,
		 success: function(data){
		  btnSubmit.html('Simpan Perubahan');
		  toastr_me("success", "Success", "Successfully submit form.");
		  $('#add-user-level').modal('hide');
		  refresh_table(null, false);
		  f_get_list_level();
		},
		  error: function(jqXhr, json, errorThrown){// this are default for ajax errors
		    btnSubmit.html('Simpan Perubahan');
		    var errors = jqXhr.responseJSON;
		    var errorsHtml = '<div class="alert alert-danger alert-dismissible" role="alert" style="margin-bottom: 0;"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Error ' + jqXhr.status + ': ' + errorThrown + '</div>';
		    toastr_me("error", "Error " + jqXhr.status, errorThrown);
		    $.each(errors['errors'], function (index, value) {
		      errorsHtml += '<div class="alert alert-danger alert-dismissible" role="alert" style="margin-bottom: 0;><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + value + '</div>';
		      toastr_me("error", "Error Field", value);
		    });
		  }
		}).done(function(){

		});

	});
</script>
@endsection
@section('content')

<div class="content-overlay"></div>
<div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">
        <div class="row">
        	<div class="col-8">
    			<div class="card">
    				<div class="card-header">
    					<h4 class="card-title">Manajemen User</h4>
    				</div>
    				<div class="card-content">
    					<div class="card-body card-dashboard">
    						<table class="table table-striped table-bordered" id="manajemen-user">
    							<thead>
    								<tr>
    									<th>Nama</th>
    									<th>Email</th>
    									<th>Perner</th>
    									<th>Username</th>
    									<th>Posisi</th>
    									<th>User Level</th>
    									<th>Status</th>
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
    		<div class="col-4">
    			<div class="card">
    				<div class="card-header">
    					<h4 class="card-title">Manajemen User Level</h4>
    				</div>
    				<div class="card-content">
    					<div class="card-body card-dashboard">
    						<table class="table table-striped table-bordered" id="manajemen-user-level">
    							<thead>
    								<tr>
    									<th>User Level</th>
    									<th>Level Deskripsi</th>
    									<th>Status</th>
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
        </div>

    </div>
</div>
<!-- Modal -->
<div class="modal fade text-left" id="add-user" tabindex="-1" role="dialog" aria-labelledby="user-label" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content border-pink ">
			<div class="modal-header bg-pink bg-accent-2 white">
				<h4 class="modal-title" id="user-label">User Manajemen</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form-add-user">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Nama</label>
								<input name="name" type="text" class="form-control" placeholder="Nama">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Perner</label>
								<input name="perner" type="text" class="form-control" placeholder="Perner">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Username</label>
								<input name="username" type="text" class="form-control" placeholder="Username">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-7">
							<div class="form-group">
								<label>Email</label>
								<input name="email" type="email" class="form-control" placeholder="Email">
							</div>
						</div>
						<div class="col-md-5">
							<div class="form-group">
								<label>Posisi</label>
								<input name="posisi" type="text" class="form-control" placeholder="Posisi">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8">
							<div class="form-group">
								<label>User Level</label>
								<select name="user_level" class="form-control">
                                </select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Aktif</label>
								<input name="is_enabled" type="checkbox" class="switch" checked="checked" data-on-label="Ya" data-off-label="Tidak" />
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
<div class="modal fade text-left" id="add-user-level" tabindex="-1" role="dialog" aria-labelledby="user-level-label" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content border-pink ">
			<div class="modal-header bg-pink bg-accent-2 white">
				<h4 class="modal-title" id="user-level-label">User Level Manajemen</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form-add-user-level">
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
