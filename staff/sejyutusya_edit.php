<?php
session_start();

require_once '../common/mysql.php';
require_once '../common/mail.php';
require_once '../common/function.php';
require_once '../common/const.php';


if($_SESSION["ste"]){
$user_name = $_SESSION["una"];
$_SESSION["stfid"]=$_SESSION["ste"];
$_SESSION["ste"]="";
}else{
header("Location:".url_index);
exit;
}

/**

 * テキストボックス表示処理

 */

if($_SERVER["REQUEST_METHOD"] == "POST"){
	if (isset($_POST['edit'])) {
		if(isset($_GET["no"])){
			$_SESSION["id"] = $_GET["no"];
		}
		$_POST=FALSE;
	}
}
$mysql = new MySQL_cls();
$mysql->MySQL();
$mysql->actQuery(SELECT010 . " WHERE NO = '" . $_SESSION["id"] . "'");

$row = $mysql->getResult();

$no=$row["NO"];
$id=$row["ID"];
$name=$row["name"];
$nick_name=$row["nick_name"];
$chiryoinmei=$row["chiryoinmei"];
$address=$row["address"];
$kanjya_ido=$row["ido"];
$kanjya_keido=$row["keido"];
$lisence_hari=$row["lisence_hari"];
$lisence_kyu=$row["lisence_kyu"];
$lisence_ma=$row["lisence_ma"];
$contact=$row["contact"];
$code=$row["code"];
$code_ma=$row["code_ma"];
$code_kokuho=$row["code_kokuho"];
$hokenjyo_torokukubun=$row["hokenjyo_torokukubun"];

$NO=NO;
$ID=ID;
$NAME=name;
$NICK_NAME=nick_name;
$CHIRYOINMEI=chiryoinmei;
$ADD=add;
$KANJYA_IDO_KEIDO=kanjya_ido_keido;
$KANJYA_IDO=kanjya_ido;
$KANJYA_KEIDO=kanjya_keido;
$LISENCE_HARI=lisence_hari;
$LISENCE_KYU=lisence_kyu;
$LISENCE_MA=lisence_ma;
$CONTACT=kanjya_tel;
$CODE=code;
$CODE_MA=code_ma;
$CODE_KOKUHO=code_kokuho;
$HOKENJYO_TOROKUKUBUN=hokenjyo_torokukubun;

if (isset($_SESSION["lat"])) {
	$errMsg = $_SESSION["err1"];
	$kanjya_ido = $_SESSION["lat"];
	$kanjya_keido = $_SESSION["lng"];
	$no = $_SESSION["required_no"];
	$id = $_SESSION["required_ID"];
	$name = $_SESSION["required_name"];
	$nick_name = $_SESSION["required_nick_name"];
	$chiryoinmei = $_SESSION["required_chiryoinmei"];
	$address = $_SESSION["required_address"];
	$lisence_hari = $_SESSION["required_lisence_hari"];
	$lisence_kyu = $_SESSION["required_lisence_kyu"];
	$lisence_ma = $_SESSION["required_lisence_ma"];
	$contact = $_SESSION["required_kanjya_tel"];
	$code = $_SESSION["required_code"];
	$code_ma = $_SESSION["required_code_ma"];
	$code_kokuho = $_SESSION["required_code_kokuho"];
	$hokenjyo_torokukubun = $_SESSION["required_hokenjyo_torokukubun"];
	unset($_SESSION["required_no"]);
	unset($_SESSION["required_ID"]);
	unset($_SESSION["required_name"]);
	unset($_SESSION["required_nick_name"]);
	unset($_SESSION["required_chiryoinmei"]);
	unset($_SESSION["required_address"]);
	unset($_SESSION["required_lisence_hari"]);
	unset($_SESSION["required_lisence_kyu"]);
	unset($_SESSION["required_lisence_ma"]);
	unset($_SESSION["required_kanjya_tel"]);
	unset($_SESSION["required_code"]);
	unset($_SESSION["required_code_ma"]);
	unset($_SESSION["required_code_kokuho"]);
	unset($_SESSION["required_hokenjyo_torokukubun"]);
	unset($_SESSION["required_address"]);
	unset($_SESSION["lat"]);
	unset($_SESSION["lng"]);
	unset($_SESSION["required_kanjya_ido"]);
	unset($_SESSION["required_kanjya_keido"]);
}else{
	if (isset($_SESSION["required_address"])) {
		$errMsg = $_SESSION["err1"];
		$no = $_SESSION["required_no"];
		$id = $_SESSION["required_ID"];
		$name = $_SESSION["required_name"];
		$nick_name = $_SESSION["required_nick_name"];
		$chiryoinmei = $_SESSION["required_chiryoinmei"];
		$address = $_SESSION["required_address"];
		$kanjya_ido = "";
		$kanjya_keido = "";
		$lisence_hari = $_SESSION["required_lisence_hari"];
		$lisence_kyu = $_SESSION["required_lisence_kyu"];
		$lisence_ma = $_SESSION["required_lisence_ma"];
		$contact = $_SESSION["required_kanjya_tel"];
		$code = $_SESSION["required_code"];
		$code_ma = $_SESSION["required_code_ma"];
		$code_kokuho = $_SESSION["required_code_kokuho"];
		$hokenjyo_torokukubun = $_SESSION["required_hokenjyo_torokukubun"];

		unset($_SESSION["required_no"]);
		unset($_SESSION["required_ID"]);
		unset($_SESSION["required_name"]);
		unset($_SESSION["required_nick_name"]);
		unset($_SESSION["required_chiryoinmei"]);
		unset($_SESSION["required_address"]);
		unset($_SESSION["required_lisence_hari"]);
		unset($_SESSION["required_lisence_kyu"]);
		unset($_SESSION["required_lisence_ma"]);
		unset($_SESSION["required_kanjya_tel"]);
		unset($_SESSION["required_code"]);
		unset($_SESSION["required_code_ma"]);
		unset($_SESSION["required_code_kokuho"]);
		unset($_SESSION["required_hokenjyo_torokukubun"]);
		unset($_SESSION["required_kanjya_ido"]);
		unset($_SESSION["required_kanjya_keido"]);
		unset($_SESSION["lat"]);
		unset($_SESSION["lng"]);

	}
}
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
	<script src="https://ajaxzip3.googlecode.com/svn/trunk/ajaxzip3/ajaxzip3-https.js " type="text/javascript" charset="UTF-8"></script>


<script>
function ido_keido_get()
{
	if (document.edit.required_kanjya_jyusyo.value == "" )
	{
		alert("住所が空欄です。入力してください");
		return false;
	}
	else
	{

	document.edit.required_kanjya_ido.value = "";
	document.edit.required_kanjya_keido.value = "";
	}
}
</script>



</head>

<body>

<div id="wrapper">
	<div id="header"><br><br><br><br>
		<p class="headerTitle">施術者情報 登録</p>
	</div>
	<label style="position: relative; left: 850px; top: 0px;"><?php echo $user_name  . " 様" ?></label>
	<br><br>

<form name="edit" action="appli_upload_action2.php" method="post" enctype="multipart/form-data" >
<br><br>
<table id="table_contact">

<tr>
<th width="150"><?=$NO?></td>
<td width="400"><?=$no?>
<input type="hidden" name="id" value="<?=$no?>" /></td>
</tr>
<tr>
<th><?=$ID?></td>
<td><input type="text" name="required_ID" style="ime-mode: active" maxlength="50" size="50" value="<?=$id?>"/></td>
</tr>
<tr>
<th><?=$NAME?></td>
<td><input type="text" name="required_name" style="ime-mode: active" maxlength="50" size="50" value="<?=$name?>"/></td>
</tr>
<tr>
<th><?=$NICK_NAME?></td>
<td><input type="text" name="required_nick_name" style="ime-mode: active" maxlength="50" size="50" value="<?=$nick_name?>"/></td>
</tr>
<tr>
<th><?=$CHIRYOINMEI?></td>
<td><input type="text" name="required_chiryoinmei" style="ime-mode: active" maxlength="50" size="50" value="<?=$chiryoinmei?>"/></td>
</tr>
<tr>
<th><?=$ADD?></td>
<td><input type="text" name="required_address" style="ime-mode: active" maxlength="50" size="50" value="<?=$address?>"/></td>
</tr>
<tr>
<th><?=$KANJYA_IDO_KEIDO?></td>
<td>
<?=$KANJYA_IDO?>
<input type="text" name="required_kanjya_ido" style="ime-mode: active" maxlength="10" size="10" value="<?=$kanjya_ido?>"/>
<?=$KANJYA_KEIDO?>
<input type="text" name="required_kanjya_keido" style="ime-mode: active" maxlength="10" size="10" value="<?=$kanjya_keido?>"/>
<input type="submit" value=" 緯度経度を取得 " name="ido_keido_get_bt" />
</td>
</tr>
<tr>
<th><?=$LISENCE_HARI?></td>
<td><input type="text" name="required_lisence_hari" style="ime-mode: active" maxlength="50" size="50" value="<?=$lisence_hari?>"/></td>
</tr>
<tr>
<th><?=$LISENCE_KYU?></td>
<td><input type="text" name="required_lisence_kyu" style="ime-mode: active" maxlength="50" size="50" value="<?=$lisence_kyu?>"/></td>
</tr>
<tr>
<th><?=$LISENCE_MA?></td>
<td><input type="text" name="required_lisence_ma" style="ime-mode: active" maxlength="50" size="50" value="<?=$lisence_ma?>"/></td>
</tr>
<tr>
<th><?=$CONTACT?></td>
<td><input type="text" name="required_contact" style="ime-mode: active" maxlength="50" size="50" value="<?=$contact?>"/></td>
</tr>
<tr>
<th><?=$CODE?></td>
<td><input type="text" name="required_code" style="ime-mode: active" maxlength="50" size="50" value="<?=$code?>"/></td>
</tr>
<tr>
<th><?=$CODE_MA?></td>
<td><input type="text" name="required_code_ma" style="ime-mode: active" maxlength="50" size="50" value="<?=$code_ma?>"/></td>
</tr>
<tr>
<th><?=$CODE_KOKUHO?></td>
<td><input type="text" name="required_code_kokuho" style="ime-mode: active" maxlength="50" size="50" value="<?=$code_kokuho?>"/></td>
</tr>
<tr>
<th><?=$HOKENJYO_TOROKUKUBUN?></td>
<td><input type="text" name="required_hokenjyo_torokukubun" style="ime-mode: active" maxlength="50" size="50" value="<?=$hokenjyo_torokukubun?>"/></td>
</tr>

	</table>


<br />
<center><font size="2" color="red" ><span><?=$errMsg?></span></font></center><br/>
  <TBODY>
    <TR>
      <INPUT type="submit" value=" 登 録 " name="entry" style="position: relative; left: 400px; top: 0px;"></TD>
      <INPUT type="submit" value=" ｷｬﾝｾﾙ " name="cancel" style="position: relative; left: 420px; top: 0px;"></TD>
      <br />
    </TR>
  </TBODY>

<br />

</form>
<div id="footer">
	<p id="copyright">Copyright© 2010 日本マッサージ師支援協会(訪問マッサージ｜在宅医療マッサージ｜大阪)</br>
				〜笑顔と感謝そしておかげさま〜 All Rights Reserved.</p>
</div>

</body>

</html>