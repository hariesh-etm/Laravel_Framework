<?php 

ini_set('display_errors',1);
error_reporting(E_ALL);
$input = file_get_contents('php://input');
$_POST = json_decode($input); 

if($_POST->price) {

    require_once('../vendor/autoload.php');

$productName = $_POST->productname;  
$productID = "DP12345"; 
$productPrice = $_POST->price; 
$currency = $_POST->currency; 
$order_id = $_POST->order_id;
define('STRIPE_SUCCESS_URL', $_POST->url); //Payment success URL 
define('STRIPE_CANCEL_URL', $_POST->url);
// Set API key 
$stripe = new \Stripe\StripeClient('sk_test_51LZZU2D948ccqB2ZBV6HtQtItGak18HSIKKfJ53Bvyja9X2MCxXWF7NRmI2KCaNY4ZNmg0O11fpHkeUMYyGw87Ch00tbUICwL4');  // live
$response = array( 
    'status' => 0, 
    'error' => array( 
        'message' => 'Invalid Request!'    
    ) 
); 
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    $input = file_get_contents('php://input'); 
    $request = json_decode($input);     
} 
if (json_last_error() !== JSON_ERROR_NONE) { 
    http_response_code(400); 
    echo json_encode($response); 
    exit; 
} 
 
if(!empty($request->createCheckoutSession)){ 
    // Convert product price to cent 
    $stripeAmount = round($productPrice*100, 2); 
    try { 
        $checkout_session = $stripe->checkout->sessions->create([ 
            'line_items' => [[ 
                'price_data' => [ 
                    'product_data' => [ 
                        'name' => $productName, 
                    ], 
                    'unit_amount' => $stripeAmount, 
                    'currency' => 'aed', 
                ], 
                'quantity' => 1 
            ]], 
            'mode' => 'payment', 
            'client_reference_id' => $order_id,
            'success_url' => STRIPE_SUCCESS_URL.'?session_id={CHECKOUT_SESSION_ID}', 
            'cancel_url' => STRIPE_CANCEL_URL, 
        ]); 
    } catch(Exception $e) {  
        $api_error = $e->getMessage();  
    } 
     
    if(empty($api_error) && $checkout_session){ 
        $response = array( 
            'status' => 1, 
            'message' => 'Checkout Session created successfully!', 
            'sessionId' => $checkout_session->id 
        ); 
    }else{ 
        $response = array( 
            'status' => 0, 
            'error' => array( 
                'message' => 'Checkout Session creation failed! '.$api_error    
            ) 
        ); 
    } 
} 
 
// Return response 
echo json_encode($response); 

}
?>