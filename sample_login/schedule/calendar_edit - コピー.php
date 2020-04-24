<?php
session_start();

require_once '../common/mysql.php';
require_once '../common/function.php';
require_once '../common/const.php';
require_once '../common/st.inc';

$nick_name = nick_name;
$start = start;
$end = end;
$from_chiryoin = from_chiryoin;
$syoken = syoken;

$MSG_ERR=MSG_ERR_005;
$_SESSION["schid"] = $_SESSION["user_id"];
$_SESSION["user_id"]="";
$sid=$_GET["no"];
$s_time=$_GET["start"];
$user_name= $_SESSION["una"];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">

<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<meta http-equiv="Content-Style-Type" content="text/css" />

	<meta http-equiv="Content-Script-Type" content="text/javascript" />

	<title>登録画面</title>

	<link href="../css/style.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/smoothness/jquery-ui.css" type="text/css">

	<script type="text/javascript" src="js/const.js"></script>
	<script src="https://ajaxzip3.googlecode.com/svn/trunk/ajaxzip3/ajaxzip3-https.js " type="text/javascript" charset="UTF-8"></script>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
	<script>$(function(){$("#source-viewer").text($("#source").html());});</script>

<SCRIPT TYPE="text/javascript">
function DataReceive(){
		//?以降の文字を取得する
	var data = location.search.substring(1, location.search.length);
		//エスケープされた文字をアンエスケープする
	data = unescape(data);
		//アラートで?以降の文字を表示する
//	alert(data);
//	var $dt = $('<input type="hidden">').attr('name="required_start"').val(data);
//	var $d = $('<input type="text">');
//	var $t = $('<select></select>');
	
//	$d.datepicker({dateFormat:'yy-mm-dd'});
//	document.getElementById('required__start').value=data;
	//document.getElementById('required_end').value=bbb;
	//document.schdule_day.required_start.value=data;
data=<?php echo $s_time ?>;
}
window.onload = DataReceive;

$(function(){
	$('.datetimepicker').each(function(){
		//日時はhiddenにすり替え
		var $dt = $('<input type="hidden">').attr('name', this.name).val(this.value);
		//見た目は日付と時間入力に変更
		var $d = $('<input type="text">');
		var $t = $('<select></select>');
		//時刻の方は10分おきのプルダウンなどにする
		var hh = ['08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23'];
		var mm = ['00', '10', '20', '30', '40', '50'];
		for (var i = 0; i < hh.length; ++i) {
			for (var j = 0; j < mm.length; ++j) {
				var $o = $('<option></option>')
							.attr('value', hh[i] + ':' + mm[j] + ':00')
							.text(hh[i] + ':' + mm[j]);
				$t.append($o);
			}
		}
		$(this).after($dt, $d, ' ', $t);
		//日付の方はdatepickerにする
		$d.datepicker({dateFormat:'yy-mm-dd'});
		$t.datepicker({dateFormat:'hh:mm:00'});
		//初期値があれば反映
		var data = location.search.substring(1, location.search.length);
		data = unescape(data);
//			alert(data);
//		time = Format(data);
//		stime = time.substring(len -8,len);
//		alert(stime);

		$d.val(data);
		$t.val(data);
//		$d.val(this.value.replace(/^(\d\d\d\d-\d\d-\d\d).*$/, "$1"));
//		$t.val(this.value.replace(/^.*(\d\d:\d\d:\d\d)$/, "$1"));
		//日付変更時と時間変更時にhidden化した方へ値を反映する処理を仕込んでおく
		function x(){$dt.val($d.val() + ' ' + $t.val());}
		$d.datepicker('option', 'onSelect', x);
		$d.on('change', x);
		$t.on('change', x);
		//オリジナルはさようなら
		$(this).remove();
	});
});


</SCRIPT>
</head>



<body>

<div id="wrapper">
	<div id="header"><br><br><br><br>
		<p class="headerTitle">スケジュール</p>
</div>
<label style="position: relative; left: 850px; top: 0px;"><?php echo $user_name  . " 様" ?></label>
<br>
<form name = "schdule_day" action="schdule_day_upload_action.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="required_id" value="<?=$sid?>" /></td>
	<table id="table_contact" style="margin-top:40px;" class="border">

	<tr>

		    <th width="150"><?=$nick_name?></td>

			<td width="400" class="border" ><input type="text" name="required_ka_nick_name" style="ime-mode: active" maxlength="50" size="50" /></td>
	</tr>

		<tr>
	
		<th><?=$start?></td>
			
			<td class="border" ><input type="text" class="datetimepicker" name="required_start" id="date_start"></td>
			
		</tr>
		<tr>
		<th><?=$end?></td>
	
			<td class="border" ><input type="text" class="datetimepicker" name="required_end" id="date_end"></td>

		</tr>


		<tr>

			<th><?=$from_chiryoin?></td>

			<td class="border" ><input type="radio" name="required_from_chiryoin" value="1"/>治療院からの訪問</td>

		</tr>

		<tr>

			<th><?=$syoken?></td>

			<td class="border" ><input type="radio" name="required_syoken" value="1" />初検</td>

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
</div>
<div id="footer">
		footer
</div>
</body>

</html>