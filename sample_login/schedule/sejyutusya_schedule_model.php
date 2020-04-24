<?php
session_start();
require_once '../common/mysql.php';
require_once '../common/const.php';
require_once '../common/function.php';


if($_SERVER["REQUEST_METHOD"] == "POST"){
/**

 * ログアウト

 */

	if (isset($_POST['logout'])) {
	$_SESSION["ske_id"]="";
	header("Location:".url_index);

	exit();
	
	}
/**

 * キャンセル

 */

	if (isset($_POST['cancel'])) {
	$_SESSION["user_id"] = $_SESSION["ske_id"];
	$_SESSION["ske_id"] = "";
	header("Location:".url_menu);
	
	exit;
	
	}


/**

 * 編集

 */

	if (isset($_POST['schedule'])) {
	$_SESSION["schid"] = $_SESSION["ske_id"];
	$_SESSION["ske_id"] = "";
	$id=$_POST["required_sejyutusya"];
	header("Location:".url_schedule_no.$id);
	
	exit;
	
	}	
	
}