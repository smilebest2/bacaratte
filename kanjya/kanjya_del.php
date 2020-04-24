<?php
require_once '../common/mysql.php';

require_once '../common/const.php';

require_once '../common/function.php';


/**

 * 削除

 */
if ($_POST['delete_ck']) {

	$mysql = new MySQL_cls();
	$mysql->MySQL();
	$mysql->TrsBegin();
	$result=$mysql->actQuery(SELECT007 . " WHERE NO = '" . $_POST["id"] . "'");

	if($result){
		$mysql->TrsCmt();
	}else{
		$mysql->TrsRbk();
	}
	header('Content-Type: application/json; charset=utf-8');

	$_POST['delete_ck']=false;
	$data="OK";

	echo json_encode($data);

}
