<?php
session_start();

require_once 'print_contact_model.php';
require_once '../common/function.php';
require_once '../common/mysql.php';
require_once '../common/const.php';

if($_SESSION["mId"]){
$user_name = $_SESSION["una"];
$_SESSION["eid"]=$_SESSION["staid"];
$_SESSION["pid"]="";
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

	<title>印刷画面</title>

	<link href="../css/style.css" rel="stylesheet" type="text/css" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
	<script type="text/javascript" src="js/const.js"></script>
<script>
</script>

</head>



<body>

<div id="wrapper">
	<div id="header"><br><br><br><br>
		<p class="headerTitle">印刷内容</p>
	</div>
	<label style="position: relative; left: 850px; top: 0px;"><?php echo $user_name  . " 様" ?></label>
	<br>

<form action="<?php echo $_SERVER["SCRIPT_NAME"]; ?>" method="post">
<br><br>
<tr><INPUT type="submit" value=" 戻る " name="cancel" style="position: relative; left:620px; top: 0px;" ></tr>


<?php
$_SESSION["id"] = $_GET["no"];
$mId =$_SESSION["mid"];
$mysql = new MySQL_cls();
$mysql->MySQL();
$sql = "SELECT * FROM RACE_DATA1 ";
$sql .= "LEFT JOIN RIYOUSHA ON RACE_DATA1.kanjya_no = RIYOUSHA.NO ";
$sql .= "LEFT JOIN SEJYUTUSYA ON RACE_DATA1.sejyutu_no = SEJYUTUSYA.NO ";
$sql .= "WHERE ";
$sql .= "RACE_DATA1.member_id = '".$mId."'";
$sql .= "AND RACE_DATA1.NO = '".$_SESSION["id"]."'";
$mysql->actQuery($sql);
$mysql->actQuery_result($sql);
$row = $mysql->getResult();

//var_dump($row);
//require_once 'print_contact_data.php';
?>
<br>
<?php echo $row["hokensyubetu"]; ?><br>
<span>施術師コード：</span><?php echo $row["code"]; ?><br>
<span>平成：</span>
<?php
$sejyutu_month=str_replace("-","/",$row["sejyutu_month"]."-01");
//$test=convGtJDate("1981/12/02");
//$test = str_replace("-","/",$row["sejyutu_month"]."-01");
echo $sejyutu_month;
?><br>
<span>市長村コード：</span><?php echo $row["sityosonbango"]; ?><br>
<span>受給者番号：</span><?php echo $row["jyukyusyabango"]; ?><br>
<span>保険者番号：</span><?php echo $row["hokenjya_bango"]; ?><br>
<span>被保険者番号：</span><?php echo $row["hihokenjya_bango"]; ?><br>
<span>フリガナ：</span><?php echo $row["kanjyamei_kana"]; ?><br>
<span>施術を受けた物の氏名：</span><?php echo $row["kanjyamei"]; ?><br>
<span>生年月日：</span><?php echo $row["kanjya_birth"]; ?><br>
<span>続柄：</span><?php echo $row["zokugara"]; ?><br>
<span>被保険者氏名：</span><?php echo $row["hihokensya_simei"]; ?><br>
<span>受給者番号：</span><?php echo $row["jyukyusyabango"]; ?><br>
<span>初療年月日：</span><?php echo $row["syoryonengappi"]; ?><br>
<span>受給者番号：</span><?php echo $row["jyukyusyabango"]; ?><br>
<span>施術期間自：</span><?php echo str_replace("-","/",$row["sejyutu_month"]."-01"); ?><br>
<span>施術期間至：</span><?php echo str_replace("-","/",$row["sejyutu_month"]."-31"); ?><br>
<span>実日数：</span>
<?php
$ct=0;
$sejyutubi="";
$kasan=0;
for($count = 0; $count < 31; $count++){
	$val="zk".$count;
	if($row[$val] != NULL){
		$ct++;
		$sejyutubi.= $count . " ";
		if($row[$val] > 2){$kasan++;}
	}
}
echo $ct;
?><br>
<span>施術日：</span><?php echo $sejyutubi; ?><br>
<span>傷病名又は症状：</span><?php echo $row["ma_syobyomei"]; ?><br>
<span>マッサージ：</span>
<?php
$ryokin="275";
$kyokusyosu = intval($row["hidari_jyosi"]) + intval($row["migi_jyosi"]) + intval($row["hidari_kasi"]) + intval($row["migi_kasi"]) + intval($row["kukan"]);
$maryokin_ttl = intval("$ryokin") * intval($kyokusyosu) * intval($ct);
$maryokin = $ryokin . "円 × ".$kyokusyosu."局所 × ".$ct."回 = ".$maryokin_ttl."円";
echo $maryokin;
?><br>
<span>変形徒手矯正術：</span>
<?php
if(strlen($row["henkeitosyu"])){
$ryokin="565";
$kyokusyosu = strlen($row["henkeitosyu"]);
$henkei_ttl = intval("$ryokin") * intval($kyokusyosu) * intval($ct);
$maryokin = $ryokin . "円 × ".$kyokusyosu."肢 × ".$ct."回 = ".$henkei_ttl."円";
echo $maryokin;
}
?><br>
<span>温罨法：</span>
<?php
if(strlen($row["onanpo"])){
$ryokin="80";
$onan_ttl = intval("$ryokin") * intval($ct);
$maryokin = $ryokin . "円 × ".$ct."回 = ".$onan_ttl."円";
echo $maryokin;
}
?><br>
<span>温罨法・電気光線器具：</span>
<?php
if(strlen($row["denkikosen"])){
$ryokin="105";
$denki_ttl = intval("$ryokin") * intval($ct);
$maryokin = $ryokin . "円 × ".$ct."回 = ".$maryokin_ttl."円";
echo $maryokin;
}
?><br>
<span>往療費</span>
<?php
$ryokin="1800";
$ouryo_ttl = intval("$ryokin") * intval($ct);
$maryokin = $ryokin . "円 × ".$ct."回 = ".$ouryo_ttl."円";
echo $maryokin;
?><br>
<span>加算</span>
<?php
if(strlen($row["denkikosen"])){
$ryokin="800";
$kasan_ttl = intval("$ryokin") * intval($kasan);
$maryokin = $ryokin . "円 × ".$kasan."回 = ".$kasan_ttl."円";
echo $maryokin;
}
?><br>
<span>合計：</span>
<?php
$ttl = $maryokin_ttl + $henkei_ttl + $onan_ttl + $ouryo_ttl + $kasan_ttl;
echo $ttl."円";
?><br>
<span>一部負担金：</span>
<?php
$hutan = intval("$ttl") * (intval($row["syuhoken_wariai"]) * 0.1);
$maryokin = $row["syuhoken_wariai"] . "割 ".$hutan."円";
echo $maryokin;
?><br>
<span>請求額：</span>
<?php
$maryokin_ttl = $ttl - $hutan;
echo $maryokin_ttl."円";
?><br>
<span>傷病名又は症状：</span><?php echo $row["ma_syobyomei"]; ?><br>
<br />

  <TBODY>
    <TR>
      <INPUT type="submit" value=" 印刷 " name="edit" style="position: relative; left: 400px; top: 0px;"></TD>
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