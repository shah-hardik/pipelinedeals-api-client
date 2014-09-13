<?php

/**
 * 
 * API Client for the piplinedeals
 * 
 * @author Hardik Shah<hardiks059@gmail.com>
 * @since September 3, 2014
 * @version 1.0
 * 
 */
include "apiCore.class.php";

class apiPipe extends apiCore {

    public $params = array();
    public $key = "NsxeQPzWzysiYbTa3Scd";

    public function __construct() {
        $this->params['api_key'] = $this->key;
        $this->apiURL = "https://api.pipelinedeals.com/api/v3/";
    }

    public function getDeal($id) {
        $deal_id = "/{$id}.json";
        $this->apiEndpoint = "deals{$deal_id}";
        $url = $this->prepareApiUrl();
        $data = $this->doCall($url);
        return $data;
    }

    public function getDeals() {
        $this->apiEndpoint = "deals";
        $url = $this->prepareApiUrl();

        $data = $this->doCall($url);
        return $data;
    }

    public function updateDeals($data, $index) {
        $this->apiEndpoint = "deals/{$index}.json";
        $url = $this->prepareApiUrl();
        $data = $this->doCall($url, $data, 'PUT');
        return $data;
    }

}
?>