@extends('admin.main')

@section('content')

<div class="content">
    <div class="container">

        <div class="row p-3">
            <div class="col-12">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <h4>Update Role_permission</h4>
                    <div class="page-title-right">
                    <a href="<?php echo url('/');?>/manage-role_permission" class="btn btn-primary"   style="float: right;">Manage Role_permission</a>

                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="#" id="form" method="POST">
                            <input type="hidden" id="id" name="id" value="<?=$record->id?>"/>
                            <div class="row">
                            <div class="col-md-6">
                <label class="form-label">role_id <span class="text-danger">*</span></label> 
                <input type="text" name="role_id" class="form-control" placeholder="Enter role_id" id="role_id" value="<?=$record->role_id?>" required>
              </div>
             <div class="col-md-6">
                <label class="form-label">page_type</label> 
                <input type="text" name="page_type" class="form-control" placeholder="Enter page_type" id="page_type" value="<?=$record->page_type?>" >
              </div>
             <div class="col-md-6">
                <label class="form-label">create_option</label> 
                <input type="text" name="create_option" class="form-control" placeholder="Enter create_option" id="create_option" value="<?=$record->create_option?>" >
              </div>
             <div class="col-md-6">
                <label class="form-label">read_option</label> 
                <input type="text" name="read_option" class="form-control" placeholder="Enter read_option" id="read_option" value="<?=$record->read_option?>" >
              </div>
             <div class="col-md-6">
                <label class="form-label">update_option</label> 
                <input type="text" name="update_option" class="form-control" placeholder="Enter update_option" id="update_option" value="<?=$record->update_option?>" >
              </div>
             <div class="col-md-6">
                <label class="form-label">delete_option</label> 
                <input type="text" name="delete_option" class="form-control" placeholder="Enter delete_option" id="delete_option" value="<?=$record->delete_option?>" >
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
<script type="text/javascript">
window.onload = function(){

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
            title: 'Role_permission Updated Successfully',
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
           }
               </script>
@endsection
