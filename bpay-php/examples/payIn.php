<?php

require_once('../src/BpayCurlRequest.php');
require_once '../src/BpayAPI.php';

/** Scenario: Create pay in transaction. **/

// Create a new API wrapper instance
$Bpay = new BpayAPI;

// Enter the transaction description 
$description = "achat de matériaux";

// set the success url ( where the user will be redirect after successfuly payment)
$success_url = "https://bpay.bryocorp.com";

// set the cancel url ( where the user will be redirect after failed payment)
$cancel_url = "https://bpay.bryocorp.com";

// set the meTa data ( you will need this to check transaction status)
// rand letter and number ( max lenght : 20, uppurcase)
$meTa = "52MPKNSXE7";

// set the payment method . we support two mode actually : "fiat" and "crypto"
$payWith = "crypto";

// set the order amount currency
// bpay make conversion for crypto payment only, you should make your own conversion if you want to use fiat method.
// for fiat method, we use only "XOF" for now
$currency = "XOF";

// array for user order. For each product or service
// set name, unit_price, quantity
$order = array(
    [
        'name' => 'Pneu',
        'unit_price' => 100,
        'quantity' => 10
    ],
    [
        'name' => 'Par brise',
        'unit_price' => 1000,
        'quantity' => 25
    ],
    [
        'name' => 'Volant',
        'unit_price' => 160,
        'quantity' => 29
    ]
);

// Make call to API to create the transaction
try {
    $reQuest = $Bpay->payIn($description, $success_url, $cancel_url, $meTa, $payWith, $currency, $order);
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
    exit();
}

// Output the response of the API call
if (!isset($reQuest->error)) {
    var_dump($reQuest); // output payment process page to the customer
} else {
    // Throw an error if both API calls were not successful
    echo 'There was an error returned by the API call: ' . $reQuest->error;
}
