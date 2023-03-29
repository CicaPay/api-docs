<?php

require_once('../src/BpayCurlRequest.php');
require_once '../src/BpayAPI.php';

/** Scenario: Create pay out transaction. **/

// Create a new API wrapper instance
// You can use BpayAPI class or BpayAPIPRO class , is the same request
$Bpay = new BpayAPI;

// Enter the transaction network 
$network = "moov_bj"; // check our website for supported network

// Enter customer phone number who will receive the pay out 
$number = 65000000;

// Set transaction amount ( it will deducted from your merchant available balance)
$amount = 200;

// Enter the customer first_name
$first_name = "Rubain";

// Enter the customer last_name
$last_name = "Dofile";

// Enter the customer email
$email = "info@bpay.com";

// Make call to API to create the transaction
try {
    $reQuest = $Bpay->payOut($network, $number, $amount, $first_name, $last_name, $email);
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
    exit();
}


// Output the response of the API call
if (!isset($reQuest->error)) {
    var_dump($reQuest);
} else {
    // Throw an error if both API calls were not successful
    echo 'There was an error returned by the API call: ' . $reQuest->error;
}
