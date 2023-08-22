@extends('admin.main')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row p-3">
            <div class="col-12">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <h4>Email Gateway Settings</h4>
                    <div class="page-title-right">
                   
                    </div>
                </div>
            </div>
        </div>
        <form action="#" id="form" method="POST">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                            
            
             <div class="mb-3">
                <label class="form-label">Zepto Mail Url</label> 
                <input type="text" name="zepto_mail_url" class="form-control" placeholder="Enter url" id="zepto_mail_url" value="<?=$zepto_mail_url?>">
              </div>
             <div class="mb-3">
                <label class="form-label">Zepto Key</label> 
                <input type="text" name="zepto_mail_key" class="form-control" placeholder="Enter key" id="zepto_mail_key" value="<?=$zepto_mail_key?>">
              </div>
              <div class="mb-3">
                <label class="form-label">Zepto From Mail</label> 
                <input type="text" name="zepto_from_mail" class="form-control" placeholder="Enter from mail" id="zepto_from_mail" value="<?=$zepto_from_mail?>">
              </div>
              <div class="mb-3">
                <label class="form-label">Zepto Name</label> 
                <input type="text" name="zepto_mail_name" class="form-control" placeholder="Enter name" id="zepto_mail_name" value="<?=$zepto_mail_name?>">
              </div>
              <div class="mb-3">
                <label class="form-label">Zepto Bonce Mail</label> 
                <input type="text" name="zepto_mail_bounce_address" class="form-control" placeholder="Enter bounce address" id="zepto_mail_bounce_address" value="<?=$zepto_mail_bounce_address?>">
              </div>
              
              <div class="text-center pt-3">
                <button class="btn btn-primary" id="save_button" type="submit">Submit</button>
                <button type="button" style="display:none;" id="save_button_loading" class="btn">Storing the data please wait ...</button>
            </div>
                   
                    </div>
                </div> <!-- end card -->
            </div>
           
         
            <br>
           
        </div>
    </form>
    </div>
</div>
<script src="<?=url('/')?>/assets/datatable/js/jquery-3.4.1.min.js"></script>
<script src="<?php echo url('/');?>/assets/datatable/js/sweetalert2@11.js"></script>
<script type="text/javascript">
window.onload = function(){
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
     }else if(updateform[i].name == "razorpaycheck"){
        if($('#razorpaycheck').is(':checked')){
            formData.append("razorpay_option", "1");
        }else{
            formData.append("razorpay_option", "0");
        }
     }else if(updateform[i].name == "stripecheck"){
        if($('#stripecheck').is(':checked')){
            formData.append("stripe_option", "1");
        }else{
            formData.append("stripe_option", "0");
        }
     }else if(updateform[i].name == "paypalcheck"){
        if($('#paypalcheck').is(':checked')){
            formData.append("paypal_option", "1");
        }else{
            formData.append("paypal_option", "0");
        }
     }else{
       formData.append(updateform[i].name, updateform[i].value);
     }
 }
 var url = '<?php echo url('/');?>/api/v1/updateemailsetting';
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
            title: 'Setting Updated Successfully',
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
            }).then((result) => {
            if (result.isConfirmed) {
                location.reload();
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
           function showpaymenttype(){
            var type = $("#type").val();
            if(type == "Razorpay"){
                $("#razorpay_show").show();
                $("#stripe_show").hide();
                $("#paypal_show").hide();
            }else if(type == "Stripe"){
                $("#razorpay_show").hide();
                $("#stripe_show").show();
                $("#paypal_show").hide();
            }else if(type == "Paypal"){
                $("#razorpay_show").hide();
                $("#stripe_show").hide();
                $("#paypal_show").show();
            }else{
                $("#razorpay_show").hide();
                $("#stripe_show").hide();
                $("#paypal_show").hide();
            }
           }
               </script>
@endsection
