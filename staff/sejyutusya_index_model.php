<?php
session_start();

require_once '../common/mysql.php';

require_once '../common/const.php';

require_once '../common/function.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){


	if (isset($_POST['back_bt'])) {
	$_SESSION["user_id"] = $_SESSION["staid"];
	$_SESSION["staid"]="";
	header("Location:".url_menu);
	
	exit;
	
	}


/**

 * 新規登録

 */

	if (isset($_POST['new_entry'])) {
	$_SESSION["stn"]=$_SESSION["staid"];
	$_SESSION["staid"]="";
	
	header("Location:".url_sejyutusya_new);
	
	
	exit;
	
	}	
	

}

