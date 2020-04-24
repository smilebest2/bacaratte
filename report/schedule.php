<?php
session_start();

require_once '../common/mysql.php';
require_once '../common/mail.php';
require_once '../common/function.php';
require_once '../common/const.php';
require_once 'schedule_model.php';

$mysql = new MySQL_cls();
$mysql->MySQL();

if(isset($_GET["no"])){
	$sId= $_GET["no"];
	$sql = "select menber_id,user_pass,user_name,sejyutusya from report_users where sejyutusya =  '$sId'";
	$mysql->actQuery($sql);
	$row = $mysql->getResult();
}

if($_SESSION["schid"]){
	$_SESSION["user_id"] = $_SESSION["schid"];
	//$_SESSION["schid"]="";
	$mId =$row["menber_id"];

	$sejyutu_opt="";
	$kanjya_opt="";
	$sql = "select NO,nick_name from SEJYUTUSYA where NO = '$sId'";
	$ka_no=array();
	$mysql->actQuery($sql);
	$row = $mysql->getResult();
	$se_name=$row["nick_name"];


	//施術日
	if($_SESSION["sejyutubi"]){
		$sejytubi =$_SESSION["sejyutubi"];
	}else{
		$sejytubi=time();
		$sejytubi=date("Y/m/d",$sejytubi);
	}
	$week = array( "(日)", "(月)", "(火)", "(水)", "(木)", "(金)", "(土)" );
	$youbi = $week[date("w", strtotime($sejytubi))];
	$hiduke =$sejytubi.$youbi;

	$sql = "select NO,nick_name,onanpo,denkikosen,henkeitosyu from RIYOUSHA where member_id = '$mId' and syutanto = '$sId'";
	$mysql->actQuery($sql);
	while (($row_ka = $mysql->getResult())){
		$kanjya_opt .= "<option value=" . $row_ka["NO"] .">" . $row_ka["nick_name"] . "</option>";
		$ka_no[]=$row_ka["NO"];
		$ka_sejyutu_naiyo[$row_ka["NO"]]["onanpo"]=$row_ka["onanpo"];
	}
	$sql = "SELECT * FROM evenement where member_id = '$mId' and sejyutu_no = '$sId'";
	$mysql->actQuery($sql);

	$cnt=0;
	while (($row_yotei = $mysql->getResult())){
		$cnt++;
		$yoteibi=date("Y/m/d",strtotime($row_yotei["start"]));
		if($yoteibi==$sejytubi){
			$yotei[$row_yotei["start"]]["title"]=$row_yotei["title"];
			$yotei[$row_yotei["start"]]["kanjya_no"]=$row_yotei["kanjya_no"];
			$yotei[$row_yotei["start"]]["end"]=$row_yotei["end"];
			$yotei[$row_yotei["start"]]["onanpo"]=$ka_sejyutu_naiyo[$row_yotei["kanjya_no"]]["onanpo"];
			$yotei[$row_yotei["start"]]["from_chiryoin"]=$$row_yotei["from_chiryoin"];
			$time_h=date("H",strtotime($row_yotei["start"]));
			$time_m=date("m",strtotime($row_yotei["start"]));
			$onanpo = ($ka_sejyutu_naiyo[$row_yotei["kanjya_no"]]["onanpo"])? "checked":"";
			$report = ($row_yotei["report"]=="1")? "再報告":"報告";
			$from_chiryoin =($row_yotei["from_chiryoin"]==1)? "checked":"";

			$time_h=checktime_h($time_h,$cnt);
			$time_m=checktime_m($time_m,$cnt);

			if($row_yotei["report"]=="1"){
				$tbl_color = "<td style=\"background-color: #bde9ba;\">";
			}else{
				$tbl_color = "<td>";
			}
			$table_data=$table_data.
			"<tr><input type=\"hidden\" name=\"event_no".$cnt."\" value=\"".$row_yotei["id"]."\"/>".$tbl_color."患者名:".
			$row_yotei["title"].
			"<br>開始時間:".
			$time_h.
			$time_m.
			"<br><label><input type=\"checkbox\" name=\"onanpo".$cnt."\"class=\"checkbox01-input\" value=\"1\"".$onanpo." >".
			"<span class=\"checkbox01-parts\">"."温罨法あり</span>".
			"<br><label><input type=\"checkbox\" name=\"from_chiryoin".$cnt."\" class=\"checkbox01-input\" value=\"1\"".$from_chiryoin." >".
			"<span class=\"checkbox01-parts\">"."施術所からの訪問</span>".
			"<br>".
			"<input type=\"submit\" style=\"font-size: 15px\" name=\"stop".$cnt."\" value=\"中止\" />&nbsp".
			"<input type=\"submit\" style=\"font-size: 15px\" name=\"report".$cnt."\" value=\"".$report."\" />".
			"</td></tr>";

		}
	}
}else{
	header("Location: https://smilebest.info/login/login.php");
	exit;
}

function checktime_h($value,$cnt)
{

	$timh.="<select name=\"sejyututime_h".$cnt."\" style=\"font-size: 20px\">";
	if($value=="07"){
		$timh.="<option value=\"07\" selected>07</option>";
	}else{$timh.="<option value=\"07\">07</option>";
	}
	if($value=="08"){
		$timh.="<option value=\"08\" selected>08</option>";
	}else{$timh.="<option value=\"08\">08</option>";
	}
	if($value=="09"){
		$timh.="<option value=\"09\" selected>09</option>";
	}else{$timh.="<option value=\"09\">09</option>";
	}
	if($value==10){
		$timh.="<option value=\"10\" selected>10</option>";
	}else{$timh.="<option value=\"10\">10</option>";
	}
	if($value==11){
		$timh.="<option value=\"11\" selected>11</option>";
	}else{$timh.="<option value=\"11\">11</option>";
	}
	if($value==12){
		$timh.="<option value=\"12\" selected>12</option>";
	}else{$timh.="<option value=\"12\">12</option>";
	}
	if($value==13){
		$timh.="<option value=\"13\" selected>13</option>";
	}else{$timh.="<option value=\"13\">13</option>";
	}
	if($value==14){
		$timh.="<option value=\"14\" selected>14</option>";
	}else{$timh.="<option value=\"14\">14</option>";
	}
	if($value==15){
		$timh.="<option value=\"15\" selected>15</option>";
	}else{$timh.="<option value=\"15\">15</option>";
	}
	if($value==16){
		$timh.="<option value=\"16\" selected>16</option>";
	}else{$timh.="<option value=\"16\">16</option>";
	}
	if($value==17){
		$timh.="<option value=\"17\" selected>17</option>";
	}else{$timh.="<option value=\"17\">17</option>";
	}
	if($value==18){
		$timh.="<option value=\"18\" selected>18</option>";
	}else{$timh.="<option value=\"18\">18</option>";
	}
	if($value==19){
		$timh.="<option value=\"19\" selected>19</option>";
	}else{$timh.="<option value=\"19\">19</option>";
	}
	if($value==20){
		$timh.="<option value=\"20\" selected>20</option>";
	}else{$timh.="<option value=\"20\">20</option>";
	}
	if($value==21){
		$timh.="<option value=\"21\" selected>21</option>";
	}else{$timh.="<option value=\"21\">21</option>";
	}
	if($value==22){
		$timh.="<option value=\"22\" selected>22</option>";
	}else{$timh.="<option value=\"22\">22</option>";
	}
	$timh.="</select>";

	return $timh;

}

function checktime_m($value,$cnt)
{
	if($value<>"00" or $value<>"10" or $value<>"20" or $value<>"30" or $value<>"40" or $value<>"50"){
		$value="00";
	}
	$timh.="<select name=\"sejyututime_m".$cnt."\" style=\"font-size: 20px\">";
	if($value=="00"){
		$timh.="<option value=\"00\" selected>00</option>";
	}else{$timh.="<option value=\"00\">00</option>";
	}
	if($value=="10"){
		$timh.="<option value=\"10\" selected>10</option>";
	}else{$timh.="<option value=\"10\">10</option>";
	}
	if($value=="20"){
		$timh.="<option value=\"20\" selected>20</option>";
	}else{$timh.="<option value=\"20\">20</option>";
	}
	if($value=="30"){
		$timh.="<option value=\"30\" selected>30</option>";
	}else{$timh.="<option value=\"30\">30</option>";
	}
	if($value=="40"){
		$timh.="<option value=\"40\" selected>40</option>";
	}else{$timh.="<option value=\"40\">40</option>";
	}
	if($value=="50"){
		$timh.="<option value=\"50\" selected>50</option>";
	}else{$timh.="<option value=\"50\">50</option>";
	}
	$timh.="</select>";

	return $timh;

}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport"
	content="width=device-width,initial-scale=1.0,user-scalable=no" />
<title>スケジュール</title>
<link rel="stylesheet" media="screen and (max-device-width: 480px)"
	href="../css/style_smf.css">

<script>
</script>
</head>
<body>
	<div id="wrapper">
		<a><img id="logo" name="logo" src="../../index/img/header_jms_smf.png" /> </a>
		<div style="font-size:20px;"> 実績報告<input type="button" value="ログアウト" style="position: relative; left: 180px; top: 0px;" onclick="location.href='https://smilebest.info/login/login.php'"></div>
		</br>
		<form action="<?php echo $_SERVER["SCRIPT_NAME"]; ?>" method="post">
		<div style="width: 350px; margin: 0 auto ">
			<div style="width: 50px; float: left;">
				<input type="submit" style="font-size: 15px"name="zenjitu" value="前日" />
			</div>
			<div style="width: 230px;float: left; margin: 50 auto; font-size: 18px">
				<center>施術日:
				<?php echo $hiduke; ?>
				</center>
			</div>
			<div style="width: 50px; float: left;">
				<input type="submit"  style="font-size: 15px" name="yokujitu" value="翌日" />
			</div>
		</div>
		<input type="hidden" name="sejyutubi" value="<?php echo $sejytubi; ?>" />
		<input type="hidden" name="userID" value="<?php echo $_SESSION["user_id"]; ?>" />
		<input type="hidden" name="sID" value="<?php echo $sId; ?>" /></br></br>
			<section id=sec02>

				<table>
					<?php echo $table_data; ?>
				</table>
			</section>
			<input type="hidden" name="data_count" value="<?php echo $cnt;?>" />
		</form>
		<div id="footer">
			<p id="copyright">Copyright© 2010 日本マッサージ師支援協会(訪問マッサージ｜在宅医療マッサージ｜大阪)</br>
				〜笑顔と感謝そしておかげさま〜 All Rights Reserved.</p>
		</div>
	</div>

</body>
</html>
