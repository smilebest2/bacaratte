<?php
session_start();

require_once 'index_model.php';
require_once '../common/function.php';
require_once '../common/mysql.php';
require_once '../common/const.php';

if($_SESSION["uid"]){
$user_name = $_SESSION["una"];
$_SESSION["kid"]=$_SESSION["uid"];
$_SESSION["mId"]=$_SESSION["mid"];
}else{
header("Location:".url_index);
exit;
}

//var_dump($_SESSION["ddd"]);
//$_SESSION["ddd"]="";
//var_dump($_SESSION["aaa"]);
//$_SESSION["aaa"]="";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">

<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<meta http-equiv="Content-Style-Type" content="text/css" />

	<meta http-equiv="Content-Script-Type" content="text/javascript" />

	<title>パスワード変更画面</title>

	<link href="../css/style.css" rel="stylesheet" type="text/css" />

</head>



<body>

<div id="wrapper">
	<div id="header"><br><br><br><br>
		<p class="headerTitle">パスワード変更画面</p>
	</div>
	<label style="position: relative; left: 850px; top: 0px;"><?php echo $user_name  . " 様" ?></label>

<form action="<?php echo $_SERVER["SCRIPT_NAME"]; ?>" method="post">
<br/><br/>
  <TBODY style="margin-top:40px;">
    <TR>

      <INPUT type="submit" value=" 戻る " name="back_bt" style="position: relative; left: 820px; top: 0px;"></TD>
      <br />

    </TR>
  </TBODY>
<br />
<br />


<table>

	<thead>

		<tr>

			<th width="150"><?php echo "ユーザー名";?></th>

			<th width="150"><?php echo "現在のパスワード";?></th>

			<th width="100"><?php echo "新しいパスワード";?></th>

			<th width="150"><?php echo "変更";?></th>

		</tr>

	</thead>

	<tbody>

<?php

require_once 'index_data.php';

?>

	</tbody>

</table>
</div>
<Div Align="center">
				<colspan ="2" width="300"> <span class="errmsg"><?php echo $errMsg;?>
				</span>

			</Div>

<br />
</form>
<div id="footer">
	<p id="copyright">Copyright© 2010 日本マッサージ師支援協会(訪問マッサージ｜在宅医療マッサージ｜大阪)</br>
				〜笑顔と感謝そしておかげさま〜 All Rights Reserved.</p>
</div>

</body>

</html>