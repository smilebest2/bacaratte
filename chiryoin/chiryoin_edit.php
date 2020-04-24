<?php
session_start();

require_once '../common/connect.php';
require_once '../common/mail.php';
require_once '../common/function.php';
require_once '../common/const.php';

if($_SESSION["eid"]){
	$user_name = $_SESSION["una"];
	$userId=$_SESSION["eid"];
	$obj=new connect();
	$sql = "select * from CHIRYOIN LEFT JOIN users_smilebest ON CHIRYOIN.ID = users_smilebest.userID where users_smilebest.user_id = :user_id";
	$get_data = $obj->select_user_id($sql,$userId);
	foreach($get_data as $row){
		$denwabango=$row["denwabango"];
		$siharaikubun=$row["siharaikubun"];
		$ginkomei=$row["ginkomei"];
		$sitenmei=$row["sitenmei"];
		$kouza=$row["kouza"];
		$kouzameigi=$row["kouzameigi"];
		$kouzabango=$row["kouzabango"];
		$dairinin=$row["dairinin"];
		$dairinin_add=$row["dairinin_add"];
	}
	$mId =$_SESSION["mid"];
	if($mId==""){
		$mId=$ID;
	}
	$_SESSION["lid"]=$_SESSION["eid"];
	$_SESSION["eid"]="";

}else{
	header("Location:".url_index);
	exit;
}

/**
* テキストボックス表示処理
*/
$MSG_ERR=MSG_ERR_005;

$ID="ID";
$DENWABANGO= denwabango;
$SIHARAIKUBUN=siharaikubun;
$GINKOMEI=ginkomei;
$SITENMEI=sitenmei;
$KOUZA=kouza;
$KOUZAMEIGI=kouzameigi;
$KOUZABANGO=kouzabango;
$DAIRININ=dairinin;
$DAIRININ_ADD=dairinin_add;


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta http-equiv="Content-Style-Type" content="text/css" />

<meta http-equiv="Content-Script-Type" content="text/javascript" />

<title>編集画面</title>

<link href="../css/style.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="js/const.js"></script>
<script type="text/javascript" src="js/sclipt.js"></script>
<script
	src="https://ajaxzip3.googlecode.com/svn/trunk/ajaxzip3/ajaxzip3-https.js "
	type="text/javascript" charset="UTF-8"></script>





</head>
<div id="wrapper">
	<div id="header">
		<br><br><br><br>
						<p class="headerTitle">治療院情報画面</p>

	</div>

	<form name="edit" action="appli_upload_action2.php" method="post"
		enctype="multipart/form-data">
		<br /> <br /> <br /> <br />
		<table id="table_contact" width="500">
			<input type="hidden" name="required_ID" value="<?=$mId?>">
				<tr>
					<th width="30%"><?=$DAIRININ?>
						</td>
						<td width="70%"><input type="text" name="required_dairinin"
							style="ime-mode: active" maxlength="50" size="40"
							value="<?=$dairinin?>" /></td>

				</tr>
				<tr>
					<th><?=$DAIRININ_ADD?>
						</td>
						<td><input type="text" name="required_dairinin_add"
							style="ime-mode: active" maxlength="50" size="40"
							value="<?=$dairinin_add?>" /></td>

				</tr>
				<tr>
					<th><?=$DENWABANGO?>
						</td>
						<td><input type="text" name="required_denwabango"
							style="ime-mode: active" maxlength="20" size="40"
							value="<?=$denwabango?>" /></td>

				</tr>
				<tr>
					<th><?=$SIHARAIKUBUN?>
						</td>
						<td><select name="required_siharaikubun">
								<option value="1.口座振替"
								<?php if ($siharaikubun == '1.口座振替') { print ' selected'; }; ?>>1.口座振替</option>
								<option value="2.窓口払"
								<?php if ($siharaikubun == '2.窓口払') { print ' selected'; }; ?>>2.窓口払</option>
						</select>
					</td>

				</tr>
				<tr>
					<th><?=$GINKOMEI?>
						</td>
						<td><input type="text" name="required_ginkomei"
							style="ime-mode: active" maxlength="50" size="40"
							value="<?=$ginkomei?>" /></td>

				</tr>
				<tr>
					<th><?=$SITENMEI?>
						</td>
						<td><input type="text" name="required_sitenmei"
							style="ime-mode: active" maxlength="50" size="40"
							value="<?=$sitenmei?>" /></td>

				</tr>
				<tr>
					<th><?=$KOUZA?>
						</td>
						<td><select name="required_kouza">
								<option value="普通"
								<?php if ($kouza == '普通') { print ' selected'; }; ?>>普通</option>
								<option value="当座"
								<?php if ($kouza == '当座') { print ' selected'; }; ?>>当座</option>
								<option value="貯蓄"
								<?php if ($kouza == '貯蓄') { print ' selected'; }; ?>>貯蓄</option>
						</select>
					</td>

				</tr>
				<tr>
					<th><?=$KOUZAMEIGI?>
						</td>
						<td><input type="text" name="required_kouzameigi"
							style="ime-mode: active" maxlength="50" size="40"
							value="<?=$kouzameigi?>" /></td>

				</tr>
				<tr>
					<th><?=$KOUZABANGO?>
						</td>
						<td><input type="text" name="required_kouzabango"
							style="ime-mode: active" maxlength="50" size="40"
							value="<?=$kouzabango?>" /></td>

				</tr>

		</table>


		<br />

		<TBODY>
			<TR>
				<INPUT type="submit" value=" 登 録 " name="entry"
					style="position: relative; left: 400px; top: 0px;"></TD> <INPUT
					type="submit" value=" ｷｬﾝｾﾙ " name="cancel"
					style="position: relative; left: 420px; top: 0px;"></TD> <br />

			</TR>
		</TBODY>

		<br />

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
