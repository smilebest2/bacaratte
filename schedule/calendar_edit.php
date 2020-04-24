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

$start_t=$_GET["start"];
$end_t=$_GET["end"];
$mId =$_SESSION["mid"];
$mysql = new MySQL_cls();
$mysql->MySQL();
$sql = "select * from evenement where member_id= '$mId' and start='$start_t' and end='$end_t'";
$mysql->actQuery($sql);
$row = $mysql->getResult();
$Id=$row["id"];
$riyo=$row["kanjya_no"];
$riyo_name=$row["title"];
$from_chiryoin_val=$row["from_chiryoin"];
$syoken_val=$row["syoken"];

if($from_chiryoin_val==1){
	$fc_ck="checked";
}else{
	$fc_ck="";
}

if($syoken_val==1){
	$sc_ck="checked";
}else{
	$sc_ck="";
}
}else{
header("Location:".url_index);
exit;
}

$date_st= str_replace(" ","T",$start_t);
$date_ed= str_replace(" ","T",$end_t);
$time=date('c',strtotime($_POST["required_start"]));
$new_sejyutu_month= date('Y-m',strtotime($date_st));
$new_sejyutu_day= date('j',strtotime($date_st));

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">

<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<meta http-equiv="Content-Style-Type" content="text/css" />

	<meta http-equiv="Content-Script-Type" content="text/javascript" />

	<title>登録画面</title>

	<link href="../css/style.css" rel="stylesheet" type="text/css" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
	<script type="text/javascript" src="js/const.js"></script>
<script>
var start_t=<?php echo "'" . $start_t . "'" ?>;
var sid=<?php echo $no ?>;


$(document).ready(function() {

	$('#delete').click(function(){
	    if(!confirm('本当に削除しますか？')){
	        /* キャンセルの時の処理 */
	        return false;
	    }else{
	    var id = <?php echo json_encode($Id, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
		var mId=<?php echo json_encode($mId, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
		var sejyutu_day=<?php echo json_encode($new_sejyutu_day, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
		var sejyutu_month=<?php echo json_encode($new_sejyutu_month, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);  ?>;
		var riyousya_no=<?php echo json_encode($riyo, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);  ?>;
		var starttime=<?php echo json_encode($date_st, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);  ?>;
			$.ajax({
	            type: "POST",
	            url: "https://smilebest.info/schedule/schedule_del.php",
	            data: {"delete_ck": true,"id":id,"mId":mId,"sejyutu_month":sejyutu_month,"sejyutu_day":sejyutu_day,"riyousya_no":riyousya_no,"starttime":starttime},
	            success:function(j_data){
	            	if(j_data="OK"){
		            alert("削除しました。");
		        	location.replace( '<?php echo url_schedule_no; ?>' + sid );
		        	}else{
		            alert("予期せぬエラーが発生しました。");
		        	location.replace( '<?php echo url_schedule_no; ?>' + sid );

		        	}
		        }
	        });
	    }
	});

});

</script>
</head>



<body>

<div id="wrapper">
	<div id="header"><br><br><br>
		<p class="headerTitle">スケジュール</p>
	</div>
</div>

<form name = "schdule_day" action="schdule_day_upload.php" method="post" enctype="multipart/form-data">
<br><br>
<span style="position: relative; left: 210px; top: 0px;">※削除ボタンをクリックすると下記データが削除されます</span>
<INPUT type="button" value=" 削 除 " id="delete" name="delete" style="position: relative; left: 610px; top: 0px;"></TD>

	<table id="table_contact" style="margin-top:40px;" class="border">
	<input type="hidden" name="required_id value="<?=$Id?>" /></td>
	<input type="hidden" name="required_member_no" value="<?=$mId?>" /></td>
	<input type="hidden" name="required_sejyutu_no" value="<?=$no?>" /></td>
	<input type="hidden" name="required_riyo_no" value="<?=$riyo?>" /></td>
	<input type="hidden" name="required_ka_nick_name" value="<?=$riyo_name?>" /></td>
	<input type="hidden" name="required_start" value="<?=$date_st?>" /></td>
	<input type="hidden" name="required_end" value="<?=$date_ed?>" /></td>
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

			<td class="border" ><input type="checkbox" name="required_from_chiryoin" value="" <?=$fc_ck?>/>治療院からの訪問</td>

		</tr>

		<tr>

			<th><?=$syoken?></td>

			<td class="border" ><input type="checkbox" name="required_syoken" value="" <?=$sc_ck?> />初検</td>

		</tr>



	</table>


<br />

  <TBODY>
    <TR>
      <INPUT type="submit" value=" 登 録 " name="entry" style="position: relative; left: 650px; top: 0px;"></TD>
      <INPUT type="submit" value=" ｷｬﾝｾﾙ " name="cancel" style="position: relative; left: 670px; top: 0px;"></TD>
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