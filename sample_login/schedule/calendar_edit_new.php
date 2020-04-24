<?php
session_start();

require_once '../common/mysql.php';
require_once '../common/function.php';
require_once '../common/const.php';


if($_SESSION["user_id"]){
$_SESSION["schid"] = $_SESSION["user_id"];
$_SESSION["user_id"]="";
$nick_name = nick_name;
$start = start;
$end = end;
$from_chiryoin = from_chiryoin;
$syoken = syoken;

$MSG_ERR=MSG_ERR_005;

$no=$_GET["no"];
$riyo=$_GET["riyo"];
$start_t=$_GET["start"];
$end_t=$_GET["end"];
$mId =$_SESSION["mid"];
$mysql = new MySQL_cls();
$mysql->MySQL();
$sql = "SELECT ";
$sql .= "RIYOUSHA.nick_name,";
$sql .= "RIYOUSHA.kanjya_ido,";
$sql .= "RIYOUSHA.kanjya_keido,";
$sql .= "RIYOUSHA.from_chiryoin_kyori,";
$sql .= "SEJYUTUSYA.address ";
$sql .= "from RIYOUSHA ";
$sql .= "LEFT JOIN SEJYUTUSYA ON ";
$sql .= "RIYOUSHA.syutanto = SEJYUTUSYA.NO ";
$sql .= "where RIYOUSHA.NO = '$riyo' ";
$sql .= "and RIYOUSHA.member_id= '$mId'";
$mysql->actQuery($sql);
$row = $mysql->getResult();
$riyo_name=$row["nick_name"];
$from_chiryoin_kyori=$row["from_chiryoin_kyori"];
$kanjya_ido=$row["kanjya_ido"];
$kanjya_keido=$row["kanjya_keido"];
$sejyutusya_add=$row["address"];

}else{
header("Location:".url_index);
exit;
}

$date_st= str_replace(" ","T",$start_t);
$date_ed= str_replace(" ","T",$end_t);


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">

<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<meta http-equiv="Content-Style-Type" content="text/css" />

	<meta http-equiv="Content-Script-Type" content="text/javascript" />

	<title>登録画面</title>

	<link href="../css/style.css" rel="stylesheet" type="text/css" />

	<script type="text/javascript" src="js/const.js"></script>
	<script src="https://ajaxzip3.googlecode.com/svn/trunk/ajaxzip3/ajaxzip3-https.js " type="text/javascript" charset="UTF-8"></script>
<SCRIPT TYPE="text/javascript">
var start_t=<?php echo $start_t ?>;
function DataReceive(){
		//?以降の文字を取得する
	var data = location.search.substring(1, location.search.length);
		//エスケープされた文字をアンエスケープする
	data = unescape(data);
		//アラートで?以降の文字を表示する
	alert(data);
	document.schdule_day.required_start.value="2016-02-04T20:40";
}
window.onload = DataReceive;

</SCRIPT>
</head>



<body>

<div id="wrapper">
	<div id="header"><br><br><br>
		<p class="headerTitle">スケジュール</p>
</div>

<form name = "schdule_day" action="schdule_day_upload_action.php" method="post" enctype="multipart/form-data">

	<table id="table_contact" style="margin-top:40px;" class="border">
	<input type="hidden" name="required_member_no" value="<?=$mId?>" /></td>
	<input type="hidden" name="required_sejyutu_no" value="<?=$no?>" /></td>
	<input type="hidden" name="required_riyo_no" value="<?=$riyo?>" /></td>
	<input type="hidden" name="required_ka_nick_name" value="<?=$riyo_name?>" /></td>
	<input type="hidden" name="required_start" value="<?=$date_st?>" /></td>
	<input type="hidden" name="required_end" value="<?=$date_ed?>" /></td>
	<input type="hidden" name="required_from_chiryoin_kyori" value="<?=$from_chiryoin_kyori?>" /></td>
	<input type="hidden" name="required_kanjya_ido" value="<?=$kanjya_ido?>" /></td>
	<input type="hidden" name="required_kanjya_keido" value="<?=$kanjya_keido?>" /></td>
	<input type="hidden" name="required_sejyutusya_add" value="<?=$sejyutusya_add?>" /></td>
		<tr>

		    <th width="150"><?=$nick_name?></td>

			<td width="400" class="border" ><label><?=$riyo_name?></label></td>
	</tr>

		<tr>

		<th><?=$start?></td>

			<td class="border" ><label><?=$start_t?></label></td>

		</tr>
		<tr>
		<th><?=$end?></td>

			<td class="border" ><label><?=$end_t?></label></td>

		</tr>


		<tr>

			<th><?=$from_chiryoin?></td>

			<td class="border" ><input type="checkbox" name="required_from_chiryoin" value="1" />治療院からの訪問</td>

		</tr>

		<tr>

			<th><?=$syoken?></td>

			<td class="border" ><input type="checkbox" name="required_syoken" value="1" />初検</td>

		</tr>



	</table>


<br />

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
	<p id="copyright">Copyright (c) 2014 株式会社スマイルベスト | smilebest All Rights Reserved.</p>
</div>
</body>

</html>