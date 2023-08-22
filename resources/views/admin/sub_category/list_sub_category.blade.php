@extends('admin.main')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row  p-3">
            <div class="col-12 p-0">
                <div class="d-sm-flex align-items-center justify-content-between">
                <div>
                    <p class="mb-0">Master</p>
                    <h4>Manage Sub Category</h4>
                    </div>
                    <div class="page-title-right">
                    <a href="" class="btn btn-primary"  data-bs-toggle="offcanvas" data-bs-target="#addCanvas" aria-controls="offcanvasRight"   style="float: right;">Add Sub Category</a>
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
                                    <th>Id</th>
                                    <th>Category</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Serial</th>
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
    <h5 id="offcanvasRightLabel">Add Sub Category</h5>
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
                                <label class="form-label">Category <span class="text-danger">*</span></label>
                                <select type="text" name="category_id" class="form-control" placeholder="Enter category_id" id="category_id" required>
                                    <option value="">Select Category</option>
                                    <?php
                                                          if(!empty($category)){
                                                          foreach ($category as $item) { ?>
                                                          <option value="<?=$item->id?>"><?=$item->name?></option>
                                                          <?php   }} ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Sub Category Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="Enter name" id="name" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Slug <span class="text-danger">*</span></label>
                                <input type="text" name="slug" class="form-control" placeholder="Enter slug" id="slug" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Serial</label>
                            <input type="text" name="serial" class="form-control" placeholder="Enter serial" id="serial" >
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
      <h5 id="offcanvasRightLabel">Update Sub Category</h5>
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
                                <label class="form-label">Category <span class="text-danger">*</span></label>
                                <select type="text" name="u_category_id" class="form-control" placeholder="Enter category_id" id="u_category_id" required>
                                    <option value="">Select Category</option>
                                    <?php
                                                          if(!empty($category)){
                                                          foreach ($category as $item) { ?>
                                                          <option value="<?=$item->id?>"><?=$item->name?></option>
                                                          <?php   }} ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Sub Category Name <span class="text-danger">*</span></label>
                                <input type="text" name="u_name" class="form-control" placeholder="Enter name" id="u_name" required>
                            </div>
                                </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Slug <span class="text-danger">*</span></label>
                                    <input type="text" name="u_slug" class="form-control" placeholder="Enter slug" id="u_slug" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Serial</label>
                                    <input type="text" name="u_serial" class="form-control" placeholder="Enter serial" id="u_serial" >
                                </div>
                            </div>
                          <div class="text-end">
                              <button class="btn btn-primary" id="save_button" type="submit" >Submit</button>
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
	          'url':  '<?php echo url('/');?>/api/v1/sub_category/list-sub_categorydt'
	      	},
            "columns": [
	         	{ "data": 'id' },
                { "data": 'category_id' },
                { "data": 'name' },
                { "data": 'slug' },
                { "data": 'serial' },
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
            text: "Are you sure, you want to delete this Sub_category?",
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
                        url:'<?php echo url('/');?>/api/v1/sub_category/delete-sub_category',
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
 var url = '<?php echo url('/');?>/api/v1/sub_category/create-sub_category';
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
            title: 'Sub Category Added Successfully',
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?=url('/');?>/manage-sub_category";
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
                url:'<?php echo url('/');?>/api/v1/sub_category/get-sub_categorydt',
                data:{'id': id},
                success:function(data) {
                    console.log(data);
                    if(data.status =="SUCCESS"){
                        console.log(data.list);
                        $('#updateCanvas').offcanvas('show');
                        $('#u_id').val(data.list.id);
                        $('#u_category_id').val(data.list.category_id);
                        $('#u_name').val(data.list.name);
                        $('#u_slug').val(data.list.slug);
                        $('#u_serial').val(data.list.serial);
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
 var url = '<?php echo url('/');?>/api/v1/sub_category/update-sub_category';
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
            title: 'Sub Category Updated Successfully',
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?=url('/');?>/manage-sub_category";
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
