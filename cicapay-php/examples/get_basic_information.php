<?php

require_once('../src/CicaPayCurlRequest.php');
require_once '../src/CicaPayAPI.php';

/** Scenario: Retrieve transaction and user balance information.**/

// Create a new API wrapper instance
$CicaPay = new CicaPayAPI;

// get an transaction information

// Enter your meTa data
$id = "";

// Make call to API to get info
try {
    $reQuest = $CicaPay->getTransactionInfo($id);
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
    exit();
}

// get an transaction status

// Enter your meTa data
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