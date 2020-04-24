<?php
session_start();
require_once '../common/connect.php';

require_once '../common/const.php';

require_once '../common/function.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){


	if(isset($_GET["no"])){
		$_SESSION["id"] = $_GET["no"];
	}


	/**
	* ログアウト
	*/

	if (isset($_POST['logout'])){
		$_SESSION["cid"]="";
		header("Location:".url_index);
		exit();
	}
	/**
	* キャンセル
	*/
	if (isset($_POST['back'])) {
		$_SESSION["user_id"] = $_SESSION["cid"];
		header("Location:".url_menu);
		exit;
	}

	/**
	* 編集
	*/
	if (isset($_POST['edit'])) {
		$_SESSION["eid"] = $_SESSION["cid"];
		$_SESSION["cid"] = "";
		header("Location:".url_chiryoin_edit);
		exit;
	}

}
