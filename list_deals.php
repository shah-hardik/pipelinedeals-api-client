<?php

//error_reporting(E_ALL);
include_once "config.php";
include "apiPipe.class.php";
ob_start();

$apiPipe = new apiPipe();
$today_date = date('Y-m-d');
$start_date = date('Y-m-d', strtotime("-7 days", strtotime($today_date)));
$end_date = date('Y-m-d', strtotime("-1 day"));

$apiPipe->params['conditions[deal_created][from_date]'] = date("Y-m-d", strtotime("-7 days"));
$deals = $apiPipe->getDeals();
$deals = json_decode($deals, true);
$deals = $deals['entries'];
if (!empty($deals)) {
    foreach ($deals as $each_deal):
        //if ($each_deal['id'] == '6690468') {
        $res = ConvertArray($each_deal);
        echo "=========Start ID = " . $each_deal['id'] . "==========<br/><br/>";
        echo "Company = " . $res['company']['name'] . "<br/>";
        echo "Amount = " . $res['value'] . "<br/>";
        echo "Expected Close = " . $res['expected_close_date'] . "<br/>";
        echo "Age = " . (intval((strtotime(date('Y-m-d')) - strtotime(date('Y-m-d', strtotime($res['created_at'])))) / (60 * 60 * 24))) . " days" . "<br/>";
        echo "Owner = " . $res['user']['first_name'] . " " . $res['user']['last_name'] . "<br/>";
        echo "Status = " . $res['status'] . "<br/>";
        echo "Source = " . $res['source']['name'] . "<br/>";
        echo "Stage = " . $res['deal_stage']['name'] . "<br/>";
        echo "Probability = " . $res['deal_stage']['percent'] . "%<br/>";
        if (!empty($res['custom_fields'])) {
            foreach ($res['custom_fields'] as $custom_key => $custom_val):
                echo $custom_key . " = " . $custom_val . "<br/>";
            endforeach;
            echo "<br/>";
        }
        echo "Date last updated = " . date('Y-m-d H:i:s', strtotime($res['updated_at'])) . "<br/>";
        echo "=========End ID = " . $each_deal['id'] . "==========<br/><br/><br/><br/>";
    //}
    endforeach;
}

function ConvertArray($array) {
    foreach ($array as $key => $each_array):
        if ($key == 'custom_fields') {
            $each_array = CustomFieldsLabel($each_array);
        }
        $res[$key] = $each_array;
    endforeach;
    return $res;
}

function CustomFieldsLabel($array) {
    include 'custom_fields_label.php';
    foreach ($array as $key => $each_array):
        $key = $custom_field_label[$key];
        if (is_array($each_array)) {
            $each_array = implode(",", $each_array);
        }
        $custum_array[$key] = $each_array;
    endforeach;
    return $custum_array;
}
?>