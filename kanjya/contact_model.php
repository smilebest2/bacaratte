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
		$_SESSION["uid"]=$_SESSION["eid"];
		$_SESSION["eid"]="";
		header("Location:".url_kanjya);
		
		exit;
	
	}


	/**

	 * 編集

	 */

	if (isset($_POST['edit'])) {
		$_SESSION["keid"]=$_SESSION["eid"];
		$_SESSION["eid"]="";
		$_SESSION["mid"]=$_SESSION["mId"];
		header("Location:".url_kanjya_edit);
		
		exit;
	
	}	
	

}
