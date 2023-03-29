<?php

class BpayCurlRequest
{
    private $apikey = '';
    private $mode = '';

    public function __construct($apikey, $mode)
    {
        if(!empty($apikey) && !empty($mode))
        {
            $this->apikey = $apikey;
            $this->mode = $mode;
        }else{
            echo "Please Set API KEY and MODE";
        }
        
    }

    public function callRoute(string $url, array $data)
    {

        $outData = curl_init($url);

        $payload = json_encode($data);

        curl_setopt($outData, CURLOPT_POSTFIELDS, $payload);

        curl_setopt($outData, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

        curl_setopt($outData, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($outData, CURLOPT_FOLLOWLOCATION, true);

        $result = curl_exec($outData);

        return $result;
    }

    public function getRoute(string $request, string $id)
    {
        $cResource = curl_init();

        curl_setopt($cResource, CURLOPT_URL, "https://bpay.bryocorp.com/e_merchant/$this->mode/$request/$this->apikey/$id");

        curl_setopt($cResource, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($cResource, CURLOPT_FOLLOWLOCATION, true);

        $data = curl_exec($cResource);
        $dataReadable = json_decode($data);

        curl_close($cResource);

        return $dataReadable;
    }

    public function getRouteB()
    {
        $request = "check_balance";
        $cResource = curl_init();

        curl_setopt($cResource, CURLOPT_URL, "https://bpay.bryocorp.com/e_merchant_own/$this->mode/$request/$this->apikey");

        curl_setopt($cResource, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($cResource, CURLOPT_FOLLOWLOCATION, true);

        $data = curl_exec($cResource);
        $dataReadable = json_decode($data);

        curl_close($cResource);

        return $dataReadable;
    }

    public function getRouteC(string $request, string $id)
    {
        $cResource = curl_init();

        curl_setopt($cResource, CURLOPT_URL, "https://bpay.bryocorp.com/e_merchant_own/$this->mode/$request/$this->apikey/$id");

        curl_setopt($cResource, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($cResource, CURLOPT_FOLLOWLOCATION, true);

        $data = curl_exec($cResource);
        $dataReadable = json_decode($data);

        curl_close($cResource);

        return $dataReadable;
    }
}