<?php
session_start();

require_once 'login_model.php';
require_once '../common/function.php';
require_once '../common/const.php';


//レスポンポンシブPCかスマホか
if((strpos($ua,'iPhone')!==false)||(strpos($ua,'iPod')!==false)||(strpos($ua,'Android')!==false)) {
	$css="<link rel=\"stylesheet\" media=\"screen and (max-device-width: 480px)\" href=\"../css/style_smf.css\">";
	$header_img="<a href=\"https://smilebest.info\"><img id=\"logo\" name=\"logo\" src=\"../index/img/header_jms_smf.png\" /> </a>";
}else{
	$css="<link rel=\"stylesheet\" media=\"screen and (min-device-width: 1025px)\" href=\"../css/style.css\">";
	$header_img="<a href=\"https://smilebest.info\"><img id=\"logo\" name=\"logo\" src=\"../index/img/header_jms.png\" /> </a>";
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>ログイン</title>
<meta name="viewport"
	content="width=device-width,initial-scale=1.0,user-scalable=no" />

<?php echo $css; ?>

</head>



<body>

	<div id="wrapper">
		<center>
			<?php  echo $header_img; ?>
		</center>
		<form action="<?php echo $_SERVER["SCRIPT_NAME"]; ?>" method="post">

			</TBODY>
			<br /> <br />
			<table id="table_login">

				<tr>


					<td>ユーザー名</td>

					<td><input type="text" name="user_id" style="ime-mode: disabled"
						maxlength="8" value="<?php echo $userId;?>" /></td>
					<br />


				</tr>

				<tr>

					<td>パスワード</td>

					<td><input type="password" name="user_pass"
						style="ime-mode: disabled" maxlength="8"
						value="<?php echo $userPass;?>" /></td>

				</tr>

			</table>

			<Div Align="center">
				<colspan ="2" width="300"> <span class="errmsg"><?php echo $errMsg;?>
				</span>

			</Div>
			<br>
			<Div Align="center">
				<input type="reset" value="クリア" /> <input type="submit" value="ログイン" />
			</Div>

			<br /> <br />

		</form>
		<div id="footer">
			<p id="copyright">
				Copyright© 2010 日本マッサージ師支援協会(訪問マッサージ｜在宅医療マッサージ｜大阪)</br>
				〜笑顔と感謝そしておかげさま〜 All Rights Reserved.
			</p>
		</div>


	</div>

</body>

</html>

