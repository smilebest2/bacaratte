<?php
session_start();

require_once '../common/mysql.php';
require_once '../common/const.php';
require_once '../common/function.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$menber_id=$_SESSION["mId"];

	/**

	* 戻る

	*/

	if (isset($_POST['back_bt'])) {

		$_SESSION["user_id"] = $_SESSION["kid"];
		$_SESSION["kid"]="";

		header("Location:".url_menu);

		exit;

	}

	/**

	* 新規登録

	*/

	if (isset($_POST['new_settingpassword'])) {

		$userId = htmlspecialchars($_POST["required_user_id"], ENT_QUOTES,'UTF-8');
		$newPass = htmlspecialchars($_POST["required_newpass"], ENT_QUOTES,'UTF-8');
		$hash_pass = password_hash($newPass, PASSWORD_DEFAULT);
		$sejyutusya = htmlspecialchars($_POST["sejyutusya"], ENT_QUOTES,'UTF-8');

		$mysql = new MySQL_cls();
		$mysql->MySQL();
		$sql ="select * from report_users where sejyutusya=".$sejyutusya;
		$mysql->actQuery($sql);
		$row = $mysql->getResult();
		if ($row) {
			$errMsg .=  "既に登録済みです。<br />";
			return;
		}else{
			$date = date("Y-m-d H:i:s");
			$sql="INSERT INTO report_users (
			menber_id,user_id, user_pass,
			user_name,last_login,sejyutusya
			)
			VALUES
			(
			'$menber_id','$userId', '$hash_pass', '',
			'$date','$sejyutusya'
	 		)";
			$mysql->actQuery($sql);
			$errMsg .=  "スマホユーザーを登録しました。<br />";
			return;
		}

	}
	/**

	* 変更

	*/
	if (isset($_POST['required_datacount'])&&isset($_POST['settingpassword'])) {
		for ($i = 0;$i<= $_POST['required_datacount'];$i++){
			if(isset($_POST['required_user_id'.$i])){
				$userId = htmlspecialchars($_POST["required_user_id".$i], ENT_QUOTES,'UTF-8');
				$oldPass = htmlspecialchars($_POST["required_oldpass".$i], ENT_QUOTES,'UTF-8');
				$newPass = htmlspecialchars($_POST["required_newpass".$i], ENT_QUOTES,'UTF-8');
				$hash_pass = password_hash($newPass, PASSWORD_DEFAULT);
				//エラーチェック
				if(strlen($userId) <= 0){
					$errMsg .=  "ユーザ名を入力して下さい。<br />";
				}
				if(strlen($oldPass) <= 0){
					$errMsg .=  "現在のパスワードを入力して下さい。<br />";
				}
				if(strlen($newPass) <= 0){
					$errMsg .=  "新しいパスワードを入力して下さい。<br />";
				}

				if (strlen($errMsg) > 0){
					return;
				}else{
					$mysql = new MySQL_cls();
					$mysql->MySQL();
					$sql = "select user_pass,user_name from report_users where user_id =  '$userId'";
					$mysql->actQuery($sql);
					$row = $mysql->getResult();
					if(password_verify($oldPass,$row["user_pass"])){
						$date = date("Y-m-d H:i:s");
						$sql = "UPDATE report_users SET
						last_login = '$date',
						user_pass='$hash_pass'
						where user_id = '$userId'
						and menber_id = '$menber_id' ";

						$mysql->actQuery($sql);
						$errMsg .=  "パスワードを変更しました。<br />";
						return ;
					}else{
						$errMsg .=  "現在のパスワードが間違っています。<br />";
						return ;
					}
				}
			}
		}
	}
	/**

	* 削除

	*/
	if (isset($_POST['required_datacount'])) {
		for ($i = 0;$i<= $_POST['required_datacount'];$i++){
			if(isset($_POST['deleteuser'.$i])){
				$userId = htmlspecialchars($_POST["required_user_id".$i], ENT_QUOTES,'UTF-8');
				$mysql = new MySQL_cls();
				$mysql->MySQL();
				$sql = "delete from report_users where user_id =  '$userId' and menber_id = '$menber_id'";
				$mysql->actQuery($sql);
				$errMsg .=  "削除しました。<br />";
				return ;
			}
		}
	}
}

