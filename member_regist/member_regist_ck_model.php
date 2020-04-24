<?php
session_start();

require_once '../common/mysql.php';

require_once '../common/const.php';

require_once '../common/function.php';



$name= $_SESSION["name"];
$mail= $_SESSION["mail"];


if($_SERVER["REQUEST_METHOD"] == "POST"){


	if(isset($_GET["no"])){

		$_SESSION["id"] = $_GET["no"];

	}

	/**

	 * 編集

	 */

		if (isset($_POST['edit'])) {
			$_SESSION["edit_bk"] = "1";
			$_SESSION["name_bk"] = $name;
			$_SESSION["mail_bk"] = $mail;
			header("Location:".url_member_regist);

			exit();
		}


	/**

	 * 登録

	 */

		if (isset($_POST['regist'])) {
			$user_name= htmlspecialchars($_POST["required_member_name"], ENT_QUOTES);
			$user_mail= htmlspecialchars($_POST["required_member_mail"], ENT_QUOTES);

			$p_member= md5($user_name);
			$p_member= substr($p_member,0,8);
			$hash_pass = password_hash($p_member, PASSWORD_DEFAULT);
			$date = date("Y-m-d H:i:s");
							    $mysql = new MySQL_cls();
							    $mysql->MySQL();
//							    $sql = "INSERT INTO  ";
//							    $sql .= "member_entry_status (";
//							    $sql .= "pass_member,";
//							    $sql .= "user_id,";
//							    $sql .= "mail_status,";
//							    $sql .= "one_pass,send_date,mail";
//							    $sql .= ") values (";
//							    $sql .= "'$p_member',";
//							    $sql .= "'$user_name',";
//							    $sql .= "'',";
//							    $sql .= "'',";
//							    $sql .= "'$date',";
//							    $sql .= "'$user_mail')";

							    $sql = "INSERT INTO  ";
							    $sql .= "users_smilebest (";
							    $sql .= "user_id,";
							    $sql .= "user_pass,";
							    $sql .= "user_name,";
							    $sql .= "mail_add,";
							    $sql .= "send_date,";
							    $sql .= "one_pass";
							    $sql .= ") values (";
							    $sql .= "'$user_name',";
							    $sql .= "'$hash_pass',";
							    $sql .= "'',";
							    $sql .= "'$user_mail',";
							    $sql .= "'$date',";
							    $sql .= "'')";

							    $mysql->actQuery($sql);
		$regist_id=$user_name;
		$regist_pass=
		//メール設定
		mb_language("japanese");
		mb_internal_encoding("UTF-8");
		$to = $user_mail;
		$subject = "レセプトシステム会員登録のご確認";
		$body =  "会員登録ありがとうございます。\n\n下記のIDとパスワードでサービスを利用いただく事が可能です。\n\n";
		$body .= "トップ画面でログインを行ってください。\n";
		$body .= "パスワードはログイン後に変更できます。\n"."ID:".$user_name."\nパスワード：".$p_member."\n\n";
		$body .= "但し、本メール到着より一定時間のログインが無い場合はIDとパスワードが無効になります。\n";
		$body .= "本メールにお心あたりのない方は誠に申し訳ありませんがメールを破棄していただくようお願い申し上げます。";
		$body .= "ログインURL：https://smilebest.info/login/login.php";
		$encoding = mb_detect_encoding($body, "SJIS,EUC-JP,JIS,UTF-8");
		if ($encoding != "JIS") {
		 $subject = mb_convert_encoding($subject, "JIS", $encoding);
		 $body = mb_convert_encoding($body, "JIS", $encoding);
		}

//$subject = base64_encode($subject);
//$subject = '=?ISO-2022-JP?B?' . $subject . '?=';

		$body = mb_convert_kana($body, "KVa");

		$from = mb_encode_mimeheader(mb_convert_encoding("スマイルベスト","JIS","UTF-8"))."<info@smilebest.info>";

		if(mb_send_mail($to, $subject, $body,"From:".$from)){

		$_SESSION["user_id"] =1;
			header("Location:".url_member_regist_comp);

			exit();

		}else{
			header("Location:".url_index);

			exit();
		}




		}


}

