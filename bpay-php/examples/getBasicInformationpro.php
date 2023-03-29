<?php

require_once('../src/BpayCurlRequest.php');
require_once '../src/BpayAPIPRO.php';

/** Scenario: Retrieve transaction and user balance information.**/

// Create a new API wrapper instance
$Bpay = new BpayAPIPRO;

// get an transaction information

// Enter transaction id
$id = "";

// Make call to API to get info
try {
    $reQuest = $Bpay->getTransactionInfo($id);
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
    exit();
}

// get an transaction status

// Enter transaction id
$id = "";

// Make call to API to get status
try {
    $reQuest = $Bpay->getTransactionStatus($id);
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
    exit();
}

// get user available balance

// Make call to API to get balance
try {
    $reQuest = $Bpay->getBalance();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
    exit();
}
