<?php
session_start();
require_once 'common/const.php';
require_once 'common/connect.php';
require_once 'common/st.inc';

$link_chiryoin = url_chiryoin;


if($_SESSION["user_id"]){
	$userId =$_SESSION["user_id"];
	$obj=new connect();

	$sql = "select userID,user_name from users_smilebest where user_id = :user_id";
	$get_data = $obj->select_user_id($sql,$userId);
	foreach($get_data as $item){
		$row["userID"]= $item['userID'];
	}
//	$user_name = $row["user_name"];
	$user_name = $userId;
	$_SESSION["user_id"]=NULL;
	unset($_SESSION["user_id"]);
	$_SESSION["mid"]=$row["userID"];
	$_SESSION["uid"]=$userId;
	$_SESSION["una"]=$user_name;
}else{
	header("Location:".url_index);
}


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">



<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<meta http-equiv="Content-Style-Type" content="text/css" />

	<meta http-equiv="Content-Script-Type" content="text/javascript" />

	<title>メニュー画面</title>
	<link href="css/style.css" rel="stylesheet" type="text/css" />
	<link href="css/menu_bt.css" rel="stylesheet" type="text/css" />

</head>
<body>
<div id="wrapper">
	<div id="header"></br></br></br></br>
		<p class="headerTitle">メニュー画面</p>
	</div>
<label style="position: relative; left: 850px; top: 0px;"><?php echo $user_name  . " 様" ?></label>
<br/><br/>
  <TBODY style="margin-top:10px;">
    <TR>
      <input type="button" value=" ログアウト " style="position: relative; left: 900px; top: 0px;" onclick="location.href='<?= url_index ?>'"></TD>
      <br/><br/>
    </TR>
  </TBODY>
<?php
//print_r($SV) . "\n";
//print_r($CK) . "\n";
//print_r($SS) . "\n";
//print_r($PS) . "\n";
?>
<table align="center" style="margin-top:40px;">
<tr>
<?php
echo '	<td><a class="btn" href=" ' . url_chiryoin . ' " style="position: relative; top: 0px;">治療院情報</a></td>';
echo '	<td><a class="btn" href=" ' . url_schedule_index . ' " style="position: relative; top: 0px;">実績情報</a></td>';
?>
</tr>
<tr>
<?php
echo '	<td><a class="btn" href=" ' . url_sejyutusya . ' " style="position: relative; top: 0px;">施術者情報</a></td>';
echo '	<td><a class="btn" href=" ' . url_print . ' " style="position: relative; top: 0px;">各種印刷</a></td>';
?>
</tr>
<tr>
<?php
echo '	<td><a class="btn" href=" ' . url_kanjya . ' " style="position: relative; top: 0px;">患者情報</a></td>';
echo '	<td><a class="btn" href=" ' . url_password . ' " style="position: relative; top: 0px;">パスワード変更</a></td>';
//echo '	<td><a class="btn" href=" ' . url_douibi_ck . ' " style="position: relative; top: 0px;">同意日チェック</a></td>';
?>
</tr>
<tr>
<?php
echo '	<td><a class="btn" href=" ' . url_report_user . ' " style="position: relative; top: 0px;">スマホ報告ユーザー</a></td>';
?>
</tr>
</table>
<br />

<br />
<div id="footer">
	<p id="copyright">Copyright© 2010 日本マッサージ師支援協会(訪問マッサージ｜在宅医療マッサージ｜大阪)</br>
				〜笑顔と感謝そしておかげさま〜 All Rights Reserved.</p>
	</div>
</div>
</body>

</html>

