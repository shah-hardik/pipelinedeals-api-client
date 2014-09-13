<?php

//error_reporting(E_ALL);
include_once "config.php";
include "apiPipe.class.php";
ob_start();

$apiPipe = new apiPipe();
if (!isset($_REQUEST['page_no']) || $_REQUEST['page_no'] == '') {
    $_REQUEST['page_no'] = 1;
}

echo "---STOP----";
die;

$apiPipe->params['page'] = trim($_REQUEST['page_no']);
$response = $apiPipe->getDeals();
$res = json_decode($response, true);
$allow_to_next_page = 0;
if (!empty($res)) {
    foreach ($res['entries'] as $each_res):
        if (!empty($each_res)) {
            $deal_id = '';
            $deal_data = '';
            $deal_id = $each_res['id'] . "<br/>";
            $deal_data = json_encode($each_res);

            if ($deal_id != '') {
                $fields['deal_id'] = $deal_id;
                $fields['deal_data'] = $deal_data;
                $fields = _escapeArray($fields);
                echo "Insert Deal - " . $inserted_id = qi("deals", $fields);
                echo "<br/>";
            }
            $allow_to_next_page = 1;
        }
    endforeach;
}
if ($allow_to_next_page == 1) {
    $next_page = ($_REQUEST['page_no'] + 1);
    header('location:http://localhost/pipelinedeals-api-client/report.php?page_no=' . $next_page);
    die;
}
?>