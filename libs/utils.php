<?php

/**
 * General Functions
 * 
 * 
 * @author Hardik Shah
 * @version 1.0
 * @package pipelinedeals
 * 
 */

/**
 * Function to check whether variable is set or not.
 * @param String $var
 * @return Boolean
 * 
 * @author Hardik Shah
 * @version 1.0
 * @package pipelinedeals
 * 
 */
function _set($var) {
    return isset($var) && $var ? true : false;
}

/**
 * Checks if variable is set or not. if
 * variable is not set, it will reutnr second arc
 * @param String $var
 * @param String $var
 * @return String $var
 * 
 * @author Hardik Shah
 * @version 1.0
 * @package pipelinedeals
 * 
 */
function _e(&$s, $a = null) {
    return !empty($s) ? $s : $a;
}

/**
 * function to escape string
 * 
 * @param String $string
 * @return String escaped string
 * @author Hardik Shah
 * @version 1.0
 * @package pipelinedeals
 */
function _escape($string) {
    $string = stripslashes($string);
    return mysql_real_escape_string(trim($string));
}

/**
 * Wrapper function for db insert query
 * 
 * @author Hardik Shah
 * @version 1.0
 * @package pipelinedeals
 */
function qi($table, $fields, $operation = 'INSERT') {
    $db = Db::__d();
    return $db->insert_query($table, $fields, $operation);
}

function qd($table, $condition) {
    $db = Db::__d();
    return $db->delete_query($table, $condition);
}

function q($query) {
    $db = Db::__d();
    return $db->format_data($db->query($query));
}

function qs($query) {
    $result = q($query);
    return $result[0];
}

/**
 * Wrapper function for db update query
 * 
 * @author Hardik Shah
 * @version 1.0
 * @package pipelinedeals
 */
function qu($table, $fields, $condition) {
    $db = Db::__d();
    return $db->update_query($table, $fields, $condition);
}

/**
 * Return date format that mysql likes YYYY-MM-DD H:I:S
 * 
 * @param String $timestamp optional unixtimestamp
 * @return String $date
 * 
 * @author Hardik Shah
 * @version 1.0
 * @package pipelinedeals
 */
function _mysqlDate($timestamp = 0) {
    $timestamp = $timestamp ? $timestamp : time();
    return date('Y-m-d H:i:s');
}

function lr($url) {
    return _U . $url;
}

function l($url) {
    print lr($url);
}

function d($arr, $hideStyle = "block") {
    if (is_array($arr) || is_object($arr)) {
        print "<pre style='display:{$hideStyle}'>" . "...";
        print_r($arr);
        print "</pre>";
    } else {
        print "<div class='debug' style='display:{$hideStyle}'>Debug:<br>$arr</div>";
    }
}

function _R($url) {
    header("Location:{$url}");
    exit;
}

function back_trace() {
    $array = debug_backtrace();
    $output = 'Execution Backtrace:<br><ul>';
    foreach ($array as $debug_data) {
        $output .= "<li><b> " . $debug_data['file'] . "</b> [ Line : <b>" . $debug_data['line'] . "</b> ] <br></li>";
    }
    $output .= '</ul>';
    d($output);
}

function random_string() {
    return date("ymd") . mt_rand(1, 1000) . mt_rand(99, 99999);
}

function _escapeArray($array) {
    $array = array_map('mysql_real_escape_string', $array);
    return array_map('trim', $array);
}

function _bindArray($array, $map) {
    $return = array();
    foreach ($map as $form_field => $db_field) {
        $return[$db_field] = $array[$form_field];
    }
    return $return;
}

function _normalDate($date) {
    return date("d-M-Y H:i a", strtotime($date));
}

function json_die($status = true, $array = array()) {
    $response = array();
    $response['status'] = $status;
    $response['data'] = $array;
    die(json_encode($response));
}

function _errors_on() {
    ini_set("display_errors", "on");
    error_reporting(E_ALL);
}

function _errors_off() {
    ini_set("display_errors", "off");
    error_reporting(0);
}

function clearNumber($number) {
    return str_replace(array("-", "(", ")", " "), array("", "", "", ""), $number);
}

function formatDate($string) {
    return date("Y-m-d H:i:s", strtotime($string));
}

function _l($string) {
    print "<div style='padding:8px;background-color:#FFFFCC;font-family:verdana;border:1px solid #DADADA;border-radius:5px;margin:4px;font-size:12px;font-weight:bold'>";
    print $string;
    print "</div>";
}

