<?php
session_start();

require_once '../common/mysql.php';

require_once '../common/function.php';



$errMsg = "";

$userId = "";

$userPass = "";



/**

* ログインチェック

*/

if($_SERVER["REQUEST_METHOD"] == "POST"){

	/**
	 * キャンセル
	 */

	if (isset($_POST['back'])) {

		header("Location:".url_index);

		exit();

	}


	//エラーチェック

	if($_POST["zenjitu"])
	{

		$_SESSION["sejyutubi"]=date("Y/m/d",strtotime($_POST["sejyutubi"]."-1 day"));

	}
	if($_POST["yokujitu"])
	{

		$_SESSION["sejyutubi"]=date("Y/m/d",strtotime($_POST["sejyutubi"]."+1 day"));

	}



	$id=$_POST["userID"];

	$mysql = new MySQL_cls();
	$mysql->MySQL();
	$sql = "select user_pass,user_name from users_smilebest where user_id =  '$id'";

	$mysql->actQuery($sql);

	$row = $mysql->getResult();



	$mysql = new MySQL_cls();
	$mysql->MySQL();
	$sql = "select userID,user_name from users_smilebest where user_id =  '$id'";
	$mysql->actQuery($sql);
	$row = $mysql->getResult();
	//	$user_name = $row["user_name"];
	$user_name = $id;
	$_SESSION["schid"]= $id;
	$_SESSION["user_id"]=NULL;
	unset($_SESSION["user_id"]);
	$_SESSION["mid"]=$row["userID"];
	$_SESSION["uid"]=$id;

	header("Location:https://smilebest.info/sample_login/report/schedule.php");
	exit();
}