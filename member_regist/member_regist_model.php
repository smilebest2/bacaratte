<?php
session_start();

require_once '../common/mysql.php';

require_once '../common/const.php';

require_once '../common/function.php';


// 初期化
$new_member_name= "";
$new_member_mail= "";
$new_member_mail_ck= "";
unset($_POST["err1"]);
unset($_SESSION["name"]);
unset($_SESSION["mail"]);

if($_SESSION["edit_bk"] == "1"){
	$name = $_SESSION["name_bk"];
	$mail = $_SESSION["mail_bk"];
	$mail_ck = $_SESSION["mail_bk"];
	$_SESSION["edit_bk"]="0";
}else{
	$name = $_POST["required_member_name"];
	$mail = $_POST["required_member_mail"];
	$mail_ck = $_POST["required_member_mail_ck"];

}



/**

 * 確認画面からの編集ボタン処理

*/
$ses_name = $_SESSION["name_bk"];
$ses_mail = $_SESSION["mail_bk"];



if($_SERVER["REQUEST_METHOD"] == "POST"){


	/**

	 * キャンセル

	 */

		if (isset($_POST['back'])) {

		header("Location:".url_index);

		exit();

		}


	/**

	 * 登録

	 */

		if (isset($_POST['check'])) {
		$user_name= htmlspecialchars($_POST["required_member_name"], ENT_QUOTES);
		$user_mail= htmlspecialchars($_POST["required_member_mail"], ENT_QUOTES);
		$user_mail_ck= htmlspecialchars($_POST["required_member_mail_ck"], ENT_QUOTES);
			//空チェック
			if(!empty($user_name) && !empty($user_mail) && !empty($user_mail_ck)){
				 //ユーザー名の文字数チェック
				 if(mb_strlen($user_name) > 3 && mb_strlen($user_name) < 20 && preg_match("/^[a-zA-Z0-9]+$/", $user_name)){
					//ユーザー名のスペースチェック
				 	if(!mb_ereg_match("^(\s|　)+$",$user_name)){
					    //メールアドレスと確認用のチェック
						if($user_mail==$user_mail_ck){
							//メアド正規チェック
							if(preg_match('/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/iD', $user_mail)){

								$mysql = new MySQL_cls();
								$mysql->MySQL();
							    $sql = "select * from users_smilebest where user_id = '" . $user_name . "' and mail_add = '" . $user_mail . "'";
								$mysql->actQuery($sql);

								if ($row = $mysql->getResult()){
							    	$_POST["err1"]="※既に同じ情報で登録があります。";
							    }else{
									$_SESSION["name"] = $user_name;
									$_SESSION["mail"] = $user_mail;
									header("Location:".url_member_regist_ck);

									session_register($ADMSESS);

									exit();
								}
							}else{
								$_POST["err1"]="※メールアドレスの形式が不正です。";
							}
						}else{
							$_POST["err1"]="※メールアドレスと確認用メールアドレスが異なります。";
						}
					}else{
						$_POST["err1"]="※スペースを使用しないでください。";
					}
				}else{
					$_POST["err1"]="※ログインIDは半角英数4文字以上20文字以内で入力してください。";
				}
			}else{
				$_POST["err1"]="※空欄の入力項目があります。";
			}
		}


}

