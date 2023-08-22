@extends('admin.main')
@section('content')
<button class="btn btn-primary" onclick="pay()">pay 10</button>
<script src="<?=url('/')?>/assets/js/jquery/jquery-3.6.1.min.js"></script>
<script src="https://js.stripe.com/v3/"></script>
<script>
    // email : srajhan@gmail.com
    // pasword : Etm@123456
    function pay(){
        const stripe = Stripe("<?php echo $stripe_key;?>"); // test
        createCheckoutSession().then(function (data) {
                if(data.sessionId){
                    stripe.redirectToCheckout({
                        sessionId: data.sessionId,
                    }).then(handleResult);
                }else{
                    handleResult(data);
                }
            });
    }
 const createCheckoutSession = function (stripe) {
        var productname = "test";
        var newurl = "<?=url('/')?>/stripe";
        var price = "10";
        var order_id = Math.floor((Math.random() * 1000) + 1);
        return fetch("<?=url('/')?>/api/v1/stripepayment", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify({
                            createCheckoutSession: 1,
                            price:price,
                            currency:"inr",
                            productname:productname,
                            url:newurl,
                            order_id:order_id
                        }),
                    }).then(function (result) {
                        return result.json();
                    });
};
// Handle any errors returned from Checkout
const handleResult = function (result) {
    if (result.error) {
        showMessage(result.error.message);
    }
};
// Display message
function showMessage(messageText) {
    const messageContainer = document.querySelector("#paymentResponse");
    messageContainer.classList.remove("hidden");
    messageContainer.textContent = messageText;
    setTimeout(function () {
        messageContainer.classList.add("hidden");
        messageText.textContent = "";
    }, 5000);
}
</script>
@endsection
