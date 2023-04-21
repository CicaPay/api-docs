<?php

require_once('../src/CicaPayCurlRequest.php');
require_once '../src/CicaPayAPIPRO.php';

/** Scenario: Retrieve transaction and user balance information.**/

// Create a new API wrapper instance
$CicaPay = new CicaPayAPIPRO;

// get an transaction information

// Enter transaction id
$id = "";

// Make call to API to get info
try {
    $reQuest = $CicaPay->getTransactionInfo($id);
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
    exit();
}

// get an transaction status

// Enter transaction id
$id = "";

// Make call to API to get status
try {
    $reQuest = $CicaPay->getTransactionStatus($id);
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
    exit();
}

// get user available balance

// Make call to API to get balance
try {
    $reQuest = $CicaPay->getBalance();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
    exit();
}