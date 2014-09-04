<?php

/**
 *  Class file to provide core
 *  functions for API Calls
 * 
 *  i.e. 
 *  Curl requests
 *  Handling SOAP Calls
 *  Handling XML Responses
 *  Handling JSON Responses
 *  
 * @author Hardik Shah<hardiks059@gmail.com>
 * @since September 3, 2014
 * @version 1.0
 * 
 * 
 */
class apiCore {

    public $apiURL = "";
    public $apiEndpoint = "";

    public function doCall($url, $params = array(), $method = 'GET') {
        $ch = curl_init();
        $timeout = 5;

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0');

        if ($method == 'PUT') {
            $putString= http_build_query($params, '', '&');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $putString);
        }

        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    public function prepareApiUrl() {
        $params = array();
        foreach ($this->params as $option => $value) {
            $params[] = "{$option}=" . urlencode($value);
        }
        return $this->apiURL . $this->apiEndpoint . "?" . (implode("&", $params));
    }

}

?>
