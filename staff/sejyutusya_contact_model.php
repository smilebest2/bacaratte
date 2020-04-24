<?php
session_start();

require_once '../common/mysql.php';

require_once '../common/const.php';

require_once '../common/function.php';






if($_SERVER["REQUEST_METHOD"] == "POST"){
/**

 * キャンセル

 */

	if (isset($_POST['cancel'])) {
	$_SESSION["uid"]=$_SESSION["stfid"];
	$_SESSION["stfid"]="";
	header("Location:".url_sejyutusya);
	
	exit;
	
	}


/**

 * 編集

 */

	if (isset($_POST['edit'])) {
	$_SESSION["ste"]=$_SESSION["stfid"];
	$_SESSION["stfid"]="";
	header("Location:".url_sejyutusya_edit);
	
	exit;
	
	}	
	


}