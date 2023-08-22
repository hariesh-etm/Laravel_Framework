@extends('admin.main')
 
@section('content')

<button class="btn btn-primary" onclick="pay()">pay 10</button>
<script src="<?=url('/')?>/assets/js/jquery/jquery-3.6.1.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    // email : maragathamsvga@gmail.com
    // pasword : 1Etmpro@2525
    function pay(){
       
                        var order_id = "123";
                        var payment_id = "<?php echo $payment_id;?>";
                        var amount = 10;
                        var address = "";
                        var total_amount = (amount * 100).toFixed(2);
                        var options = {
                            "key": "{{ env('RAZORPAY_KEY') }}", // Enter the Key ID generated from the Dashboard
                            "amount": total_amount, // Amount is in currency subunits. Default currency is INR. Hence, 10 refers to 1000 paise
                            "currency": $('#amtcurrency').val(),
                            "name": "Workahr",
                            "description": "Purchase Payment",
                            "image": "https://www.workahr.com/homeassets/images/workahr-nav-logo.png",
                            "order_id": payment_id, //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                            "handler": function (response){
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                               window.location.href = "<?php echo url('/');?>/razorpay";
                            },
                            "prefill": {
                                "name": "test",
                                "email": "test@mail.cp,",
                                "contact": "1234567890"
                            },
                            "notes": {
                                "address": address,
                                "merchant_order_id":order_id
                            },
                            "theme": {
                                "color": "#F37254"
                            }
                        };
                        var rzp1 = new Razorpay(options);
                        rzp1.open();
                                                                                                        
    }



</script>

@endsection