@extends('admin.main')
 
@section('content')
<style>
    .validation_error{
    border-color: #dc3545 !important;
    }
    /* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
</style>
<div class="content">
    <div class="container-fluid">
    <div class="row  p-3">
            <div class="col-12 p-0">
                <div class="d-sm-flex align-items-center justify-content-between">
                <div>
                    <p class="mb-0">Master</p>
                    <h4>Form Validation </h4>
                    </div>
                   </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
    
                        <form action="#" id="addform" method="POST" class="row g-3 addform-needs-validation" novalidate>
    
                            <div class="col-md-6">
                                <label class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="Enter name" id="name" required>
                                <div class="invalid-feedback" id="name_error"><span id="name_message">Please Fill your name</span></div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone <span class="text-danger">*</span></label>
                                <input type="number" name="phone" class="form-control" placeholder="Enter phone number" id="phone" required>
                                <div class="invalid-feedback" id="phone_error"><span id="phone_message">Please Fill phone number</span></div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" placeholder="Enter email number" id="email" required>
                                <div class="invalid-feedback" id="email_error"><span id="email_message">Please Fill email</span></div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Aadhar No <span class="text-danger">*</span></label>
                                <input type="number" name="aadhar" class="form-control" placeholder="Enter aadhar number" id="aadhar" required>
                                <div class="invalid-feedback" id="aadhar_error"><span id="aadhar_message">Please Fill aadhar number</span></div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Pancard No <span class="text-danger">*</span></label>
                                <input type="text" name="pancard" class="form-control" placeholder="Enter pancard number" id="pancard" required>
                                <div class="invalid-feedback" id="pancard_error"><span id="pancard_message">Please Fill pancard number</span></div>
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
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script>
(function () {
  'use strict'
  var forms = document.querySelectorAll('.addform-needs-validation')
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
          console.log("no");
        }else{
            console.log("yes");
            event.preventDefault()
            submit();
        }
        form.classList.add('was-validated')
      }, false)
    })
})()
function submit(){
  
    
 var insertform = document.getElementById('addform');
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
 var url = '<?php echo url('/');?>/api/v1/admin/form-valid';
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
              
               Swal.fire({
            title: 'Record Added Successfully',
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
            }).then((result) => {
            if (result.isConfirmed) {
                //window.location.href = "<?=url('/');?>/manage-products";
            }})
           } else if(data.code == '110'){
                $("#addform").removeClass('was-validated');
                console.log(Object.keys(data.message));
                var rec = data.message;
                var names = Object.keys(data.message);
                for(i=0;i<names.length;i++){
                    console.log(rec[names[i]]);
                $("#"+names[i]+"_error").show();
               $("#"+names[i]+"_message").text(rec[names[i]][0]);
                $("#"+names[i]).addClass('validation_error');
                }  
           }else {
               Swal.fire(
               'Failed!',
               data.message,
               'error'
               );
           }
       })
 
}
</script>
@endsection