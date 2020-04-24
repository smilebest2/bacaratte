<?php
session_start();

require_once '../common/mysql.php';
require_once '../common/mail.php';
require_once '../common/function.php';
require_once '../common/const.php';
require_once 'schedule_model.php';

if(isset($_GET["no"])){
	$sId= $_GET["no"];
}

if($_SESSION["schid"]){
	$user_name = $_SESSION["una"];
	$_SESSION["user_id"] = $_SESSION["schid"];
	$_SESSION["schid"]="";
	$sId='1075';
	$mId =$_SESSION["mid"];
	$mysql = new MySQL_cls();
	$mysql->MySQL();
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

	$sql = "select NO,nick_name,onanpo,denkikosen,henkeitosyu from RIYOUSHA where member_id = '$mId' and syutanto = '$sId'";
	$mysql->actQuery($sql);
	while (($row_ka = $mysql->getResult())){
		$kanjya_opt .= "<option value=" . $row_ka["NO"] .">" . $row_ka["nick_name"] . "</option>";
		$ka_no[]=$row_ka["NO"];
		$ka_sejyutu_naiyo[$row_ka["NO"]]["onanpo"]=$row_ka["onanpo"];
		$ka_sejyutu_naiyo[$row_ka["NO"]]["denkikosen"]=$row_ka["denkikosen"];
		$ka_sejyutu_naiyo[$row_ka["NO"]]["henkeitosyu"]=$row_ka["henkeitosyu"];
	}
	$sql = "SELECT * FROM evenement where member_id = '$mId' and sejyutu_no = '$sId'";
	$mysql->actQuery($sql);

	while (($row_yotei = $mysql->getResult())){
		$yoteibi=date("Y/m/d",strtotime($row_yotei["start"]));
		if($yoteibi==$sejytubi){
			$yotei[$row_yotei["start"]]["title"]=$row_yotei["title"];
			$yotei[$row_yotei["start"]]["kanjya_no"]=$row_yotei["kanjya_no"];
			$yotei[$row_yotei["start"]]["end"]=$row_yotei["end"];
			$yotei[$row_yotei["start"]]["onanpo"]=$ka_sejyutu_naiyo[$row_yotei["kanjya_no"]]["onanpo"];
			$yotei[$row_yotei["start"]]["denkikosen"]=$ka_sejyutu_naiyo[$row_yotei["kanjya_no"]]["denkikosen"];
			$yotei[$row_yotei["start"]]["henkeitosyu"]=$ka_sejyutu_naiyo[$row_yotei["kanjya_no"]]["henkeitosyu"];
			$time_h=date("H",strtotime($row_yotei["start"]));
			$time_m=date("m",strtotime($row_yotei["start"]));
			$onanpo = ($ka_sejyutu_naiyo[$row_yotei["kanjya_no"]]["onanpo"])? "checked":"";
			$denkikosen =($ka_sejyutu_naiyo[$row_yotei["kanjya_no"]]["denkikosen"])? "checked":"";
			$henkei =($ka_sejyutu_naiyo[$row_yotei["kanjya_no"]]["henkeitosyu"])? "checked":"";

			$time_h=checktime_h($time_h);
			$time_m=checktime_m($time_m);

			$table_data=$table_data.
			"<tr><td>患者名:".
			$row_yotei["title"].
			"<br>開始時間:".
			$time_h.
			$time_m.
			"<br>温罨法:".
			"<div class=\"chkbox\"><input type=\"checkbox\" name=\"onanpo\" value=\"1\"".$onanpo." >".
			"<br>電器光線:".
			"<input type=\"checkbox\" name=\"denkikosen\" value=\"1\"".$denkikosen." >".
			"<br>変形徒手:".
			"<input type=\"checkbox\" name=\"henkei\" value=\"1\"".$henkei." ></div>".
			"<input type=\"submit\" name=\"report\" value=\"報告\" />".
			"</td></tr>";

		}
	}
}else{
	header("Location: https://smilebest.info/sample_login/sample_login.php");
	exit;
}

function checktime_h($value)
{

	$timh.="<select name=\"sejyututime_h\" style=\"font-size: 32px\">";
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

function checktime_m($value)
{
	if($value<>"00" or $value<>"10" or $value<>"20" or $value<>"30" or $value<>"40" or $value<>"50"){
		$value="00";
	}
	$timh.="<select name=\"sejyututime_m\" style=\"font-size: 32px\">";
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
		<a href="https://smilebest.info"><img id="logo" name="logo"
			src="../../index/img/header_smf.png" /> </a>
		<p class="headerTitle">実績報告</p>
		<form action="<?php echo $_SERVER["SCRIPT_NAME"]; ?>" method="post">
			<section id=sec02>
				<div class="sejyutubi_layout">
					<div class="sejyutubi_layout1">
						<input type="submit" name="zenjitu" value="前日" />
					</div>
					<div class="sejyutubi_layout2">
						施術日:
						<?php echo $sejytubi; ?>
					</div>
					<div class="sejyutubi_layout3">
						<input type="submit" name="yokujitu" value="翌日" />
					</div>
				</div>
				<input type="hidden" name="sejyutubi"
					value="<?php echo $sejytubi; ?>" /> <input type="hidden"
					name="userID" value="<?php echo $_SESSION["user_id"]; ?>" />
				<table width="350px">
					<?php echo $table_data; ?>
				</table>
			</section>
		</form>
		<div id="footer">
			<p id="copyright">Copyright (c) 2014 株式会社スマイルベスト | smilebest All
				Rights Reserved.</p>
		</div>
	</div>

</body>
</html>
