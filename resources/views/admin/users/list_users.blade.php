@extends('admin.main')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row  p-3">
            <div class="col-12 p-0">
                <div class="d-sm-flex align-items-center justify-content-between">
                <div>
                    <p class="mb-0">Master</p>
                    <h4>Manage User</h4>
                    </div>
                    <div class="page-title-right">
                    <a href="" class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#addCanvas" aria-controls="offcanvasRight"   style="float: right;">Add Users</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="datatable" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Role</th>
                                    <!-- <th>Active</th> -->
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->
    </div>
</div>
<div class="offcanvas offcanvas-end" tabindex="-1" id="addCanvas" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header">
    <h5 id="offcanvasRightLabel">Add User</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="#" id="addform" method="POST">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">username</label>
                                <input type="text" name="username" class="form-control" placeholder="Enter username" id="username" >
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">password</label>
                                <input type="text" name="password" class="form-control" placeholder="Enter password" id="password" >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">fullname <span class="text-danger">*</span></label>
                                <input type="text" name="fullname" class="form-control" placeholder="Enter fullname" id="fullname" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">email <span class="text-danger">*</span></label>
                            <input type="text" name="email" class="form-control" placeholder="Enter email" id="email" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">mobile <span class="text-danger">*</span></label>
                                <input type="text" name="mobile" class="form-control" placeholder="Enter mobile" id="mobile" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">role</label>
                            <select type="text" name="role" class="form-control" placeholder="Enter role" id="role" >
                                <option value="">Select Role</option>
                                <?php
                                if(!empty($role)){
                                foreach ($role as $item) { ?>
                                <option value="<?=$item->id?>"><?=$item->role_name?></option>
                                <?php   }} ?>
                            </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">active</label>
                                <select type="text" name="active" class="form-control" placeholder="Enter active" id="active" >
                                    <option value="">Select</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="text-end">
                            <button class="btn btn-primary" id="save_button" type="submit">Submit</button>
                            <button type="button" style="display:none;" id="save_button_loading" class="btn">Storing the data please wait ...</button>
                        </div>
                    </form>
                </div>
            </div> <!-- end card -->
        </div>
    </div>
  </div>
</div>
<div class="offcanvas offcanvas-end" tabindex="-1" id="updateCanvas" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
      <h5 id="offcanvasRightLabel">Update User</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="#" id="form" method="POST">
                            <input type="hidden" id="u_id" name="u_id">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">username</label>
                                    <input type="text" name="u_username" class="form-control" placeholder="Enter username" id="u_username" >
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">password</label>
                                    <input type="text" name="u_password" class="form-control" placeholder="Enter password" id="u_password" >
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">fullname <span class="text-danger">*</span></label>
                                    <input type="text" name="u_fullname" class="form-control" placeholder="Enter fullname" id="u_fullname" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">email <span class="text-danger">*</span></label>
                                <input type="text" name="u_email" class="form-control" placeholder="Enter email" id="u_email" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">mobile <span class="text-danger">*</span></label>
                                    <input type="text" name="u_mobile" class="form-control" placeholder="Enter mobile" id="u_mobile" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">role</label>
                                <select type="text" name="u_role" class="form-control" placeholder="Enter role" id="u_role" >
                                    <option value="">Select Role</option>
                                    <?php
                                    if(!empty($role)){
                                    foreach ($role as $item) { ?>
                                    <option value="<?=$item->id?>"><?=$item->role_name?></option>
                                    <?php   }} ?>
                                </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">active</label>
                                    <select type="text" name="u_active" class="form-control" placeholder="Enter active" id="u_active" >
                                        <option value="">Select</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text-end">
                                <button class="btn btn-primary" id="save_button" type="submit">Submit</button>
                                <button type="button" style="display:none;" id="save_button_loading" class="btn">Storing the data please wait ...</button>
                            </div>
                        </form>
                    </div>
                </div> <!-- end card -->
            </div>
        </div>
    </div>
  </div>
<script src="<?=url('/')?>/assets/datatable/js/jquery-3.4.1.min.js"></script>
<script src="<?php echo url('/');?>/assets/datatable/js/sweetalert2@11.js"></script>
<script>
    $(document).ready(function(){
        table = $('#datatable-buttons').DataTable( {
        destroy: true,
        searching: false
    });
    table.destroy();
	   	$('#datatable').DataTable({
            dom: '<"dt-top-container"<l><"dt-center-in-div pt-3"B><f>r>t<ip>',
                                        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
            ],
			"order": [[ 0, "desc" ]],
	      	'processing': true,
	      	'serverSide': true,
              retrieve: true,
              columnDefs: [{
                    "defaultContent": "-",
                    "targets": "_all"
                }],
            "responsive": true,
	      	'serverMethod': 'GET',
	      	'ajax': {
	          'url':  '<?php echo url('/');?>/api/v1/users/list-usersdt'
	      	},
            "columns": [
	         	{ "data": 'id' },
                // { "data": 'username' },
                // { "data": 'password' },
                { "data": 'fullname' },
                { "data": 'email' },
                { "data": 'mobile' },
                { "data": 'role' },
                //{ "data": 'active' },
                { "data": 'created_date' },
                {  "render": function( data, type, row, meta ) {
											var a = `<a href="" data-hash="${row.id} " class="btn btn-sm btn btn-primary btn-addon  m-b-xxs edit-value"><i class="fa fa-edit"></i></a>  <button type="button" data-hash="${row.id} " class="btn btn-sm btn btn-danger btn-addon m-b-xxs delete-value"><i class="fa fa-trash"></i> </button>`;
                                            return a;
				}}
	      	]
	   	});
	});
    $(document).on("click", ".delete-value", function (e) {
		e.preventDefault();
		//var result = confirm("");
        Swal.fire({
            title: 'Are you sure?',
            text: "Are you sure, you want to delete this Users?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
            }).then((result) => {
            if (result.isConfirmed) {
			var id = $(this).attr('data-hash');
            $.ajax({
                        type:'DELETE',
                        url:'<?php echo url('/');?>/api/v1/users/delete-users',
                        data:{'id': id},
                        success:function(data) {
                            console.log(data);
                            if(data.status =="SUCCESS")
                            {
                                location.reload();
                            }else{
                              alert(data.message);
                            }
                        }
                    });
		}
	});
    });

var insertform = document.getElementById('addform');
insertform.addEventListener('submit', function(event) {
 var headers = new Headers();
 headers.set('Accept', 'application/json');
 $("#save_button").hide();
 $("#save_button_loading").show();
 var formData = new FormData();
 for (var i = 0; i < insertform.length; ++i) {
    if(insertform[i].name == "media"){
       const fileField = document.querySelector('input[name="media"]');
       formData.append('media', fileField.files[0]);
     }else{
       formData.append(insertform[i].name, insertform[i].value);
     }
 }
 var url = '<?php echo url('/');?>/api/v1/users/create-users';
 var fetchOptions = {
   method: 'POST',
   headers,
   body: formData
 };
 var responsePromise = fetch(url, fetchOptions);
 responsePromise
     .then(response => response.json())
       .then(data => {
        $("#save_button").show();
        $("#save_button_loading").hide();
           if (data.status == 'SUCCESS') {
               // console.log(data);
               Swal.fire({
            title: 'Users Added Successfully',
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?=url('/');?>/manage-users";
            }})
           } else {
               Swal.fire(
               'Failed!',
               data.message,
               'error'
               );
           }
       })
 event.preventDefault();
});
           
           $(document).on("click", ".edit-value", function (e) {
e.preventDefault();
    var id = $(this).attr('data-hash');
    $.ajax({
                type:'GET',
                url:'<?php echo url('/');?>/api/v1/users/get-usersdt',
                data:{'id': id},
                success:function(data) {
                    console.log(data);
                    if(data.status =="SUCCESS"){
                        console.log(data.list);
                        $('#updateCanvas').offcanvas('show');
                        $('#u_id').val(data.list.id);
                        $('#u_username').val(data.list.username);
                        $('#u_password').val(data.list.password);
                        $('#u_fullname').val(data.list.fullname);
                        $('#u_email').val(data.list.email);
                        $('#u_mobile').val(data.list.mobile);
                        $('#u_role').val(data.list.role);
                        $('#u_active').val(data.list.active);
                    }else{
                      alert(data.message);
                    }
                }
            });
});

var updateform = document.getElementById('form');
updateform.addEventListener('submit', function(event) {
 var headers = new Headers();
 headers.set('Accept', 'application/json');
 $("#save_button").hide();
 $("#save_button_loading").show();
 var formData = new FormData();
 for (var i = 0; i < updateform.length; ++i) {
    if(updateform[i].name == "media"){
       const fileField = document.querySelector('input[name="media"]');
       formData.append('media', fileField.files[0]);
     }else{
       formData.append(updateform[i].name, updateform[i].value);
     }
 }
 var url = '<?php echo url('/');?>/api/v1/users/update-users';
 var fetchOptions = {
   method: 'POST',
   headers,
   body: formData
 };
 var responsePromise = fetch(url, fetchOptions);
 responsePromise
     .then(response => response.json())
       .then(data => {
        $("#save_button").show();
        $("#save_button_loading").hide();
           if (data.status == 'SUCCESS') {
               // console.log(data);
               Swal.fire({
            title: 'Users Updated Successfully',
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?=url('/');?>/manage-users";
            }})
           } else {
               Swal.fire(
               'Failed!',
               data.message,
               'error'
               );
           }
       })
 event.preventDefault();
});
           
    </script>
@endsection
