<?php
/**
 * Created by PhpStorm.
 * User: jayeshyadav
 * Date: 12/20/16
 * Time: 11:48 PM
 */
$rest_json = file_get_contents("php://input");
$_POST = json_decode($rest_json, true);

$value  = $_POST['value'];
$percen = $_POST['percent'];
$total = $value+$value*$percen;
$split2 = $total/2;
$split3 = $total/3;
$split4 = $total/4;

$returnArray = array("tip"=>$value*$percen, "total"=>$value+$value*$percen, "split2"=>$split2,
                    "split3"=>$split3,"split4"=>$split4);
echo json_encode($returnArray);

?>