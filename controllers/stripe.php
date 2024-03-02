<?php 
    include "../models/db.php";  
    require_once "stripe-php-master/init.php";

    // get a Secret key stripe from database
    $db = new Db();
    $stripe_data = $db->selectDb("SELECT * FROM stripe_account")->fetch(PDO::FETCH_OBJ);
    if ($stripe_data) {                                                      
       $secret_key = $stripe_data->secret_key;                                                
    }
 
    $stripe = new \Stripe\StripeClient($secret_key);
 
    try
    {
        $payment = $stripe->paymentIntents->retrieve(
            $_POST["payment_id"],
            []
        );
 
        if ($payment->status == "succeeded")
        {
            echo json_encode([
                "status" => "success",
                "payment" => $payment,
            ]);
            exit();
        }
    }
    catch (\Exception $exp)
    {
        echo json_encode([
            "status" => "error",
            "message" => $exp->getMessage()
        ]);
        exit();
    }