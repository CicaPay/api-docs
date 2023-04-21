<?php

require_once('../src/CicaPayCurlRequest.php');
require_once '../src/CicaPayAPIPRO.php';

/** Scenario: Create pay in transaction. **/

// Create a new API wrapper instance
$CicaPay = new CicaPayAPIPRO;

// Enter the the order amount
$amount = 65000000; // amount in currency1

// Enter the currency1
$currency1 = "XOF"; // order amount currency

// Enter the currency2
$currency2 = "bcoin"; // The currency the buyer will send

// Enter the customer email
$buyer_email = "support@cicapay.com";

// Enter the transaction description 
$description = "Achat de Matériaux";

// Make call to API to create the transaction
try {
    $reQuest = $CicaPay->payInCrypto($amount, $currency1, $currency2, $buyer_email, $description);
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
