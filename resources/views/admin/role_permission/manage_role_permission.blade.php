@extends('admin.main')
 
@section('content')
<!-- third party css -->
<link href="<?=url('/')?>/assets/datatable/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="<?=url('/')?>/assets/datatable/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="<?=url('/')?>/assets/datatable/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="<?=url('/')?>/assets/datatable/libs/datatables.net-select-bs5/css/select.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<!-- third party css end -->
<div class="content">
    <div class="container">
        <div class="row  p-3">
            <div class="col-12">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <h4>Manage Role Permission</h4>
                    <div class="page-title-right">
                    <a href=" " class="btn btn-primary"   style="float: right;" data-bs-toggle="offcanvas" data-bs-target="#addcanvas" aria-controls="offcanvasRight">Add Role Permission</a>
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
                                    <th>Role</th>
                                    <th>Page Type</th>
                                    <th>Create</th>
                                    <th>Read</th>
                                    <th>Update</th>
                                    <th>Delete</th>
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
<div class="offcanvas offcanvas-end" tabindex="-1" id="addcanvas" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
      <h5 id="offcanvasRightLabel">Add Role Permission</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="col-sm-12 col-md-12 col-lg-12 justify-content">
        <form action="#" id="addform" method="POST">
            <div class="col-11 mb-3">
              <label class="form-label">Role <span class="text-danger">*</span></label> 
                <select type="text" name="role_id" class="form-select" id="role_id" required>
                <option value="">Select Role</option>
                <?php
                if(!empty($role)){
                foreach ($role as $item) { ?>
                <option value="<?=$item->id?>"><?=$item->role_name?></option>
                <?php   }} ?>
                </select>
              </div>
            <div class="col-11 mb-3">
              <label class="form-label">Page Type</label> 
              <input type="text" name="page_type" class="form-control" placeholder="Enter input page type" id="page_type" required>
              </div>
            <div class="col-11 mb-3">
             
              <input type="checkbox" name="create_option"  id="create_option" value="1">
              <label>Create </label> 
              
              <input type="checkbox" name="read_option" id="read_option" value="1">
              <label>Read </label> 
             
              <input type="checkbox" name="update_option" id="update_option" value="1">
              <label>Update </label> 
             
              <input type="checkbox" name="delete_option" id="delete_option" value="1">
              <label>Delete</label> 
              </div>
            
            <div class="text-end">
                <button class="btn btn-primary" id="save_button" type="submit">Submit</button>
                <button type="button" style="display:none;" id="save_button_loading" class="btn">Storing the data please wait ...</button>
            </div>
        </form>
    </div>
  </div>
</div>
<div class="offcanvas offcanvas-end" tabindex="-1" id="editcanvas" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
      <h5 id="offcanvasRightLabel">Update Role Permission</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="col-sm-12 col-md-12 col-lg-12 justify-content">
        <form action="#" id="form" method="POST">
            <input type="hidden" name="id" id="id">
            <div class="col-11 mb-3">
                <label class="form-label">Role <span class="text-danger">*</span></label> 
                  <select type="text" name="u_role_id" class="form-select" id="u_role_id" required>
                  <option value="">Select Role</option>
                  <?php
                  if(!empty($role)){
                  foreach ($role as $item) { ?>
                  <option value="<?=$item->id?>"><?=$item->role_name?></option>
                  <?php   }} ?>
                  </select>
                </div>
              <div class="col-11 mb-3">
                <label class="form-label">Page Type</label> 
                <input type="text" name="u_page_type" class="form-control" placeholder="Enter input page type" id="u_page_type" required>
                </div>
              <div class="col-11 mb-3">
               
                <input type="checkbox" name="u_create_option"  id="u_create_option" value="1">
                <label>Create </label> 
                
                <input type="checkbox" name="u_read_option" id="u_read_option" value="1">
                <label>Read </label> 
               
                <input type="checkbox" name="u_update_option" id="u_update_option" value="1">
                <label>Update </label> 
               
                <input type="checkbox" name="u_delete_option" id="u_delete_option" value="1">
                <label>Delete</label> 
                </div>
            <div class="text-end">
                <button class="btn btn-primary" id="save_button" type="submit">Submit</button>
                <button type="button" style="display:none;" id="save_button_loading" class="btn">Storing the data please wait ...</button>
            </div>
        </form>
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
	          'url':  '<?php echo url('/');?>/api/v1/role_permission/list-role_permissiondt'
	      	},
            "columns": [
	            { "data": 'id' },
                { "data": 'role_id' },
                { "data": 'page_type' },
                { "data": 'create_option' },
                { "data": 'read_option' },
                { "data": 'update_option' },
                { "data": 'delete_option' },
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
            text: "Are you sure, you want to delete this Role Permission?",
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
                        url:'<?php echo url('/');?>/api/v1/role_permission/delete-role_permission',
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
    window.onload = function(){
var addformInstance = document.getElementById('addform');
addformInstance.addEventListener('submit', function(event) {
 var headers = new Headers();
 headers.set('Accept', 'application/json');
 $("#save_button").hide();
 $("#save_button_loading").show();
 var formData = new FormData();
 for (var i = 0; i < addformInstance.length; ++i) {
    if(addformInstance[i].name == "media"){
       const fileField = document.querySelector('input[name="media"]');
       formData.append('media', fileField.files[0]);
     }else if(addformInstance[i].name == "create_option"){
        if($('#create_option').is(":checked")){
            formData.append('create_option', "1");
        }else{
            formData.append('create_option', "0");
        }
     }else if(addformInstance[i].name == "read_option"){
        if($('#read_option').is(":checked")){
            formData.append('read_option', "1");
        }else{
            formData.append('read_option', "0");
        }
     }else if(addformInstance[i].name == "update_option"){
        if($('#update_option').is(":checked")){
            formData.append('update_option', "1");
        }else{
            formData.append('update_option', "0");
        }
     }else if(addformInstance[i].name == "delete_option"){
        if($('#delete_option').is(":checked")){
            formData.append('delete_option', "1");
        }else{
            formData.append('delete_option', "0");
        }
     }else{
       formData.append(addformInstance[i].name, addformInstance[i].value);
     }
 }
 var url = '<?php echo url('/');?>/api/v1/role_permission/create-role_permission';
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
            title: 'Role Permission Added Successfully',
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?=url('/');?>/manage-role_permission";
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
var formInstance = document.getElementById('form');
formInstance.addEventListener('submit', function(event) {
 var headers = new Headers();
 headers.set('Accept', 'application/json');
 $("#save_button").hide();
 $("#save_button_loading").show();
 var formData = new FormData();
 for (var i = 0; i < formInstance.length; ++i) {
    if(formInstance[i].name == "media"){
       const fileField = document.querySelector('input[name="media"]');
       formData.append('media', fileField.files[0]);
     }else if(formInstance[i].name == "u_create_option"){
        if($('#u_create_option').is(":checked")){
            formData.append('create_option', "1");
        }else{
            formData.append('create_option', "0");
        }
     }else if(formInstance[i].name == "u_read_option"){
        if($('#u_read_option').is(":checked")){
            formData.append('read_option', "1");
        }else{
            formData.append('read_option', "0");
        }
     }else if(formInstance[i].name == "u_update_option"){
        if($('#u_update_option').is(":checked")){
            formData.append('update_option', "1");
        }else{
            formData.append('update_option', "0");
        }
     }else if(formInstance[i].name == "u_delete_option"){
        if($('#u_delete_option').is(":checked")){
            formData.append('delete_option', "1");
        }else{
            formData.append('delete_option', "0");
        }
     }else{
       formData.append(formInstance[i].name, formInstance[i].value);
     }
 }
 var url = '<?php echo url('/');?>/api/v1/role_permission/update-role_permission';
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
            title: 'Role Permission Updated Successfully',
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?=url('/');?>/manage-role_permission";
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
    var id= $(this).attr('data-hash');
    console.log(id);
    if(id !=""){
		e.preventDefault();
        $.ajax({
                        type:'GET',
                        url:'<?php echo url('/');?>/api/v1/role_permission/list-role_permission-ById',
                        data:{'id':id},
                        success:function(data) {
                            console.log(data);
                            if(data.status =="SUCCESS")
                            {
                                // console.log("here");
                                $("#editcanvas").offcanvas('show');
                                $("#id").val(data.list.id);
                                $("#u_role_id").val(data.list.role_id);
                                $("#u_page_type").val(data.list.page_type);
                                if(data.list.create_option == "1"){
                                    $("#u_create_option").prop('checked', true);
                                }else{
                                    $("#u_create_option").prop('checked', false);
                                }
                                if(data.list.read_option == "1"){
                                    $("#u_read_option").prop('checked', true);
                                }else{
                                    $("#u_read_option").prop('checked', false);
                                }
                                if(data.list.update_option == "1"){
                                    $("#u_update_option").prop('checked', true);
                                }else{
                                    $("#u_update_option").prop('checked', false);
                                }
                                if(data.list.delete_option == "1"){
                                    $("#u_delete_option").prop('checked', true);
                                }else{
                                    $("#u_delete_option").prop('checked', false);
                                }
                                //$("#u_create_option").val(data.list.create_option);
                                // $("#u_read_option").val(data.list.read_option);
                                // $("#u_update_option").val(data.list.update_option);
                                // $("#u_delete_option").val(data.list.delete_option);
                            }else{
                            $("#error").show();
                            $("#errormessage").text(data.message);
                            }
                        }
                    });
    }else{
        Swal.fire(
               'Failed!',
               'Please Fill the (*) Fields',
               'error'
        );
}
});
           }
    </script>
 <!-- third party js -->
 <script src="<?=url('/')?>/assets/datatable/libs/datatables.net/js/jquery.dataTables.min.js"></script>
 <script src="<?=url('/')?>/assets/datatable/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
 <script src="<?=url('/')?>/assets/datatable/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
 <script src="<?=url('/')?>/assets/datatable/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
 <script src="<?=url('/')?>/assets/datatable/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
 <script src="<?=url('/')?>/assets/datatable/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
 <script src="<?=url('/')?>/assets/datatable/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
 <script src="<?=url('/')?>/assets/datatable/libs/datatables.net-buttons/js/buttons.flash.min.js"></script>
 <script src="<?=url('/')?>/assets/datatable/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
 <script src="<?=url('/')?>/assets/datatable/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
 <script src="<?=url('/')?>/assets/datatable/libs/datatables.net-select/js/dataTables.select.min.js"></script>
 <script src="<?=url('/')?>/assets/datatable/libs/pdfmake/build/pdfmake.min.js"></script>
 <script src="<?=url('/')?>/assets/datatable/libs/pdfmake/build/vfs_fonts.js"></script>
 <!-- third party js ends -->
 <!-- Datatables init -->
 <script src="<?=url('/')?>/assets/datatable/js/datatables.init.js"></script>
@endsection
