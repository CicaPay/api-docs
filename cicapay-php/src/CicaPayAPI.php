<?php

class CicaPayAPI
{
    /**
     * Add your API Key From cicapay.com
     * Set The "Mode", Request Environment
     */
    private $apikey = "85f9b64152d53b56556109f5000afc3c14dd32915297cf51"; // live
    //private $apikey = "338b3f59da3616713e362b9dced27bb4fe9eefa9ecf5f380"; // test
    private $mode = "live";  // "test" or "live"
    private $request_handler;

    public function __construct()
    {
        // Initiate a cURL request object
        $this->request_handler = new CicaPayCurlRequest($this->apikey, $this->mode);
    }


    private function payS(string $description, string $success_url, string $cancel_url, string $meTa, string $payWith, string $currency, array $order)
    {
        // Define the API url
        $api_url = "https://cicapay.com/e_merchant/$this->mode/pay_in1/$this->apikey";

        $data = array(
            'description' => $description,
            'success_url' => $success_url,
            'cancel_url' => $cancel_url,
            'order' => $order,
            'meTa' => $meTa,
            'payWith' => $payWith,
            'currency' => $currency
        );

        return $this->request_handler->callRoute($api_url, $data);
    }

    private function paySt(string $trans_id, string $description, string $success_url, string $cancel_url, string $payWith, string $currency, array $order)
    {
        // Define the API url
        $api_url = "https://cicapay.com/e_merchant/$this->mode/pay_in2/$this->apikey";

        $data = array(
            'trans_id' => $trans_id,
            'description' => $description,
            'success_url' => $success_url,
            'cancel_url' => $cancel_url,
            'order' => $order,
            'payWith' => $payWith,
            'currency' => $currency
        );

        return $this->request_handler->callRoute($api_url, $data);
    }

    /**
     * payIn
     *
     * Call payIn "Customer to Merchant".
     * 
     * @param  string $description
     * @param  string $success_url
     * @param  string $cancel_url
     * @param  string $meTa (Max Lengh: 20)
     * @param  array $order
     * 
     * @return payment page to customer
     * 
     * @throws Exception
     */
    public function payIn(string $description, string $success_url, string $cancel_url, string $meTa, string $payWith, string $currency, array $order)
    {
        $resA = $this->payS($description, $success_url, $cancel_url, $meTa, $payWith, $currency, $order);

        if ($this->isError($resA)) {

            return json_decode($resA);

            exit;
        }

        $resA = json_decode($resA);

        $transactionId =  $resA->transaction_id;

        if ($transactionId != null) {

            $resB = $this->paySt($transactionId, $description, $success_url, $cancel_url, $payWith, $currency, $order);

            echo $resB;
        }
    }


    private function pay_out_request(string $network, int $number, int $amount, string $first_name, string $last_name, string $email)
    {
        // Define the API url
        $api_url = "https://cicapay.com/e_merchant_own/$this->mode/pay_out/$this->apikey";

        $data = array(
            'mobile_money_number' => $number,
            'amount' => $amount,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'network' => $network
        );

        return $this->request_handler->callRoute($api_url, $data);
    }

    /**
     * payOut
     *
     * Call payOut "Merchant to Customer".
     * 
     * @param  string $network
     * @param  int $number
     * @param  int $amount
     * @param  string $first_name
     * @param  string $last_name
     * @param  string $email
     * 
     * @return array|object
     * Successful result includes the following values (sample):
     *      - status "EXCECUTED"
     *      - transaction_id "BP123456789"
     * 
     * @throws Exception
     */
    public function payOut(string $network, int $number, int $amount, string $first_name, string $last_name, string $email)
    {

        $res = $this->pay_out_request($network, $number, $amount, $first_name, $last_name, $email);

        if ($this->isError($res)) {

            return json_decode($res);

            exit;
        }

        $res = json_decode($res);

        return $res;
    }

    /**
     * getTransactionInfo
     *
     * @param  string $id your meTa data
     * 
     * @return array|object
     * Successful result includes the following values (sample):
     *      - transactionID
     *      - phoneNumber
     *      - amount
     *      - fee
     *      - description
     *      - status
     *      - created_at
     *      - statued_at
     *      - first_name
     *      - last_name
     *      - email
     *      - meTa
     * 
     * @throws Exception
     */
    public function getTransactionInfo(string $id)
    {
        $res = $this->request_handler->getRoute("get_transaction_info", $id);

        return $res;
    }

    /**
     * getTransactionStatus
     *
     * @param  string $id your meTa data
     * 
     * @return array|object
     * Successful result includes the following values (sample):
     *      - status "EXCECUTED"
     * 
     * @throws Exception
     */
    public function getTransactionStatus(string $id)
    {
        $res = $this->request_handler->getRoute("check_transaction_status", $id);

        return $res;
    }

    /**
     * getBalance
     *
     * @return array|object
     * Successful result includes the following values (sample):
     *      - availableBalance "5000000000"
     *      
     * @throws Exception
     */
    public function getBalance()
    {
        $res = $this->request_handler->getRouteB();

        return $res;
    }


    private function isError($quest)
    {
        $quest = json_decode($quest);

        if (isset($quest->error) && $quest->error != "") {
            return true;
        }
    }

}
