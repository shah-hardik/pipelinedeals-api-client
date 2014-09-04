<?php

/**
 * 
 * Pipelinedeal api client
 * 
 * @author Hardik Shah<hardiks059@gmail.com>
 * @since Sept 4, 2014
 * 
 */
include "apiPipe.class.php";

$lead_field = 'custom_label_984569';

$question_1 = "custom_label_984230";
$question_1_options = array('645767' => '0', '645768' => '1', '645769' => '2', '645770' => '3');

$question_2 = 'custom_label_984231';
$question_2_options = array('645771' => '0', '645772' => '1', '645773' => '2');

$question_3 = 'custom_label_984535';
$question_3_options = array('646567' => '0', '646568' => '1', '646569' => '2');

$question_4 = 'custom_label_984568';
$question_4_options = array('646729' => '0', '646730' => '1', '646731' => '2', '646732' => '3', '646733' => '4', '646734' => '5');


$apiPipe = new apiPipe();

$apiPipe->params['conditions[deal_created][from_date]'] = date("Y-m-d", strtotime("-1 Day"));
$deals = $apiPipe->getDeals();
$deals = json_decode($deals, true);

$dealsUpdated = "0";
foreach ($deals['entries'] as $each_deal) {
    $question_1_answer = $each_deal['custom_fields'][$question_1]['0'];
    $question_2_answer = $each_deal['custom_fields'][$question_2]['0'];
    $question_3_answer = $each_deal['custom_fields'][$question_3]['0'];
    $question_4_answer = $each_deal['custom_fields'][$question_4]['0'];

    $leadScore_1 = $question_1_options[$question_1_answer] ? $question_1_options[$question_1_answer] : "0";
    $leadScore_2 = $question_2_options[$question_2_answer] ? $question_2_options[$question_2_answer] : "0";
    $leadScore_3 = $question_3_options[$question_3_answer] ? $question_3_options[$question_3_answer] : "0";
    $leadScore_4 = $question_4_options[$question_4_answer] ? $question_4_options[$question_4_answer] : "0";

    $leadScore = $leadScore_1 + $leadScore_2 + $leadScore_3 + $leadScore_4;

    $lead_id = $each_deal['id'];
    $updateData = array();
    $updateData['deal']['custom_fields'][$lead_field] = $leadScore;
    $response = $apiPipe->updateDeals($updateData, $lead_id);
    $dealsUpdated++;
}

print "lead score update: {$dealsUpdated} ";
die;
?>