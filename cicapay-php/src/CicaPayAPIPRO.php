<?php

class CicaPayAPIPRO
{
    /**
     * Add your API Key From cicapay.com
     * Set The "Mode", Request Environment
     */
    //private $apikey = "85f9b64152d53b56556109f5000afc3c14dd32915297cf51"; // live
    private $apikey = "338b3f59da3616713e362b9dced27bb4fe9eefa9ecf5f380"; // test
    private $mode = "test"; // "test" or "live"
    private $request_handler;

    public function __construct()
    {
        // Initiate a cURL request object
        $this->request_handler = new CicaPayCurlRequest($this->apikey, $this->mode);
    }

    /**
     * payIn
     *
     * Call payIn "Customer to Merchant".
     * 
     * @param  int $mobile_money_number
     * @param  string $network
     * @param  string $description
     * @param  string $first_name
     * @param  string $last_name
     * @param  string $email
     * @param  string $customer_company
     * @param  array $order
     * 
     * @return array|object
     * Successful result includes the following values (sample):
     *      - status "EXCECUTED"
     *      - transaction_id "BP123456789"
     * 
     * @throws Exception
     */
    public function payIn(int $mobile_money_number, string $network, string $description, string $first_name, string $last_name, string $email, string $customer_company, array $order)
    {
        // Define the API url
        $api_url = "https://cicapay.com/e_merchant_own/$this->mode/pay_in/$this->apikey";
        
        $data = array(
            'network' => $network,
            'description' => $description,
            'mobile_money_number' => $mobile_money_number,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'customer_company' => $customer_company,
            'order' => $order,
        );
        
        return json_decode($this->request_handler->callRoute($api_url, $data));
    }

        
    /**
     * payInCrypto
     *
     * @param  float $amount
     * @param  string $currency1
     * @param  string $currency2
     * @param  string $buyer_email
     * @param  string $description
     * 
     * @return array|object
     * 
     * Successful result includes the following values (sample):
     *      - error 
     *      - address
     *      - amount 
     *      - network
     *      - transaction_id 
     *      - timeout
     *      - ipn_secure 
     */
    public function payInCrypto(float $amount, string $currency1, string $currency2, string $buyer_email, string $description)
    {
        // Define the API url
        $api_url = "https://cicapay.com/e_merchant_crypto/$this->mode/pay_in/$this->apikey";
        
        $data = array(
            'currency1' => $currency1,
            'currency2' => $currency2,
            'amount' => $amount,
            'buyer_email' => $buyer_email,
            'description' => $description
        );
        
        return json_decode($this->request_handler->callRoute($api_url, $data));
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
     * @param  string $id
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
     * 
     * @throws Exception
     */

    public function getTransactionInfo(string $id)
    {
        $res = $this->request_handler->getRouteC("get_transaction_info", $id);

        return $res;
    }

    /**
     * getTransactionStatus
     *
     * @param  string $id
     * 
     * @return array|object
     * Successful result includes the following values (sample):
     *      - status "EXCECUTED"
     * 
     * @throws Exception
     */
    public function getTransactionStatus(string $id)
    {
        $res = $this->request_handler->getRouteC("check_transaction_status", $id);

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
