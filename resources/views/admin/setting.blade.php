@extends('admin.main')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row p-3">
            <div class="col-12">
                <div>
                    <p class="mb-0">Setting</p>
                    <h4>Payment Gateway Settings</h4>
                    
                </div>
            </div>
        </div>
        <form action="#" id="form" method="POST">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div> 
                                    <b>Razorpay </b>
                                </div>
                                <div> 
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="razorpaycheck" name="razorpaycheck" value="1"<?php if($razorpay_option == "1"){ echo "checked";}?> >
                                      </div>
                                </div>
                            </div>
                            <input type="hidden" id="id" name="id" value="<?=$id?>"/>
                          
                {{-- <div class="mb-3">
                <label class="form-label">Type <span class="text-danger">*</span></label> 
                <select type="text" name="type" class="form-select" id="type" required onchange="showpaymenttype()">
                <option value="">Select option</option>
                <option value="Razorpay" <?php if($type == "Razorpay"){ echo "selected"; }?>>Razorpay</option>
                <option value="Stripe" <?php if($type == "Stripe"){ echo "selected"; }?>>Stripe</option>
                <option value="Paypal" <?php if($type == "Paypal"){ echo "selected"; }?>>Paypal</option>
                </select>
              </div> --}}
              <div id="razorpay_show" >
             <div class="mb-3">
                <label class="form-label">Razorpay Key</label> 
                <input type="text" name="razorpay_key" class="form-control" placeholder="Enter razorpay key" id="razorpay_key" value="<?=$razorpay_key?>">
              </div>
             <div class="mb-3">
                <label class="form-label">Razorpay Secret </label> 
                <input type="text" name="razorpay_secret" class="form-control" placeholder="Enter razorpay secret" id="razorpay_secret" value="<?=$razorpay_secret?>">
              </div>
              </div>
              <div id="stripe_show" <?php if($type != "Stripe"){?> style="display:none;" <?php } ?> >
            
              </div>
              <div id="paypal_show" <?php if($type != "Paypal"){?> style="display:none;" <?php } ?> >
            
              </div>
             
                           
                       
                    </div>
                </div> <!-- end card -->
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div> 
                                <b>Stripe</b>
                            </div>
                            <div> 
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="stripecheck" name="stripecheck" value="1"<?php if($stripe_option == "1"){ echo "checked";}?> >
                                  </div>
                            </div>
                        </div>
                       
                        <div class="mb-3">
                            <label class="form-label">Stripe Key </label> 
                            <input type="text" name="stripe_key" class="form-control" placeholder="Enter stripe key" id="stripe_key" value="<?=$stripe_key?>">
                          </div>
                         <div class="mb-3">
                            <label class="form-label">Stripe Secret </label> 
                            <input type="text" name="stripe_secret" class="form-control" placeholder="Enter stripe secret" id="stripe_secret" value="<?=$stripe_secret?>">
                          </div>
                    </div>
                </div>
            </div>
            <div class="col-6 pt-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div> 
                                <b>Paypal</b>
                            </div>
                            <div> 
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="paypalcheck" name="paypalcheck" value="1"<?php if($paypal_option == "1"){ echo "checked";}?> >
                                  </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Paypal Client ID </label> 
                            <input type="text" name="paypal_client_id" class="form-control" placeholder="Enter paypal client id" id="paypal_client_id" value="<?=$paypal_client_id?>" >
                          </div>
                         <div class="mb-3">
                            <label class="form-label">Paypal Secret</label> 
                            <input type="text" name="paypal_secret" class="form-control" placeholder="Enter paypal secret" id="paypal_secret" value="<?=$paypal_secret?>">
                          </div>
                       
                    </div>
                </div>
            </div>
            <br>
            <div class="text-center pt-3">
                <button class="btn btn-primary" id="save_button" type="submit">Submit</button>
                <button type="button" style="display:none;" id="save_button_loading" class="btn">Storing the data please wait ...</button>
            </div>
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
 var url = '<?php echo url('/');?>/api/v1/updatesetting';
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
