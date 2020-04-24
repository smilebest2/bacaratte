<?php
session_start();

require_once 'chiryoin_model.php';
require_once '../common/function.php';
require_once '../common/const.php';


if($_SESSION["uid"]){
$user_name = $_SESSION["una"];
$_SESSION["cid"]=$_SESSION["uid"];
$_SESSION["uid"]="";
}else{
header("Location:".url_index);
exit;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">

<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<meta http-equiv="Content-Style-Type" content="text/css" />

	<meta http-equiv="Content-Script-Type" content="text/javascript" />

	<title>-治療院-確認画面</title>

	<link href="../css/style.css" rel="stylesheet" type="text/css" />



	<script type="text/javascript" src="js/const.js"></script>

</head>
<div id="wrapper">
	<div id="header"></br></br></br></br>
		<p class="headerTitle">治療院情報画面</p>
	</div>
<label style="position: relative; left: 850px; top: 0px;"><?php echo $user_name  . " 様" ?></label>
<br/><br/>
<form action="<?php echo $_SERVER["SCRIPT_NAME"]; ?>" method="post">

  <TBODY style="margin-top:10px;">
    <TR>
      <INPUT type="submit" value=" ログアウト " name="logout" style="position: relative; left: 900px; top: 0px;"></TD>
      <br/><br/>
    </TR>
  </TBODY>
<br />
<br />
<?php

require_once 'chiryoin_data.php';

?>

<br />

  <TBODY>
    <TR>
      <INPUT type="submit" value=" 編 集 " name="edit" style="position: relative; left: 400px; top: 0px;"></TD>
      <INPUT type="submit" value=" 戻る " name="back" style="position: relative; left: 420px; top: 0px;"></TD>
      <br />
    </TR>
  </TBODY>

<br />

</form>
<div id="footer">
	<p id="copyright">Copyright© 2010 日本マッサージ師支援協会(訪問マッサージ｜在宅医療マッサージ｜大阪)</br>
				〜笑顔と感謝そしておかげさま〜 All Rights Reserved.</p>
	</div>
</div>
</body>

</html>