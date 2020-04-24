<?php
session_start();

require_once '../common/mysql.php';
require_once '../common/const.php';
require_once '../common/function.php';



if(isset($_GET["no"]))

{

	$_SESSION["id"] = $_GET["no"];

}

$mId =$_SESSION["mid"];

$mysql = new MySQL_cls();
$mysql->MySQL();
/*
$sql = "SELECT * FROM RACE_DATA1";
$sql .= "LEFT JOIN RIYOUSHA ON RACE_DATA1.kanjya_no = RIYOUSHA.NO ";
$sql .= "WHERE ";
$sql .= "RACE_DATA1.member_id = '$mId' ";
$sql .= "AND RACE_DATA1.NO = '$_SESSION["id"]' ";
$mysql->actQuery($sql);
*/

//$mysql->actQuery(SELECT001 . " WHERE member_id = '$mId' AND NO = '" . $_SESSION["id"] . "'");


//なぜか文字化けしたので
$ARI=ari;
$NASI=nasi;
$OURYORYO=ouryoryo;

//患者データ取得
if ($row = $mysql->getResult()){

//担当施術者のデータ変換NOから施術者ニックネーム
$mId=$_SESSION["mId"];
$seNO=htmlspecialchars($row["syutanto"], ENT_QUOTES);
$sql = "select nick_name from SEJYUTUSYA where NO = '$seNO'";
	$mysql->actQuery($sql);
	while (($row_seno = $mysql->getResult())){
		$syutanto= $row_seno["nick_name"];
	}

	echo '<table id="table_contact">';

	echo ' <tr><th width="150">' . NO . '</td><td width="400">' . $row["NO"] . '</td></tr>';
	echo ' <tr><th>' . syutanto . '</td><td>' . $syutanto . '</td></tr>';
	echo ' <tr><th>' . ID . '</td><td>' . $row["ID"] . '</td></tr>';
	echo ' <tr><th>' . kanjyamei . '</td><td>' . $row["kanjyamei"] . '</td></tr>';
	echo ' <tr><th>' . kanjyamei_kana . '</td><td>' . $row["kanjyamei_kana"] . '</td></tr>';
	echo ' <tr><th>' . kanjya_seibetu . '</td><td>' . $row["kanjya_seibetu"] . '</td></tr>';
	echo ' <tr><th>' . nick_name . '</td><td>' . $row["nick_name"] . '</td></tr>';
	echo ' <tr><th>' . kanjya_yubin . '</td><td>' . $row["kanjya_yubin"] . '</td></tr>';
	echo ' <tr><th>' . kanjya_jyusyo . '</td><td>' . $row["kanjya_jyusyo"] . '</td></tr>';
	echo ' <tr><th>' . kanjya_ido_keido . '</th><td>' . kanjya_keido . $row["kanjya_ido"] . '&nbsp' . kanjya_keido . $row["kanjya_keido"] . '</td></tr>';
	echo ' <tr><th>' . from_chiryoin_kyori . '</td><td>' . $row["from_chiryoin_kyori"] . '</td></tr>';
	echo ' <tr><th>' . kanjya_tel . '</td><td>' . $row["kanjya_tel"] . '</td></tr>';
	if($row["kanjya_birth"] == "0000-00-00"){
		$kanjya_birth = "";
	}else{
		$kanjya_birth = $row["kanjya_birth"];
	}
	echo ' <tr><th>' . kanjya_birth . '</td><td>' . $kanjya_birth . '</td></tr>';
	echo ' <tr><th>' . hihokensya_simei . '</td><td>' . $row["hihokensya_simei"] . '</td></tr>';
	echo ' <tr><th>' . hihokensy_kana . '</td><td>' . $row["hihokensy_kana"] . '</td></tr>';
	echo ' <tr><th>' . hihokensya_seibetu . '</td><td>' . $row["hihokensya_seibetu"] . '</td></tr>';
	echo ' <tr><th>' . hihokensya_yubin . '</td><td>' . $row["hihokensya_yubin"] . '</td></tr>';
	echo ' <tr><th>' . hihokensya_jyusyo . '</td><td>' . $row["hihokensya_jyusyo"] . '</td></tr>';
	echo ' <tr><th>' . hihokensya_jyusyo_kana . '</td><td>' . $row["hihokensya_jyusyo_kana"] . '</td></tr>';
	if($row["hihokensya_birth"] == "0000-00-00"){
		$hihokensya_birth = "";
	}else{
		$hihokensya_birth = $row["hihokensya_birth"];
	}
	echo ' <tr><th>' . hihokensya_birth . '</td><td>' . $hihokensya_birth . '</td></tr>';
	echo ' <tr><th>' . ouryouryo_ck . '</td>';
	if($row["ouryouryo_ck"]=='1'){
	echo ' <td>' . ouryoryo . '
	<input type="radio" name="ouryouryo_ck" value="1"checked>' . $ARI . '
	<input type="radio" name="ouryouryo_ck" value="0">' . $NASI . '</td></tr>';}
	else{
	echo ' <td>' . ouryoryo . '
	<input type="radio" name="ouryouryo_ck" value="1">' . $ARI . '
	<input type="radio" name="ouryouryo_ck" value="0"checked>' . $NASI . '</td></tr>';
	}

	echo ' <tr><th>' . kotei_ck . '</td>';
	if($row["kotei_ck"]=='1'){
	echo ' <td>
	<input type="checkbox" name="kotei_ck"  value="1"checked>' . kyoriwokotei . '&nbsp' . kotei_kyori . $row["kotei_kyori"] . '</td></tr>';
	 }
	else{
	echo ' <td>
	<input type="checkbox" name="kotei_ck"  value="0">' . kyoriwokotei. '&nbsp' . kotei_kyori . $row["kotei_kyori"] . '</td></tr>';
	}
	echo ' <tr><th>' . zokugara . '</td><td>' . $row["zokugara"] . '</td></tr>';
	echo ' <tr><th>' . hokensyubetu . '</td><td>' . $row["hokensyubetu"] . '</td></tr>';
	echo ' <tr><th>' . syuhoken_wariai . '</td><td>' . $row["syuhoken_wariai"] . '</td></tr>';
	echo ' <tr><th>' . hokenjya_bango . '</td><td>' . $row["hokenjya_bango"] . '</td></tr>';
	echo ' <tr><th>' . hokenjya_mei . '</td><td>' . $row["hokenjya_mei"] . '</td></tr>';
	echo ' <tr><th>' . hihokenjya_kigou . '</td><td>' . $row["hihokenjya_kigou"] . '</td></tr>';
	echo ' <tr><th>' . hihokenjya_bango . '</td><td>' . $row["hihokenjya_bango"] . '</td></tr>';
	echo ' <tr><th>' . kouhihoken_wariai . '</td><td>' . $row["kouhihoken_wariai"] . '</td></tr>';
	echo ' <tr><th>' . kouhiumu . '</td><td>' . $row["kouhiumu"] . '</td></tr>';
	echo ' <tr><th>' . sityosonbango . '</td><td>' . $row["sityosonbango"] . '</td></tr>';
	echo ' <tr><th>' . jyukyusyabango . '</td><td>' . $row["jyukyusyabango"] . '</td></tr>';
	echo ' <tr><th>' . hatubyomataha . '</td><td>' . $row["hatubyomataha"] . '</td></tr>';
	echo ' <tr><th>' . hatubyonengappi . '</td><td>' . $row["hatubyonengappi"] . '</td></tr>';
	echo ' <tr><th>' . gyoumujyou . '</td><td>' . $row["gyoumujyou"] . '</td></tr>';
	echo ' <tr><th>' . seikyukubun . '</td><td>' . $row["seikyukubun"] . '</td></tr>';
	echo ' <tr><th>' . tenki . '</td><td>' . $row["tenki"] . '</td></tr>';
	if($row["syoryonengappi"] == "0000-00-00"){
		$syoryonengappi = "";
	}else{
		$syoryonengappi = $row["syoryonengappi"];
	}
	echo ' <tr><th>' . syoryonengappi . '</td><td>' . $syoryonengappi . '</td></tr>';
	echo ' <tr><th>' . sinsei_aten . '</td><td>' . $row["sinsei_aten"] . '</td></tr>';
	echo ' <tr><th>' . sinsei_aten2 . '</td><td>' . $row["sinsei_aten2"] . '</td></tr>';
	echo ' <tr><th>' . douiisi . '</td><td>' . $row["douiisi"] . '</td></tr>';
	echo ' <tr><th>' . douiisibyoin . '</td><td>' . $row["douiisibyoin"] . '</td></tr>';
	echo ' <tr><th>' . isi_yubin . '</td><td>' . $row["isi_yubin"] . '</td></tr>';
	echo ' <tr><th>' . isijyusyo . '</td><td>' . $row["isijyusyo"] . '</td></tr>';
	echo ' <tr><th>' . isinosyobyomei . '</td><td>' . $row["isinosyobyomei"] . '</td></tr>';
	if($row["douinengappi"] == "0000-00-00"){
		$douinengappi = "";
	}else{
		$douinengappi = $row["douinengappi"];
	}
	echo ' <tr><th>' . douinengappi . '</td><td>' . $douinengappi . '</td></tr>';
	echo ' <tr><th>' . douikikan_ji . '</td><td>' . $row["douikikan_ji"] . '</td></tr>';
	echo ' <tr><th>' . doukikan_itaru . '</td><td>' . $row["doukikan_itaru"] . '</td></tr>';
	echo ' <tr><th>' . tekiyo . '</td><td>' . $row["tekiyo"] . '</td></tr>';

	echo ' <tr><th>' . sinseikaisu . '</td><td>' . $row["sinseikaisu"] . '</td></tr>';
	echo ' <tr><th>' . other_ck . '</td><td>' . $row["other_ck"] . '</td></tr>';
	echo ' <tr><th>' . ha_ma . '</td>';

		if($row["hari_bt"]=='1'){
		echo ' <td>
		<input type="radio" name="hari_bt" value="1"checked>' . hari_bt . '
		<input type="radio" name="ma_bt" value="1">' . ma_bt . '</td></tr>';
		}
		if($row["ma_bt"]=='1'){
		echo ' <td>
		<input type="radio" name="hari_bt" value="1">' . hari_bt . '
		<input type="radio" name="ma_bt" value="1"checked>' . ma_bt . '</td></tr>';
		}
		if($row["ma_bt"]!='1' && $row["ma_bt"]!='1'){
		echo '<td></td></tr>';
		}

	echo ' <tr><th>' . sejyutu . '</td><td>' . $row["sejyutu"] . '</td></tr>';
	echo ' <tr><th>' . sejyutunaiyo . '</td><td>' . $row["sejyutunaiyo"] . '</td></tr>';

	echo ' <tr><th>' . tiryo_syobyomei . '</td><td>';

	$rp = mb_strlen($row["tiryo_syobyomei"]);
	for($i = 0;$i<= $rp;$i++)
	{
	if(mb_substr($row["tiryo_syobyomei"],$i,1) == "a"){$ck1 = "checked";}
	if(mb_substr($row["tiryo_syobyomei"],$i,1) == "b"){$ck2 = "checked";}
	if(mb_substr($row["tiryo_syobyomei"],$i,1) == "c"){$ck3 = "checked";}
	if(mb_substr($row["tiryo_syobyomei"],$i,1) == "d"){$ck4 = "checked";}
	if(mb_substr($row["tiryo_syobyomei"],$i,1) == "e"){$ck5 = "checked";}
	if(mb_substr($row["tiryo_syobyomei"],$i,1) == "g"){$ck6 = "checked";}
	if(mb_substr($row["tiryo_syobyomei"],$i,1) == "f"){$ck7 = "checked";}
	}
	echo ' <input type="checkbox" name="required_hari_ck1" value="a"' . $ck1 . '>' . hari_ck1 . '&nbsp';
	echo ' <input type="checkbox" name="required_hari_ck2" value="b"' . $ck2 . '>' . hari_ck2 . '&nbsp';
	echo ' <input type="checkbox" name="required_hari_ck3" value="c"' . $ck3 . '>' . hari_ck3 . '&nbsp';
	echo ' <br><input type="checkbox" name="required_hari_ck4" value="d"' . $ck4 . '>' . hari_ck4 . '&nbsp';
	echo ' <input type="checkbox" name="required_hari_ck5" value="e"' . $ck5 . '>' . hari_ck5 . '&nbsp';
	echo ' <input type="checkbox" name="required_hari_ck6" value="f"' . $ck6 . '>' . hari_ck6 . '&nbsp';
	echo ' <br><input type="checkbox" name="required_hari_ck7" value="g"' . $ck7 . '>' . hari_ck7 . '&nbsp' . $row["syoubyou_sonota"] . '</td></tr>';;

	echo ' <tr><th>' . ma_syobyomei . '</td><td>' . $row["ma_syobyomei"] . '</td></tr>';

	if($row["hidari_jyosi"] == "1"){$ck1 = "checked";}
	if($row["migi_jyosi"] == "1"){$ck2 = "checked";}
	if($row["hidari_kasi"] == "1"){$ck3 = "checked";}
	if($row["migi_kasi"] == "1"){$ck4 = "checked";}
	if($row["kukan"] == "1"){$ck5 = "checked";}

	echo ' <tr><th>' . ma_sejyutukyokusyo . '</td><td>';
	echo ' <input type="checkbox" name="required_hidari_jyosi" value="1"' . $ck1 . '>' . hidari_jyosi . '&nbsp';
	echo ' <input type="checkbox" name="required_migi_jyosi" value="1"' . $ck2 . '>' . migi_jyosi . '&nbsp';
	echo ' <input type="checkbox" name="required_hidari_kasi" value="1"' . $ck3 . '>' . hidari_kasi . '&nbsp';
	echo ' <input type="checkbox" name="required_migi_kasi" value="1"' . $ck4 . '>' . migi_kasi . '&nbsp';
	echo ' <input type="checkbox" name="required_kukan" value="1"' . $ck5 . '>' . kukan . '&nbsp' . '</td></tr>';

	$ck1 = "";
	if($row["onanpo"] == "1"){$ck1 = "checked";}
	echo ' <tr><th>' . onanpo . '</td><td>';
	echo ' <input type="checkbox" name="required_onanpo" value="1"' . $ck1 . '>' . onanpo . '&nbsp' . '</td></tr>';
	$ck1 = "";
	if($row["denkikosen"] == "1"){$ck1 = "checked";}
	echo ' <tr><th>' . denkikosen . '</td><td>';
	echo ' <input type="checkbox" name="required_denkikosen" value="1"' . $ck1 . '>' . denkikosen . '&nbsp' . '</td></tr>';

	$ck1 = "";
	$ck2 = "";
	$ck3 = "";
	$ck4 = "";
	$rp = mb_strlen($row["henkeitosyu"]);
	for($i = 0;$i<= $rp;$i++)
	{
	if(mb_substr($row["henkeitosyu"],$i,1) == "a"){$ck1 = "checked";}
	if(mb_substr($row["henkeitosyu"],$i,1) == "b"){$ck2 = "checked";}
	if(mb_substr($row["henkeitosyu"],$i,1) == "c"){$ck3 = "checked";}
	if(mb_substr($row["henkeitosyu"],$i,1) == "d"){$ck4 = "checked";}

	}
	echo ' <tr><th>' . henkeitosyu . '</td><td>';
	echo ' <input type="checkbox" name="required_henkei_hidari_jyosi" value="1"' . $ck1 . '>' . hidari_jyosi . '&nbsp';
	echo ' <input type="checkbox" name="required_henkei_migi_jyosi" value="1"' . $ck2 . '>' . migi_jyosi . '&nbsp';
	echo ' <input type="checkbox" name="required_henkei_hidari_kasi" value="1"' . $ck3 . '>' . hidari_kasi . '&nbsp';
	echo ' <input type="checkbox" name="required_henkei_migi_kasi" value="1"' . $ck4 . '>' . migi_kasi . '&nbsp' . '</td></tr>';





	echo '</table>';

}