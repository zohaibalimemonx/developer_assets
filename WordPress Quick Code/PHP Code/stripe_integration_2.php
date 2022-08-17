<?php 

// Payment integration:

/* > > > RESPONSE 1 < < < */
$data1 = array(
    'number' => $_POST['stripe_card'],
    'exp_month' => $_POST['stripe_month'],
    'exp_year' => $_POST['stripe_year'],
    'cvc' => $_POST['stripe_cvc'],
);

$response1 = generate_token($data1);
if( !$response1['status'] )
{
    $ajax['status']     = false;
    $ajax['message']    = $response1['error'];
        
    print(json_encode($ajax));
    exit();
}

/* > > > RESPONSE 2 < < < */

$data2 = array(
    'email' => $_POST['email'],
    'stripeToken' => $response1['token'],
    'amount' => 25
);

$response2 = stripe_payment_gateway($data2, false);
if( !$response2['status'] )
{
    $ajax['status']     = false;
    $ajax['message']    = $response2['error'];
    
    print(json_encode($ajax));
    exit();
}

// Stripe Receipt
add_user_meta(USER_ID_HERE, 'stripe_payement_id', $response2['stripe_charge']);