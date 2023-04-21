<?php

require_once('../src/CicaPayCurlRequest.php');
require_once '../src/CicaPayAPI.php';

/** Scenario: Create pay in transaction. **/

// Create a new API wrapper instance
$CicaPay = new CicaPayAPI;

// Enter the transaction description 
$description = "achat de matériaux";

// set the success url ( where the user will be redirect after successfuly payment)
$success_url = "https://cicapay.com/success";

// set the cancel url ( where the user will be redirect after failed payment)
$cancel_url = "https://cicapay.com/failed";

// set the meTa data ( you will need this to check transaction status)
// rand letter and number ( max lenght : 20, uppurcase)
$meTa = "52MPKNSXE7";

// set the payWith ( payment method )
$payWith = "fiat";

// set the currency ( order currency )
$currency = "EUR";


// array for user order. For each product or service
// set name, unit_price, quantity
$order = array(
    [
        'name' => 'Pneu',
        'unit_price' => 1,
        'quantity' => 1
    ],
    [
        'name' => 'Par brise',
        'unit_price' => 1,
        'quantity' => 2
    ],
    [
        'name' => 'Volant',
        'unit_price' => 1,
        'quantity' => 2
    ]
);

// Make call to API to create the transaction
try {
    $reQuest = $CicaPay->payIn($description, $success_url, $cancel_url, $meTa, $payWith, $currency, $order);
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
