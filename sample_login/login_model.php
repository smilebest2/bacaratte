<?php
session_start();

require_once 'common/mysql.php';

require_once 'common/function.php';



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

	//POSTの値取得

	$userId = htmlspecialchars($_POST["user_id"], ENT_QUOTES,'UTF-8');

	$userPass = htmlspecialchars($_POST["user_pass"], ENT_QUOTES,'UTF-8');

	//エラーチェック

	if(strlen($userId) <= 0)

	{

		$errMsg .=  "ユーザ名を入力して下さい。<br />";

	}

	if(strlen($userPass) <= 0)

	{

		$errMsg .=  "パスワードを入力して下さい。<br />";

	}



	if (strlen($errMsg) > 0)

	{

		return;

	}



	$mysql = new MySQL_cls();
	$mysql->MySQL();
	$sql = "select user_pass,user_name from users_smilebest where user_id =  '$userId'";

	$mysql->actQuery($sql);

	$row = $mysql->getResult();


	if($userPass == $row["user_pass"])

	{
		$date = date("Y-m-d H:i:s");
		$sql = "UPDATE users_smilebest SET last_login = '$date' where user_id =  '$userId'";
		$mysql->actQuery($sql);

		$mysql = new MySQL_cls();
		$mysql->MySQL();
		$sql = "select userID,user_name from users_smilebest where user_id =  '$userId'";
		echo ":".$sql;

		$mysql->actQuery($sql);
		$row = $mysql->getResult();
		//	$user_name = $row["user_name"];
		$user_name = $userId;
		$_SESSION["schid"]= $userId;
		$_SESSION["user_id"]=NULL;
		unset($_SESSION["user_id"]);
		$_SESSION["mid"]=$row["userID"];
		$_SESSION["uid"]=$userId;
		$_SESSION["una"]=$user_name;

		$ua=$_SERVER['HTTP_USER_AGENT'];

		if((strpos($ua,'iPhone')!==false)||(strpos($ua,'iPod')!==false)||(strpos($ua,'Android')!==false)) {
			header("Location:https://smilebest.info/sample_login/report/schedule.php");
			exit();
		}else{
			header("Location:https://smilebest.info/sample_login/schedule/schedule.php?no=1075");
			exit();
		}

	}

	else

	{

		$errMsg .= "ユーザ名、またはパスワードに誤りがあります。";

		return;

	}

}