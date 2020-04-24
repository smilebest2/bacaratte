<?php
session_start();

require_once '../common/connect.php';

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


	$date = date("Y-m-d H:i:s");
	$ua=$_SERVER['HTTP_USER_AGENT'];
	//クラスの生成
	$obj=new connect();

	if((strpos($ua,'iPhone')!==false)||(strpos($ua,'iPod')!==false)||(strpos($ua,'Android')!==false)) {
		//スマホページへ
		$sql = "select user_pass,user_name,sejyutusya from report_users where user_id = :user_id";
		//$mysql->actQuery($sql);
		//クラスの中の関数の呼び出し
		$get_data = $obj->login($sql,$userId);
		foreach($get_data as $item){
			$row["user_pass"]= $item['user_pass'];
			$row["sejyutusya"]=$item['sejyutusya'];
		}

		if(password_verify($userPass,$row["user_pass"])){
			$sql = "UPDATE report_users SET last_login = :date where user_id = :id";
			$login_data['user_id']=$userId;
			$login_data['data']=$date;
			$get_data = $obj->update_login($sql,$login_data);
			//$mysql->actQuery($sql);
			$_SESSION["schid"] = $userId;
			header("Location:https://smilebest.info/report/schedule.php?no=".$row["sejyutusya"]);
			exit();
		}else{
			$errMsg .= "ユーザ名、またはパスワードに誤りがあります。";
			return;
		}

	}else{
		//PCページへ
		$sql = "select user_pass,user_name from users_smilebest where user_id = :user_id";
		//$mysql->actQuery($sql);
		//クラスの中の関数の呼び出し
		$get_data = $obj->login($sql,$userId);
		foreach($get_data as $item){
			$row["user_pass"]= $item['user_pass'];
		}
		if(password_verify($userPass,$row["user_pass"])){
			$_SESSION["user_id"] = $userId ;
			//$sql = "UPDATE users_smilebest SET last_login = '$date' where user_id =  '$userId'";
			$sql = "UPDATE users_smilebest SET last_login = :date where user_id = :id";
			$login_data['user_id']=$userId;
			$login_data['data']=$date;
			$row = $obj->update_login($sql,$login_data);
			//$mysql->actQuery($sql);
			header("Location:".url_menu);
			exit();
		}else{
			$errMsg .= "ユーザ名、またはパスワードに誤りがあります。";
			return;
		}
	}

}