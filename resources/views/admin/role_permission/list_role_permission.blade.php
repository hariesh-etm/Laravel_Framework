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
                    <h4>Manage Role_permission</h4>
                    <div class="page-title-right">
                    <a href="<?php echo url('/');?>/add-role_permission" class="btn btn-primary"   style="float: right;">Add Role_permission</a>
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
                                    			<th>id</th>
			<th>role_id</th>
			<th>page_type</th>
			<th>create_option</th>
			<th>read_option</th>
			<th>update_option</th>
			<th>delete_option</th>

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
											var a = `<a href="<?php echo url('/');?>/edit-role_permission/${row.list_id}" data-hash="${row.id} " class="btn btn-sm btn btn-primary btn-addon  m-b-xxs edit-value"><i class="fa fa-edit"></i></a>  <button type="button" data-hash="${row.id} " class="btn btn-sm btn btn-danger btn-addon m-b-xxs delete-value"><i class="fa fa-trash"></i> </button>`;
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
            text: "Are you sure, you want to delete this Role_permission?",
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
