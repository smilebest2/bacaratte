<?php
session_start();

require_once '../common/connect.php';

require_once '../common/const.php';

require_once '../common/function.php';


/**

 * 削除

 */
if ($_POST['delete_ck']) {

	$obj = new connect();
	$sql = SELECT011. " WHERE NO = :NO";
	$no = $_POST["id"];
	$get_data = $obj->delete_sejyutusya($sql,$no);

	header('Content-Type: application/json; charset=utf-8');

	$_POST['delete_ck']=false;
	$data="OK";

	echo json_encode($data);

}
