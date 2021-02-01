@extends('layouts.app')

@section('extra-lib-css')
<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/bootstrap-treeview.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/extensions/ex-component-treeview.min.css') }}">
<!-- END: Page CSS-->
@endsection
@section('extra-lib-js')
{{-- BEGIN: Page Vendor JS --}}
<script src="{{ asset('app-assets/vendors/js/extensions/bootstrap-treeview.min.js') }}"></script>
{{-- <script src="{{ asset('app-assets/js/scripts/pages/ex-component-treeview.min.js') }}"></script> --}}
@endsection
@section('extra-script')
{{-- Treeview --}}
<script type="text/javascript">
	var e = "#5A8DEE";
	function f_get_node_information() {
		console.log($('#checkable-tree').treeview('getChecked'/*, nodeId*/));
		console.log($('#checkable-tree').treeview('getUnchecked'/*, nodeId*/));
	}
	function f_get_menu_list(user_level) {
		$.ajaxSetup({
	      headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	      }
	    });
		$.ajax({
		 type:"post",
		 url:'{{ route('utilities.menu-managements.list-menu-ajax') }}',
		 data: {user_level: user_level},
		 success: function(data){
		  var t = [];
		  for (var i = 0; i < data.length && data.length > 0; i++) {
	  		var subchild = []
		  	if (data[i]['sub_child']) {
		  		for (var j = 0; j < data[i]['sub_child'].length; j++) {
		  			var checked_condition = true;
		  			if (data[i]['sub_child'][j]['kondisi'] == 0) { checked_condition = false; }
		  			subchild.push({ 
		  				text: data[i]['sub_child'][j]['menu_name'] 
		  				, dataAttributes: {
		  					id: data[i]['sub_child'][j]['id']
		  					, parent_menu: data[i]['sub_child'][j]['parent_menu']
							, menu_name: data[i]['sub_child'][j]['menu_name']
							, menu_child: data[i]['sub_child'][j]['menu_child']
							, menu_link: data[i]['sub_child'][j]['menu_link']
							, menu_icon: data[i]['sub_child'][j]['menu_icon']
		  				}
		  				, state: { checked: checked_condition }
		  			})
		  		}
		  	}
		  	var checked_condition = true;
  			if (data[i]['kondisi'] == 0) { checked_condition = false; }
		  	t.push({
		  		text: data[i]['menu_name']
		  		, dataAttributes: {
		  			id: data[i]['id']
		  			, parent_menu: data[i]['parent_menu']
					, menu_name: data[i]['menu_name']
					, menu_child: data[i]['menu_child']
					, menu_link: data[i]['menu_link']
					, menu_icon: data[i]['menu_icon']
		  		}
  				, state: { checked: checked_condition }
  				, nodes: (subchild.length > 0 ? subchild : null )
		  	});
		  }
		  $("#checkable-tree").treeview({
			selectedBackColor: [e],
			data: t,
			showIcon: !1,
			showCheckbox: !0,
			onNodeSelected: function(event, data) {
			    console.log(data['dataAttributes'])
			    $('<input>').attr({
					type: 'hidden',
					id: 'id_menu',
					name: 'id_menu',
					value: data['dataAttributes']['id']
				}).appendTo('#form-add-menu');
				$('#form-add-menu select[name=parent_menu]').val(data['dataAttributes']['parent_menu']).change();
				$('#form-add-menu input[name=menu_name]').val(data['dataAttributes']['menu_name']);
				$('#form-add-menu input[name=menu_order]').val(data['dataAttributes']['menu_order']);
				$('#form-add-menu select[name=menu_child]').val(data['dataAttributes']['menu_child']).change();
				$('#form-add-menu input[name=menu_link]').val(data['dataAttributes']['menu_link']);
				$('#form-add-menu input[name=menu_icon]').val(data['dataAttributes']['menu_icon']);
				$('#add-menu').modal('show');
			},
		  });
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
</script>
<script type="text/javascript">
	$("#user_level").change(function() {
		$('#user_level_desc').html($(this).find(':selected').data('level_deskripsi')).show('fast');
		f_get_menu_list($(this).val())
	});
	{{-- Document Ready --}}
	$( document ).ready(function() {
	    $('#user_level').val(1).change();
	    f_get_parent_menu_list();
	});
	// Events
    // On Close Modal Events
	$('#add-menu').on('hidden.bs.modal', function () {
		$("#form-add-menu input[type='hidden']").remove();
		$("#form-add-menu").trigger("reset");
		$("#form-add-menu select").val(0).change();
	});
	// On Submit Events
	$('#form-add-menu').on('submit', function(e){
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
		 url:'{{ route('utilities.menu-managements.save-menu') }}',
		 data: dataForm,
		 success: function(data){
		  btnSubmit.html('Simpan Perubahan');
		  toastr_me("success", "Success", "Successfully submit form.");
		  $('#add-menu').modal('hide');
		  refresh(null, false);
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
	// On Click
	$('#save-btn-user-access').on('click', function(e){
		e.preventDefault();
		var btnSubmit = $(this);
		btnSubmit.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
		var temp_checked_menu = $('#checkable-tree').treeview('getChecked'/*, nodeId*/)
		var temp_unchecked_menu = $('#checkable-tree').treeview('getUnchecked'/*, nodeId*/)
		var checked_menu = []
		var unchecked_menu = []
		for (var i = 0; i < temp_checked_menu.length; i++) {
			checked_menu.push( temp_checked_menu[i]['dataAttributes']['id'] )
		}
		for (var i = 0; i < temp_unchecked_menu.length; i++) {
			unchecked_menu.push( temp_unchecked_menu[i]['dataAttributes']['id'] )
		}

		var dataForm = {
			user_level: $('#user_level').val()
			, checked_menu: checked_menu
			, unchecked_menu: unchecked_menu
		};
		$.ajaxSetup({
	      headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	      }
	    });
		$.ajax({
		 type:"post",
		 url:'{{ route('utilities.menu-managements.save-user-access') }}',
		 data: dataForm,
		 success: function(data){
		  btnSubmit.html('<i class="fa fa-floppy-o"></i> Simpan Akses');
		  toastr_me("success", "Success", "Successfully submit form.");
		  // refresh(null, false);
		},
		  error: function(jqXhr, json, errorThrown){// this are default for ajax errors
		    btnSubmit.html('<i class="fa fa-floppy-o"></i> Simpan Akses');
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
	// Func
	function refresh(param1, param2) {
      f_get_menu_list($("#user_level").val());
      f_get_parent_menu_list();
    }
    function f_get_parent_menu_list() {
    	$.ajaxSetup({
	      headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	      }
	    });
		$.ajax({
		 type:"post",
		 url:'{{ route('utilities.menu-managements.list-parent-menu-ajax') }}',
		 // data: dataForm,
		 success: function(data){
		  var content = '<option value="0">-</option>';
		  for (var i = 0; i < data.length; i++) {
		  	content += '<option value="'+ data[i]['id'] +'">'+ data[i]['menu_name'] +'</option>'
		  }
		  $('#form-add-menu select[name=parent_menu]').html(content);
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
</script>
@endsection

@section('content')

<div class="content-overlay"></div>
<div class="content-wrapper">
	<div class="content-header row">
	</div>
	<div class="content-body">
		<div id="bootstrap-treeview" class="bootstraptreeview">
			<div class="row">
				<div class="col-md-4 col-12">
					<div class="card">
						<div class="card-header">
							<h6 class="card-title">User Level
							</h6>
						</div>
						<div class="card-content">
							<div class="card-body">
								<div class="form-group text-center">
									<div class="input-group">
										<select id="user_level" name="user_level" class="form-control">
											@foreach ($list_user_level as $user_level)
												<option value="{{ $user_level->id }}" data-level_deskripsi="{{ $user_level->user_level_desc }}">{{ $user_level->user_level }}</option>
											@endforeach
	                                	</select>
										<div class="input-group-append" id="button-addon2">
											<button class="btn btn-primary btn-icon" type="button" id="save-btn-user-access"><i class="fa fa-floppy-o"></i> Simpan Akses</button>
										</div>
									</div>
								</div>
								<p><strong>User Level Deskripsi</strong><br> <span id="user_level_desc"></span></p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-8 col-12">
					<div class="card">
						<div class="card-header">
							<h6 class="card-title">Menu
							</h6>
							<div class="heading-elements">
								<ul class="list-inline mb-0">
									<li><a href="#" onclick="$('#add-menu').modal('show');"><i class="feather icon-plus"></i> Tambah Menu</a></li>
								</ul>
							</div>
						</div>
						<div class="card-content">
							<div class="card-body">
								<div class="form-group text-center">
									{{-- <button type="button" class="btn btn-primary mb-1 mr-1" id="btn-check-all">Check All</button>
									<button type="button" class="btn btn-warning mb-1" id="btn-uncheck-all">Uncheck All</button> --}}
								</div>
								<div id="checkable-tree"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
{{-- Modal --}}
<div class="modal fade text-left" id="add-menu" tabindex="-1" role="dialog" aria-labelledby="menu-label" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content border-pink ">
			<div class="modal-header bg-pink bg-accent-2 white">
				<h4 class="modal-title" id="menu-label">Menu Manajemen</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form-add-menu">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Parent Menu</label>
								<select name="parent_menu" class="form-control">
                                </select>
							</div>
						</div>
						<div class="col-md-5">
							<div class="form-group">
								<label>Nama Menu</label>
								<input name="menu_name" type="text" class="form-control" placeholder="Nama Menu">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Sub Menu?</label>
								<select name="menu_child" class="form-control">
									<option value="0">Tidak</option>
									<option value="1">Iya</option>
                                </select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Menu Link</label>
								<input name="menu_link" type="text" class="form-control" placeholder="#">
							</div>
						</div>
						<div class="col-md-5">
							<div class="form-group">
								<label>Menu Icon</label>
								<input name="menu_icon" type="text" class="form-control" placeholder="feather icon-slack">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Menu Order</label>
								<input name="menu_order" type="text" class="form-control" placeholder="0">
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
