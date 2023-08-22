@extends('admin.main')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row  p-3">
            <div class="col-12 p-0">
                <div class="d-sm-flex align-items-center justify-content-between">
                <div>
                    <p class="mb-0">Master</p>
                    <h4>Manage Country</h4>
                    </div>
                    <div class="page-title-right">
                    <a href="" class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#addCanvas" aria-controls="offcanvasRight">Add Country</a>
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
                                    <th>Country Id</th>
                                    <th>Country Name</th>
                                    <th>Phone Code</th>
                                    <th>Capital</th>
                                    <th>Currency Name</th>
                                    <th>Currency Symbol</th>
                                    <th>Tld</th>
                                    <th>Is Active</th>
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
      <h4 id="offcanvasRightLabel">Add Country</h4>
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
                                    <label class="form-label">Country Name</label>
                                    <input type="text" name="country_name" class="form-control" placeholder="Enter Country Name" id="country_name" >
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Phone Code</label>
                                    <input type="text" name="phone_code" class="form-control" placeholder="Enter Phone Code" id="phone_code" >
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Capital</label>
                                <input type="text" name="capital" class="form-control" placeholder="Enter capital" id="capital" >
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Currency Name</label>
                                <input type="text" name="currency_name" class="form-control" placeholder="Enter Currency Name" id="currency_name" >
                                </div>
                            </div>
                            <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Currency Symbol</label>
                            <input type="text" name="currency_symbol" class="form-control" placeholder="Enter Currency Symbol" id="currency_symbol" ></div>
                            <div class="col-md-6">
                                <label class="form-label">Tld</label>
                                <input type="text" name="tld" class="form-control" placeholder="Enter Tld" id="tld" >
                            </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Is Active</label>
                                    <select type="text" name="is_active" class="form-control" placeholder="Enter is_active" id="is_active" >
                                        <option value="">Select</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
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
<div class="offcanvas offcanvas-end" tabindex="-1" id="updateCanvas" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
      <h4 id="offcanvasRightLabel">Update Country</h4>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="#" id="form" method="POST">
                            <input type="hidden" id="u_country_id" name="u_country_id">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Country Name</label>
                                    <input type="text" name="u_country_name" class="form-control" placeholder="Enter Country Name" id="u_country_name" >
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Phone Code</label>
                                    <input type="text" name="u_phone_code" class="form-control" placeholder="Enter Phone Code" id="u_phone_code" >
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Capital</label>
                                <input type="text" name="u_capital" class="form-control" placeholder="Enter capital" id="u_capital" >
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Currency Name</label>
                                <input type="text" name="u_currency_name" class="form-control" placeholder="Enter Currency Name" id="u_currency_name" >
                                </div>
                            </div>
                            <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Currency Symbol</label>
                            <input type="text" name="u_currency_symbol" class="form-control" placeholder="Enter Currency Symbol" id="u_currency_symbol" ></div>
                            <div class="col-md-6">
                                <label class="form-label">Tld</label>
                                <input type="text" name="u_tld" class="form-control" placeholder="Enter Tld" id="u_tld" >
                            </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Is Active</label>
                                    <select type="text" name="u_is_active" class="form-control" placeholder="Enter is_active" id="u_is_active" >
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
	          'url':  '<?php echo url('/');?>/api/v1/country/list-countrydt'
	      	},
            "columns": [
	         	{ "data": 'country_id' },
                { "data": 'country_name' },
                // { "data": 'iso3' },
                // { "data": 'iso2' },
                // { "data": 'numeric_code' },
                { "data": 'phone_code' },
                { "data": 'capital' },
                // { "data": 'currency' },
                { "data": 'currency_name' },
                { "data": 'currency_symbol' },
                { "data": 'tld' },
                { "data": 'is_active' },
                { "data": 'created_date' },
                {  "render": function( data, type, row, meta ) {
											var a = `<a href="" data-hash="${row.country_id} " class="btn btn-sm btn btn-primary btn-addon  m-b-xxs edit-value"><i class="fa fa-edit"></i></a>  <button type="button" data-hash="${row.country_id} " class="btn btn-sm btn btn-danger btn-addon m-b-xxs delete-value"><i class="fa fa-trash"></i> </button>`;
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
            text: "Are you sure, you want to delete this Country?",
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
                        url:'<?php echo url('/');?>/api/v1/country/delete-country',
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
 var url = '<?php echo url('/');?>/api/v1/country/create-country';
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
            title: 'Country Added Successfully',
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.reload();
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
 var url = '<?php echo url('/');?>/api/v1/country/update-country';
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
            title: 'Country Updated Successfully',
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?=url('/');?>/manage-country";
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
                url:'<?php echo url('/');?>/api/v1/country/get-countrydt',
                data:{'id': id},
                success:function(data) {
                    console.log(data);
                    if(data.status =="SUCCESS"){
                        console.log(data.list);
                        $('#updateCanvas').offcanvas('show');
                        $('#u_country_id').val(data.list.country_id);
                        $('#u_country_name').val(data.list.country_name);
                        $('#u_phone_code').val(data.list.phone_code);
                        $('#u_capital').val(data.list.capital);
                        $('#u_currency_name').val(data.list.currency_name);
                        $('#u_currency_symbol').val(data.list.currency_symbol);
                        $('#u_tld').val(data.list.tld);
                        $('#u_is_active').val(data.list.is_active);
                    }else{
                        alert(data.message);
                    }
                }
            });
		});
    </script>
@endsection
