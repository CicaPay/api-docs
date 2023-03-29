<?php

require_once('../src/BpayCurlRequest.php');
require_once '../src/BpayAPIPRO.php';

/** Scenario: Create pay in transaction. **/

// Create a new API wrapper instance
$Bpay = new BpayAPIPRO;

// Enter the customer phone number
$mobile_money_number = 65000000; // customer phone number to perform pay in request

// Enter the transaction network 
$network = "moov_bj"; // check our website for supported network

// Enter the transaction description 
$description = "Achat de Matériaux";

// Enter the customer first_name 
$first_name = "paul";

// Enter the customer last_name
$last_name = "leriche";

// Enter the customer email
$email = "info@bpay.com";

// set the user company name ( is not required , you can leave an empty like : $customer_company = "")
$customer_company = "BTO SA";

// array for user order. For each product or service
// set name, unit_price, quantity

$order = array(
    [
        'name' => 'moulin A',
        'unit_price' => 10,
        'quantity' => 200
    ],
    [
        'name' => 'moulin A',
        'unit_price' => 100,
        'quantity' => 20
    ],
    [
        'name' => 'moulin A',
        'unit_price' => 100,
        'quantity' => 200
    ]
);

// Make call to API to create the transaction
try {
    $reQuest = $Bpay->payIn($mobile_money_number, $network, $description, $first_name, $last_name, $email, $customer_company, $order);
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
