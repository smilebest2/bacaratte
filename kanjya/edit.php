<?php
session_start();

require_once '../common/mysql.php';
require_once '../common/mail.php';
require_once '../common/function.php';
require_once '../common/const.php';

if($_SESSION["keid"]){
$user_name = $_SESSION["una"];
$_SESSION["kneid"]=$_SESSION["keid"];
$_SESSION["keid"]="";

$mId=$_SESSION["mId"];
$mysql = new MySQL_cls();
$mysql->MySQL();
if(isset($_SESSION["required_syutanto"])){
$seNO=htmlspecialchars($_SESSION["required_syutanto"], ENT_QUOTES);
$sql = "select nick_name from SEJYUTUSYA where NO = '$seNO'";
	$mysql->actQuery($sql);
	while (($row_seno = $mysql->getResult())){
		$syutanto= $row_seno["nick_name"];
	}

$sql = "select NO,nick_name from SEJYUTUSYA where member_id = '$mId'";
	$mysql->actQuery($sql);
	while (($row_se = $mysql->getResult())){
		$selected="";
		if($row_se["nick_name"]==$syutanto){
			$selected=" selected";
		}
		$sejyutusya_opt .= "<option value=" . $row_se["NO"] . $selected . ">" . $row_se["nick_name"] . "</option>";
	}
}


}else{
session_destroy();
header("Location:".url_index);
exit;
}



/**

 * テキストボックス表示処理

 */

if($_SERVER["REQUEST_METHOD"] == "POST"){

	if (isset($_POST['edit'])) {

	if(isset($_GET["no"]))

	{

		$_SESSION["id"] = $_GET["no"];

	}

}
}
	$mysql = new MySQL_cls();
	$mysql->MySQL();
	$mysql->actQuery(SELECT001 . " WHERE NO = '" . $_SESSION["id"] . "'");

$row = $mysql->getResult();
$syutanto=$row["syutanto"];
$sql = "select nick_name from SEJYUTUSYA where NO = '$syutanto'";
$mysql->actQuery($sql);
	while (($row_nickname = $mysql->getResult())){
		$syutanto = $row_nickname["nick_name"];
	}
$sejyutusya_opt="";
$sql = "select NO,nick_name from SEJYUTUSYA where member_id = '$mId'";
	$mysql->actQuery($sql);
	while (($row_se = $mysql->getResult())){
		$selected="";
		if($row_se["nick_name"]==$syutanto){
			$selected=" selected";
		}
		$sejyutusya_opt .= "<option value=" . $row_se["NO"] . $selected . ">" . $row_se["nick_name"] . "</option>";
	}
$no=$row["NO"];
$id=$row["ID"];
$kanjyamei=$row["kanjyamei"];
$kanjyamei_kana=$row["kanjyamei_kana"];
$kanjya_seibetu=$row["kanjya_seibetu"];
$kanjya_yubin=$row["kanjya_yubin"];
$kanjya_jyusyo=$row["kanjya_jyusyo"];
$nick_name=$row["nick_name"];
$kanjya_ido=$row["kanjya_ido"];
$kanjya_keido=$row["kanjya_keido"];
$kanjya_tel=$row["kanjya_tel"];
$kanjya_birth=$row["kanjya_birth"];
$hihokensya_simei=$row["hihokensya_simei"];
$hihokensy_kana=$row["hihokensy_kana"];
$hihokensya_seibetu=$row["hihokensya_seibetu"];
$hihokensya_yubin=$row["hihokensya_yubin"];
$hihokensya_jyusyo=$row["hihokensya_jyusyo"];
$hihokensya_jyusyo_kana=$row["hihokensya_jyusyo_kana"];
$hihokensya_birth=$row["hihokensya_birth"];
$ouryouryo_ck=$row["ouryouryo_ck"];
$zokugara=$row["zokugara"];
$hokensyubetu=$row["hokensyubetu"];
$hokenjya_bango=$row["hokenjya_bango"];
$hokenjya_mei=$row["hokenjya_mei"];
$hihokenjya_kigou=$row["hihokenjya_kigou"];
$hihokenjya_bango=$row["hihokenjya_bango"];
$kouhiumu=$row["kouhiumu"];
$sityosonbango=$row["sityosonbango"];
$jyukyusyabango=$row["jyukyusyabango"];
$syuhoken_wariai=$row["syuhoken_wariai"];
$kouhihoken_wariai=$row["kouhihoken_wariai"];
$sejyutu=$row["sejyutu"];
$sejyutunaiyo=$row["sejyutunaiyo"];
$hatubyomataha=$row["hatubyomataha"];
$hatubyonengappi=$row["hatubyonengappi"];
$tiryo_syobyomei=$row["tiryo_syobyomei"];
$gyoumujyou=$row["gyoumujyou"];
$seikyukubun=$row["seikyukubun"];
$tenki=$row["tenki"];
$syoryonengappi=$row["syoryonengappi"];
$sinsei_aten=$row["sinsei_aten"];
$sinsei_aten2=$row["sinsei_aten2"];
$douiisi=$row["douiisi"];
$douiisibyoin=$row["douiisibyoin"];
$isi_yubin=$row["isi_yubin"];
$isijyusyo=$row["isijyusyo"];
$isinosyobyomei=$row["isinosyobyomei"];
$douinengappi=$row["douinengappi"];
$douikikan_ji=$row["douikikan_ji"];
$doukikan_itaru=$row["doukikan_itaru"];
$tekiyo=$row["tekiyo"];
$from_chiryoin_kyori=$row["from_chiryoin_kyori"];
$sinseikaisu=$row["sinseikaisu"];
$syoubyou_sonota=$row["syoubyou_sonota"];
$other_ck=$row["other_ck"];
//$syutanto=$row["syutanto"];
$hukutanto=$row["hukutanto"];
$ma_syobyomei=$row["ma_syobyomei"];
$hidari_jyosi=$row["hidari_jyosi"];
$migi_jyosi=$row["migi_jyosi"];
$hidari_kasi=$row["hidari_kasi"];
$migi_kasi=$row["migi_kasi"];
$kukan=$row["kukan"];
$onanpo=$row["onanpo"];
$denkikosen=$row["denkikosen"];
$henkeitosyu=$row["henkeitosyu"];
$ma_bt=$row["ma_bt"];
$hari_bt=$row["hari_bt"];
$kotei_ck=$row["kotei_ck"];
$kotei_kyori=$row["kotei_kyori"];


$MSG_ERR=MSG_ERR_005;
$NO=NO;
$ID=ID;
$KANJYAMEI=kanjyamei;
$KANJYAMEI_KANA=kanjyamei_kana;
$KANJYA_SEIBETU=kanjya_seibetu;
$KANJYA_YUBIN=kanjya_yubin;
$KANJYA_JYUSYO=kanjya_jyusyo;
$NICK_NAME=nick_name;
$KANJYA_IDO_KEIDO=kanjya_ido_keido;
$KANJYA_IDO=kanjya_ido;
$KANJYA_KEIDO=kanjya_keido;
$KANJYA_TEL=kanjya_tel;
$KANJYA_BIRTH=kanjya_birth;
$HIHOKENSYA_SIMEI=hihokensya_simei;
$HIHOKENSY_KANA=hihokensy_kana;
$HIHOKENSYA_SEIBETU=hihokensya_seibetu;
$HIHOKENSYA_YUBIN=hihokensya_yubin;
$HIHOKENSYA_JYUSYO=hihokensya_jyusyo;
$HIHOKENSYA_JYUSYO_KANA=hihokensya_jyusyo_kana;
$HIHOKENSYA_BIRTH=hihokensya_birth;
$OURYOURYO_CK=ouryouryo_ck;
$ZOKUGARA=zokugara;
$HOKENSYUBETU=hokensyubetu;
$HOKENJYA_BANGO=hokenjya_bango;
$HOKENJYA_MEI=hokenjya_mei;
$HIHOKENJYA_KIGOU=hihokenjya_kigou;
$HIHOKENJYA_BANGO=hihokenjya_bango;
$KOUHIUMU=kouhiumu;
$SITYOSONBANGO=sityosonbango;
$JYUKYUSYABANGO=jyukyusyabango;
$SYUHOKEN_WARIAI=syuhoken_wariai;
$KOUHIHOKEN_WARIAI=kouhihoken_wariai;
$SEJYUTU=sejyutu;
$SEJYUTUNAIYO=sejyutunaiyo;
$HATUBYOMATAHA=hatubyomataha;
$HATUBYONENGAPPI=hatubyonengappi;
$TIRYO_SYOBYOMEI=tiryo_syobyomei;
$GYOUMUJYOU=gyoumujyou;
$SEIKYUKUBUN=seikyukubun;
$TENKI=tenki;
$SYORYONENGAPPI=syoryonengappi;
$SINSEI_ATEN=sinsei_aten;
$SINSEI_ATEN2=sinsei_aten2;
$DOUIISI=douiisi;
$DOUIISIBYOIN=douiisibyoin;
$ISI_YUBIN=isi_yubin;
$ISIJYUSYO=isijyusyo;
$ISINOSYOBYOMEI=isinosyobyomei;
$DOUINENGAPPI=douinengappi;
$DOUIKIKAN_JI=douikikan_ji;
$DOUKIKAN_ITARU=doukikan_itaru;
$TEKIYO=tekiyo;
$FROM_CHIRYOIN_KYORI=from_chiryoin_kyori;
$SINSEIKAISU=sinseikaisu;
$SYOUBYOU_SONOTA=syoubyou_sonota;
$HA_MA=ha_ma;
$OTHER_CK=other_ck;
$SYUTANTO=syutanto;
$HUKUTANTO=hukutanto;
$MA_SYOBYOMEI=ma_syobyomei;
$HIDARI_JYOSI=hidari_jyosi;
$MIGI_JYOSI=migi_jyosi;
$HIDARI_KASI=hidari_kasi;
$MIGI_KASI=migi_kasi;
$KUKAN=kukan;
$ONANPO=onanpo;
$DENKIKOSEN=denkikosen;
$HENKEITOSYU=henkeitosyu;
$MA_BT=ma_bt;
$HARI_BT=hari_bt;
$KOTEI_CK=kotei_ck;
$KOTEI_KYORI=kotei_kyori;
$MA_SEJYUTUKYOKUSYO=ma_sejyutukyokusyo;

if (isset($_SESSION["lat"])) {

$kanjya_jyusyo = $_SESSION["add"];
$kanjya_ido = $_SESSION["lat"];
$kanjya_keido = $_SESSION["lng"];
	$id = $_SESSION["required_ID"];
	$kanjyamei = $_SESSION["required_kanjyamei"];
	$kanjyamei_kana = $_SESSION["required_kanjyamei_kana"];
	$nick_name = $_SESSION["required_nick_name"];
	$kanjya_yubin = $_SESSION["required_kanjya_yubin"];
//	$kanjya_jyusyo = $_SESSION["required_kanjya_jyusyo"];
	$kanjya_tel = $_SESSION["required_kanjya_tel"];
	$kanjya_birth = $_SESSION["required_kanjya_birth"];
	$hihokensya_simei = $_SESSION["required_hihokensya_simei"];
	$hihokensy_kana = $_SESSION["required_hihokensy_kana"];
	$hihokensya_yubin = $_SESSION["required_hihokensya_yubin"];
	$hihokensya_jyusyo = $_SESSION["required_hihokensya_jyusyo"];
	$hihokensya_jyusyo_kana = $_SESSION["required_hihokensya_jyusyo_kana"];
	$hihokensya_birth = $_SESSION["required_hihokensya_birth"];
	$kotei_kyori = $_SESSION["required_kotei_kyori"];
	$hokenjya_bango = $_SESSION["required_hokenjya_bango"];
	$hokenjya_mei = $_SESSION["required_hokenjya_mei"];
	$hihokenjya_kigou = $_SESSION["required_hihokenjya_kigou"];
	$hihokenjya_bango = $_SESSION["required_hihokenjya_bango"];
	$sityosonbango = $_SESSION["required_sityosonbango"];
	$jyukyusyabango = $_SESSION["required_jyukyusyabango"];
	$hatubyomataha = $_SESSION["required_hatubyomataha"];
	$hatubyonengappi = $_SESSION["required_hatubyonengappi"];
	$syoryonengappi = $_SESSION["required_syoryonengappi"];
	$sinsei_aten = $_SESSION["required_sinsei_aten"];
	$sinsei_aten2 = $_SESSION["required_sinsei_aten2"];
	$douiisi = $_SESSION["required_douiisi"];
	$douiisibyoin = $_SESSION["required_douiisibyoin"];
	$isi_yubin = $_SESSION["required_isi_yubin"];
	$isijyusyo = $_SESSION["required_isijyusyo"];
	$isinosyobyomei = $_SESSION["required_isinosyobyomei"];
	$douinengappi = $_SESSION["required_douinengappi"];
	$douikikan_ji = $_SESSION["required_douikikan_ji"];
	$doukikan_itaru = $_SESSION["required_doukikan_itaru"];
	$tekiyo = $_SESSION["required_tekiyo"];
	$from_chiryoin_kyori = $_SESSION["required_from_chiryoin_kyori"];
	$sinseikaisu = $_SESSION["required_sinseikaisu"];
	$other_ck = $_SESSION["required_other_ck"];
	$syutanto = $_SESSION["required_syutanto"];
	$kanjya_seibetu  = $_SESSION["required_kanjya_seibetu"];
	$hihokensya_seibetu  = $_SESSION["required_hihokensya_seibetu"];
	$ouryouryo_ck  = $_SESSION["required_ouryouryo_ck"];
	$kotei_ck  = $_SESSION["required_kotei_ck"];
	$zokugara = $_SESSION["required_zokugara"];
	$hokensyubetu = $_SESSION["required_hokensyubetu"];
	$syuhoken_wariai  = $_SESSION["required_syuhoken_wariai"];
	$kouhiumu = $_SESSION["required_kouhiumu"];
	$kouhihoken_wariai = $_SESSION["required_kouhihoken_wariai"];
	$gyoumujyou = $_SESSION["required_gyoumujyou"];
	$seikyukubun = $_SESSION["required_seikyukubun"];
	$tenki = $_SESSION["required_tenki"];
	$hari_bt  = $_SESSION["required_hari_bt"];
	$ma_bt  = $_SESSION["required_ma_bt"];
	$sejyutu = $_SESSION["required_sejyutu"];
	$sejyutunaiyo = $_SESSION["required_sejyutunaiyo"];
	$kotei_ck  = $_SESSION["required_hari_ck"];
	$ma_syobyomei  = $_SESSION["required_ma_syobyomei"];
	$hidari_jyosi  = $_SESSION["required_hidari_jyosi"];
	$migi_jyosi  = $_SESSION["required_migi_jyosi"];
	$hidari_kasi  = $_SESSION["required_hidari_kasi"];
	$migi_kasi  = $_SESSION["required_migi_kasi"];
	$kukan  = $_SESSION["required_kukan"];
	$onanpo  = $_SESSION["required_onanpo"];
	$denkikosen  = $_SESSION["required_denkikosen"];
	$henkei_ck1 = $_SESSION["required_henkei_ck1"];
	$henkei_ck2 = $_SESSION["required_henkei_ck2"];
	$henkei_ck3 = $_SESSION["required_henkei_ck3"];
	$henkei_ck4 = $_SESSION["required_henkei_ck4"];
	$kanjya_ido = $_SESSION["lat"];
	$kanjya_keido = $_SESSION["lng"];

	unset($_SESSION["required_ID"]);
	unset($_SESSION["required_kanjyamei"]);
	unset($_SESSION["required_kanjyamei_kana"]);
	unset($_SESSION["required_nick_name"]);
	unset($_SESSION["required_kanjya_yubin"]);
	unset($_SESSION["required_kanjya_jyusyo"]);
	unset($_SESSION["required_kanjya_ido"]);
	unset($_SESSION["required_kanjya_keido"]);
	unset($_SESSION["required_kanjya_tel"]);
	unset($_SESSION["required_kanjya_birth"]);
	unset($_SESSION["required_hihokensya_simei"]);
	unset($_SESSION["required_hihokensy_kana"]);
	unset($_SESSION["required_hihokensya_yubin"]);
	unset($_SESSION["required_hihokensya_jyusyo"]);
	unset($_SESSION["required_hihokensya_jyusyo_kana"]);
	unset($_SESSION["required_hihokensya_birth"]);
	unset($_SESSION["required_kotei_kyori"]);
	unset($_SESSION["required_hokenjya_bango"]);
	unset($_SESSION["required_hokenjya_mei"]);
	unset($_SESSION["required_hihokenjya_kigou"]);
	unset($_SESSION["required_hihokenjya_bango"]);
	unset($_SESSION["required_sityosonbango"]);
	unset($_SESSION["required_jyukyusyabango"]);
	unset($_SESSION["required_hatubyomataha"]);
	unset($_SESSION["required_hatubyonengappi"]);
	unset($_SESSION["required_syoryonengappi"]);
	unset($_SESSION["required_sinsei_aten"]);
	unset($_SESSION["required_sinsei_aten2"]);
	unset($_SESSION["required_douiisi"]);
	unset($_SESSION["required_douiisibyoin"]);
	unset($_SESSION["required_isi_yubin"]);
	unset($_SESSION["required_isijyusyo"]);
	unset($_SESSION["required_isinosyobyomei"]);
	unset($_SESSION["required_douinengappi"]);
	unset($_SESSION["required_douikikan_ji"]);
	unset($_SESSION["required_doukikan_itaru"]);
	unset($_SESSION["required_tekiyo"]);
	unset($_SESSION["required_from_chiryoin_kyori"]);
	unset($_SESSION["required_sinseikaisu"]);
	unset($_SESSION["required_other_ck"]);
	unset($_SESSION["required_syutanto"]);
	unset($_SESSION["required_kanjya_seibetu"]);
	unset($_SESSION["required_hihokensya_seibetu"]);
	unset($_SESSION["required_ouryouryo_ck"]);
	unset($_SESSION["required_kotei_ck"]);
	unset($_SESSION["required_zokugara"]);
	unset($_SESSION["required_hokensyubetu"]);
	unset($_SESSION["required_syuhoken_wariai"]);
	unset($_SESSION["required_kouhiumu"]);
	unset($_SESSION["required_kouhihoken_wariai"]);
	unset($_SESSION["required_gyoumujyou"]);
	unset($_SESSION["required_seikyukubun"]);
	unset($_SESSION["required_tenki"]);
	unset($_SESSION["required_hari_bt"]);
	unset($_SESSION["required_ma_bt"]);
	unset($_SESSION["required_sejyutu"]);
	unset($_SESSION["required_sejyutunaiyo"]);
	unset($_SESSION["required_hari_ck"]);
	unset($_SESSION["required_ma_syobyomei"]);
	unset($_SESSION["required_hidari_jyosi"]);
	unset($_SESSION["required_migi_jyosi"]);
	unset($_SESSION["required_hidari_kasi"]);
	unset($_SESSION["required_migi_kasi"]);
	unset($_SESSION["required_kukan"]);
	unset($_SESSION["required_onanpo"]);
	unset($_SESSION["required_denkikosen"]);
	unset($_SESSION["required_henkei_ck1"]);
	unset($_SESSION["required_henkei_ck2"]);
	unset($_SESSION["required_henkei_ck3"]);
	unset($_SESSION["required_henkei_ck4"]);
	unset($_SESSION["add"]);
	unset($_SESSION["lat"]);
	unset($_SESSION["lng"]);
}
else{
if (isset($_SESSION["add"])) {
$kanjya_jyusyo = $_SESSION["add"];
$kanjya_ido = "";
$kanjya_keido = "";


		$id = $_SESSION["required_ID"];
		$kanjyamei = $_SESSION["required_kanjyamei"];
		$kanjyamei_kana = $_SESSION["required_kanjyamei_kana"];
		$nick_name = $_SESSION["required_nick_name"];
		$kanjya_yubin = $_SESSION["required_kanjya_yubin"];
//		$kanjya_jyusyo = $_SESSION["required_kanjya_jyusyo"];
//		$kanjya_ido = $_SESSION["required_kanjya_ido"];
//		$kanjya_keido = $_SESSION["required_kanjya_keido"];
		$kanjya_tel = $_SESSION["required_kanjya_tel"];
		$kanjya_birth = $_SESSION["required_kanjya_birth"];
		$hihokensya_simei = $_SESSION["required_hihokensya_simei"];
		$hihokensy_kana = $_SESSION["required_hihokensy_kana"];
		$hihokensya_yubin = $_SESSION["required_hihokensya_yubin"];
		$hihokensya_jyusyo = $_SESSION["required_hihokensya_jyusyo"];
		$hihokensya_jyusyo_kana = $_SESSION["required_hihokensya_jyusyo_kana"];
		$hihokensya_birth = $_SESSION["required_hihokensya_birth"];
		$kotei_kyori = $_SESSION["required_kotei_kyori"];
		$hokenjya_bango = $_SESSION["required_hokenjya_bango"];
		$hokenjya_mei = $_SESSION["required_hokenjya_mei"];
		$hihokenjya_kigou = $_SESSION["required_hihokenjya_kigou"];
		$hihokenjya_bango = $_SESSION["required_hihokenjya_bango"];
		$sityosonbango = $_SESSION["required_sityosonbango"];
		$jyukyusyabango = $_SESSION["required_jyukyusyabango"];
		$hatubyomataha = $_SESSION["required_hatubyomataha"];
		$hatubyonengappi = $_SESSION["required_hatubyonengappi"];
		$syoryonengappi = $_SESSION["required_syoryonengappi"];
		$sinsei_aten = $_SESSION["required_sinsei_aten"];
		$sinsei_aten2 = $_SESSION["required_sinsei_aten2"];
		$douiisi = $_SESSION["required_douiisi"];
		$douiisibyoin = $_SESSION["required_douiisibyoin"];
		$isi_yubin = $_SESSION["required_isi_yubin"];
		$isijyusyo = $_SESSION["required_isijyusyo"];
		$isinosyobyomei = $_SESSION["required_isinosyobyomei"];
		$douinengappi = $_SESSION["required_douinengappi"];
		$douikikan_ji = $_SESSION["required_douikikan_ji"];
		$doukikan_itaru = $_SESSION["required_doukikan_itaru"];
		$tekiyo = $_SESSION["required_tekiyo"];
		$from_chiryoin_kyori = $_SESSION["required_from_chiryoin_kyori"];
		$sinseikaisu = $_SESSION["required_sinseikaisu"];
		$other_ck = $_SESSION["required_other_ck"];
		$syutanto = $_SESSION["required_syutanto"];
		$kanjya_seibetu  = $_SESSION["required_kanjya_seibetu"];
		$hihokensya_seibetu  = $_SESSION["required_hihokensya_seibetu"];
		$ouryouryo_ck  = $_SESSION["required_ouryouryo_ck"];
		$kotei_ck  = $_SESSION["required_kotei_ck"];
		$zokugara = $_SESSION["required_zokugara"];
		$hokensyubetu = $_SESSION["required_hokensyubetu"];
		$syuhoken_wariai  = $_SESSION["required_syuhoken_wariai"];
		$kouhiumu = $_SESSION["required_kouhiumu"];
		$kouhihoken_wariai = $_SESSION["required_kouhihoken_wariai"];
		$gyoumujyou = $_SESSION["required_gyoumujyou"];
		$seikyukubun = $_SESSION["required_seikyukubun"];
		$tenki = $_SESSION["required_tenki"];
		$hari_bt  = $_SESSION["required_hari_bt"];
		$ma_bt  = $_SESSION["required_ma_bt"];
		$sejyutu = $_SESSION["required_sejyutu"];
		$sejyutunaiyo = $_SESSION["required_sejyutunaiyo"];
		$kotei_ck  = $_SESSION["required_hari_ck"];
		$ma_syobyomei  = $_SESSION["required_ma_syobyomei"];
		$hidari_jyosi  = $_SESSION["required_hidari_jyosi"];
		$migi_jyosi  = $_SESSION["required_migi_jyosi"];
		$hidari_kasi  = $_SESSION["required_hidari_kasi"];
		$migi_kasi  = $_SESSION["required_migi_kasi"];
		$kukan  = $_SESSION["required_kukan"];
		$onanpo  = $_SESSION["required_onanpo"];
		$denkikosen  = $_SESSION["required_denkikosen"];
		$henkei_ck1 = $_SESSION["required_henkei_ck1"];
		$henkei_ck2 = $_SESSION["required_henkei_ck2"];
		$henkei_ck3 = $_SESSION["required_henkei_ck3"];
		$henkei_ck4 = $_SESSION["required_henkei_ck4"];

		unset($_SESSION["required_ID"]);
		unset($_SESSION["required_kanjyamei"]);
		unset($_SESSION["required_kanjyamei_kana"]);
		unset($_SESSION["required_nick_name"]);
		unset($_SESSION["required_kanjya_yubin"]);
//		unset($_SESSION["required_kanjya_jyusyo"]);
		unset($_SESSION["required_kanjya_ido"]);
		unset($_SESSION["required_kanjya_keido"]);
		unset($_SESSION["required_kanjya_tel"]);
		unset($_SESSION["required_kanjya_birth"]);
		unset($_SESSION["required_hihokensya_simei"]);
		unset($_SESSION["required_hihokensy_kana"]);
		unset($_SESSION["required_hihokensya_yubin"]);
		unset($_SESSION["required_hihokensya_jyusyo"]);
		unset($_SESSION["required_hihokensya_jyusyo_kana"]);
		unset($_SESSION["required_hihokensya_birth"]);
		unset($_SESSION["required_kotei_kyori"]);
		unset($_SESSION["required_hokenjya_bango"]);
		unset($_SESSION["required_hokenjya_mei"]);
		unset($_SESSION["required_hihokenjya_kigou"]);
		unset($_SESSION["required_hihokenjya_bango"]);
		unset($_SESSION["required_sityosonbango"]);
		unset($_SESSION["required_jyukyusyabango"]);
		unset($_SESSION["required_hatubyomataha"]);
		unset($_SESSION["required_hatubyonengappi"]);
		unset($_SESSION["required_syoryonengappi"]);
		unset($_SESSION["required_sinsei_aten"]);
		unset($_SESSION["required_sinsei_aten2"]);
		unset($_SESSION["required_douiisi"]);
		unset($_SESSION["required_douiisibyoin"]);
		unset($_SESSION["required_isi_yubin"]);
		unset($_SESSION["required_isijyusyo"]);
		unset($_SESSION["required_isinosyobyomei"]);
		unset($_SESSION["required_douinengappi"]);
		unset($_SESSION["required_douikikan_ji"]);
		unset($_SESSION["required_doukikan_itaru"]);
		unset($_SESSION["required_tekiyo"]);
		unset($_SESSION["required_from_chiryoin_kyori"]);
		unset($_SESSION["required_sinseikaisu"]);
		unset($_SESSION["required_other_ck"]);
		unset($_SESSION["required_syutanto"]);
		unset($_SESSION["required_kanjya_seibetu"]);
		unset($_SESSION["required_hihokensya_seibetu"]);
		unset($_SESSION["required_ouryouryo_ck"]);
		unset($_SESSION["required_kotei_ck"]);
		unset($_SESSION["required_zokugara"]);
		unset($_SESSION["required_hokensyubetu"]);
		unset($_SESSION["required_syuhoken_wariai"]);
		unset($_SESSION["required_kouhiumu"]);
		unset($_SESSION["required_kouhihoken_wariai"]);
		unset($_SESSION["required_gyoumujyou"]);
		unset($_SESSION["required_seikyukubun"]);
		unset($_SESSION["required_tenki"]);
		unset($_SESSION["required_hari_bt"]);
		unset($_SESSION["required_ma_bt"]);
		unset($_SESSION["required_sejyutu"]);
		unset($_SESSION["required_sejyutunaiyo"]);
		unset($_SESSION["required_hari_ck"]);
		unset($_SESSION["required_ma_syobyomei"]);
		unset($_SESSION["required_hidari_jyosi"]);
		unset($_SESSION["required_migi_jyosi"]);
		unset($_SESSION["required_hidari_kasi"]);
		unset($_SESSION["required_migi_kasi"]);
		unset($_SESSION["required_kukan"]);
		unset($_SESSION["required_onanpo"]);
		unset($_SESSION["required_denkikosen"]);
		unset($_SESSION["required_henkei_ck1"]);
		unset($_SESSION["required_henkei_ck2"]);
		unset($_SESSION["required_henkei_ck3"]);
		unset($_SESSION["required_henkei_ck4"]);
		unset($_SESSION["lat"]);
		unset($_SESSION["lng"]);
		unset($_SESSION["err1"]);

unset($_SESSION["add"]);
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
//currentFNo = 0;
//function nextForm()
{//
//	if (event.keyCode == 13)
//	{
//		currentFNo++;
//		currentFNo %= document.edit.elements.length;
//		document.edit[currentFNo].focus();
//	}
//}
//window.document.onkeydown = nextForm;

</script>



</head>

<body>

<div id="wrapper">
	<div id="header"><br><br><br><br>
		<p class="headerTitle">患者情報 登録</p>
	</div>
	<label style="position: relative; left: 850px; top: 0px;"><?php echo $user_name  . " 様" ?></label>
	<br><br>

<form name="edit" action="appli_upload_action2.php" method="post" enctype="multipart/form-data" >
<br><br>
<table id="table_contact">

<tr>
<th width="150"><?=$NO?></td>
<td width="400"><?=$no?>
<input type="hidden" name="required_NO" value="<?=$no?>" /></td>
<input type="hidden" name="id" value="<?=$id?>" /></td>
</tr>
<tr>
<th><?=$SYUTANTO?></td>
<td><select name="required_syutanto">
	<?php
	if($sejyutusya_opt!=""){
		echo	$sejyutusya_opt;
	}else{
		echo	"<option value=\"a\">施術者を登録してください</option>";
	}
	?>
</td>
</tr>
<tr>
<th><?=$ID?></td>
<td><input type="text" name="required_ID" style="ime-mode: active" maxlength="50" size="50" value="<?=$id?>"/></td>
</tr>
<tr>
<th><?=$KANJYAMEI?></td>
<td><input type="text" name="required_kanjyamei" style="ime-mode: active" maxlength="50" size="50" value="<?=$kanjyamei?>"/></td>
</tr>
<tr>
<th><?=$KANJYAMEI_KANA?></td>
<td><input type="text" name="required_kanjyamei_kana" style="ime-mode: active" maxlength="50" size="50" value="<?=$kanjyamei_kana?>"/></td>
</tr>
<tr>
<th><?=$KANJYA_SEIBETU?></td>
<td>
<input type="radio" name="required_kanjya_seibetu" value="男性"<?php if ($kanjya_seibetu == '男性'){echo 'checked';}?>>男性
<input type="radio" name="required_kanjya_seibetu" value="女性"<?php if ($kanjya_seibetu == '女性'){echo 'checked';}?>>女性
</td>
</tr>
<tr>
<th><?=$NICK_NAME?></td>
<td><input type="text" name="required_nick_name" style="ime-mode: active" maxlength="50" size="50" value="<?=$nick_name?>"/></td>
</tr>
<tr>
<th><?=$KANJYA_YUBIN?></td>
<td><input type="text" name="required_kanjya_yubin" style="ime-mode: active" maxlength="50" size="50" value="<?=$kanjya_yubin?>"/></td>
</tr>
<tr>
<th><?=$KANJYA_JYUSYO?></td>
<td><input type="text" name="required_kanjya_jyusyo" style="ime-mode: active" maxlength="50" size="50" value="<?=$kanjya_jyusyo?>"/></td>
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
<th><?=$FROM_CHIRYOIN_KYORI?></td>
<td><input type="text" name="required_from_chiryoin_kyori" style="ime-mode: active" maxlength="10" size="10" value="<?=$from_chiryoin_kyori?>"/></td>
</tr>
<tr>
<th><?=$KANJYA_TEL?></td>
<td><input type="text" name="required_kanjya_tel" style="ime-mode: active" maxlength="50" size="50" value="<?=$kanjya_tel?>"/></td>
</tr>
<tr>
<th><?=$KANJYA_BIRTH?></td>
<td><input type="text" name="required_kanjya_birth" style="ime-mode: active" maxlength="50" size="50" value="<?=$kanjya_birth?>"/></td>
</tr>
<tr>
<th><?=$HIHOKENSYA_SIMEI?></td>
<td><input type="text" name="required_hihokensya_simei" style="ime-mode: active" maxlength="50" size="50" value="<?=$hihokensya_simei?>"/></td>
</tr>
<tr>
<th><?=$HIHOKENSY_KANA?></td>
<td><input type="text" name="required_hihokensy_kana" style="ime-mode: active" maxlength="50" size="50" value="<?=$hihokensy_kana?>"/></td>
</tr>
<tr>
<th><?=$HIHOKENSYA_SEIBETU?></td>
<td>
<input type="radio" name="required_hihokensya_seibetu" value="男性"<?php if ($hihokensya_seibetu == '男性'){echo 'checked';}?>>男性
<input type="radio" name="required_hihokensya_seibetu" value="女性"<?php if ($hihokensya_seibetu == '女性'){echo 'checked';}?>>女性
</td>
</tr>
<tr>
<th><?=$HIHOKENSYA_YUBIN?></td>
<td><input type="text" name="required_hihokensya_yubin" style="ime-mode: active" maxlength="50" size="50" value="<?=$hihokensya_yubin?>"/></td>
</tr>
<tr>
<th><?=$HIHOKENSYA_JYUSYO?></td>
<td><input type="text" name="required_hihokensya_jyusyo" style="ime-mode: active" maxlength="50" size="50" value="<?=$hihokensya_jyusyo?>"/></td>
</tr>
<tr>
<th><?=$HIHOKENSYA_JYUSYO_KANA?></td>
<td><input type="text" name="required_hihokensya_jyusyo_kana" style="ime-mode: active" maxlength="50" size="50" value="<?=$hihokensya_jyusyo_kana?>"/></td>
</tr>
<tr>
<th><?=$HIHOKENSYA_BIRTH?></td>
<td><input type="text" name="required_hihokensya_birth" style="ime-mode: active" maxlength="50" size="50" value="<?=$hihokensya_birth?>"/></td>
</tr>
<tr>
<th><?=$OURYOURYO_CK?></td>
<td>往療料
<input type="radio" name="required_ouryouryo_ck" value="あり"<?php if ($hihokensya_seibetu == 'あり'){echo 'checked';}?>>あり
<input type="radio" name="required_ouryouryo_ck" value="なし"<?php if ($hihokensya_seibetu == 'なし'){echo 'checked';}?>>なし
</td>
</tr>
<tr>
<th><?=$KOTEI_CK?></td>
<td><input type="checkbox" name="required_kotei_ck" value="1"<?php if ($kotei_ck == '1'){echo 'checked';}?>>距離を固定する&nbsp
<?=$KOTEI_KYORI?><input type="text" name="required_kotei_kyori" style="ime-mode: active" maxlength="10" size="10" value="<?=$kotei_kyori?>"/>m
</td>
</tr>
<tr>
<th><?=$ZOKUGARA?></td>
<td>
<select name="required_zokugara">
<option value=""<?php if ($zokugara == '') { print ' selected'; }; ?>>-</option>
<option value="本人"<?php if ($zokugara == "本人") { print ' selected'; }; ?>>本人</option>
<option value="妻"<?php if ($zokugara == "妻") { print ' selected'; }; ?>>妻</option>
<option value="母"<?php if ($zokugara == "母") { print ' selected'; }; ?>>母</option>
<option value="子"<?php if ($zokugara == "子") { print ' selected'; }; ?>>子</option>
<option value="父"<?php if ($zokugara == "父") { print ' selected'; }; ?>>父</option>
<option value="夫"<?php if ($zokugara == "夫") { print ' selected'; }; ?>>夫</option>
<option value="家族"<?php if ($zokugara == "家族") { print ' selected'; }; ?>>家族</option>
</select>
</td>
</tr>
<tr>
<th><?=$HOKENSYUBETU?></td>
<td>

<select name="required_hokensyubetu">
<option value="国民健康保険"<?php if ($hokensyubetu == "国民健康保険") { print ' selected'; }; ?>>国民健康保険</option>
<option value="社会保険"<?php if ($hokensyubetu == "社会保険") { print ' selected'; }; ?>>社会保険</option>
<option value="後期高齢者医療"<?php if ($hokensyubetu =="後期高齢者医療") { print ' selected'; }; ?>>後期高齢者医療</option>
<option value="特定疾患"<?php if ($hokensyubetu == "特定疾患") { print ' selected'; }; ?>>特定疾患</option>
<option value="生活保護"<?php if ($hokensyubetu == "生活保護") { print ' selected'; }; ?>>生活保護</option>
</select>

</td>
</tr>
<tr>
<th><?=$SYUHOKEN_WARIAI?></td>
<td>
<select name="required_syuhoken_wariai">
<option value="0"<?php if ($syuhoken_wariai == '0') { print ' selected'; }; ?>>0</option>
<option value="1"<?php if ($syuhoken_wariai == '1') { print ' selected'; }; ?>>1割</option>
<option value="2"<?php if ($syuhoken_wariai == '2') { print ' selected'; }; ?>>2割</option>
<option value="3"<?php if ($syuhoken_wariai == '3') { print ' selected'; }; ?>>3割</option>
</select>
</td>
</tr>
<tr>
<th><?=$HOKENJYA_BANGO?></td>
<td><input type="text" name="required_hokenjya_bango" style="ime-mode: active" maxlength="50" size="50" value="<?=$hokenjya_bango?>"/></td>
</tr>
<tr>
<th><?=$HOKENJYA_MEI?></td>
<td><input type="text" name="required_hokenjya_mei" style="ime-mode: active" maxlength="50" size="50" value="<?=$hokenjya_mei?>"/></td>
</tr>
<tr>
<th><?=$HIHOKENJYA_KIGOU?></td>
<td><input type="text" name="required_hihokenjya_kigou" style="ime-mode: active" maxlength="50" size="50" value="<?=$hihokenjya_kigou?>"/></td>
</tr>
<tr>
<th><?=$HIHOKENJYA_BANGO?></td>
<td><input type="text" name="required_hihokenjya_bango" style="ime-mode: active" maxlength="50" size="50" value="<?=$hihokenjya_bango?>"/></td>
</tr>
<tr>
<th><?=$KOUHIUMU?></td>
<td>
<select name="required_kouhiumu">
<option value="なし"<?php if ($kouhiumu == "") { print ' selected'; }; ?>>なし</option>
<option value="障害医療"<?php if ($kouhiumu == "障害医療") { print ' selected'; }; ?>>障害医療</option>
<option value="一人親医療"<?php if ($kouhiumu == "一人親医療") { print ' selected'; }; ?>>一人親医療</option>
<option value="一負助成"<?php if ($kouhiumu == "一負助成") { print ' selected'; }; ?>>一負助成</option>
<option value="老人医療"<?php if ($kouhiumu == "老人医療") { print ' selected'; }; ?>>老人医療</option>
<option value="特定疾患"<?php if ($kouhiumu == "特定疾患") { print ' selected'; }; ?>>特定疾患</option>
<option value="生活保護"<?php if ($kouhiumu == "生活保護") { print ' selected'; }; ?>>生活保護</option>
</select>
</td>
</tr>
<tr>
<th><?=$KOUHIHOKEN_WARIAI?></td>
<td>
<select name="required_kouhihoken_wariai">
<option value="0"<?php if ($kouhihoken_wariai == '0') { print ' selected'; }; ?>>0</option>
<option value="1"<?php if ($kouhihoken_wariai == '1') { print ' selected'; }; ?>>1割</option>
<option value="2"<?php if ($kouhihoken_wariai == '2') { print ' selected'; }; ?>>2割</option>
<option value="3"<?php if ($kouhihoken_wariai == '3') { print ' selected'; }; ?>>3割</option>
</select>
</td>
</tr>
<tr>
<th><?=$SITYOSONBANGO?></td>
<td><input type="text" name="required_sityosonbango" style="ime-mode: active" maxlength="50" size="50" value="<?=$sityosonbango?>"/></td>
</tr>
<tr>
<th><?=$JYUKYUSYABANGO?></td>
<td><input type="text" name="required_jyukyusyabango" style="ime-mode: active" maxlength="50" size="50" value="<?=$jyukyusyabango?>"/></td>
</tr>
<tr>
<th><?=$HATUBYOMATAHA?></td>
<td><input type="text" name="required_hatubyomataha" style="ime-mode: active" maxlength="50" size="50" value="<?=$hatubyomataha?>"/></td>
</tr>
<tr>
<th><?=$HATUBYONENGAPPI?></td>
<td><input type="text" name="required_hatubyonengappi" style="ime-mode: active" maxlength="50" size="50" value="<?=$hatubyonengappi?>"/></td>
</tr>
<tr>
<th><?=$GYOUMUJYOU?></td>
<td>
<select name="required_gyoumujyou">
<option value=""<?php if ($gyoumujyou == "") { print ' selected'; }; ?>></option>
<option value="業務上"<?php if ($gyoumujyou == "業務上") { print ' selected'; }; ?>>業務上</option>
<option value="第三者行為である"<?php if ($gyoumujyou == "第三者行為である") { print ' selected'; }; ?>>第三者行為である</option>
<option value="その他"<?php if ($gyoumujyou == "その他") { print ' selected'; }; ?>>その他</option>
</select>
</td>
</tr>
<tr>
<th><?=$SEIKYUKUBUN?></td>
<td>
<select name="required_seikyukubun">
<option value=""<?php if ($seikyukubun == "") { print ' selected'; }; ?>>-</option>
<option value="新規"<?php if ($seikyukubun == "新規") { print ' selected'; }; ?>>新規</option>
<option value="継続"<?php if ($seikyukubun == "継続") { print ' selected'; }; ?>>継続</option>
</select>
</td>
</tr>
<tr>
<th><?=$TENKI?></td>
<td>
<select name="required_tenki">
<option value=""<?php if ($tenki == "") { print ' selected'; }; ?>>-</option>
<option value="継続"<?php if ($tenki == "継続") { print ' selected'; }; ?>>継続</option>
<option value="治癒"<?php if ($tenki == "治癒") { print ' selected'; }; ?>>治癒</option>
<option value="中止"<?php if ($tenki == "中止") { print ' selected'; }; ?>>中止</option>
<option value="転医"<?php if ($tenki == "転医") { print ' selected'; }; ?>>転医</option>
</select>
</td>
</tr>
<tr>
<th><?=$SYORYONENGAPPI?></td>
<td><input type="text" name="required_syoryonengappi" style="ime-mode: active" maxlength="50" size="50" value="<?=$syoryonengappi?>"/></td>
</tr>
<tr>
<th><?=$SINSEI_ATEN?></td>
<td><input type="text" name="required_sinsei_aten" style="ime-mode: active" maxlength="50" size="50" value="<?=$sinsei_aten?>"/></td>
</tr>
<tr>
<th><?=$SINSEI_ATEN2?></td>
<td><input type="text" name="required_sinsei_aten2" style="ime-mode: active" maxlength="50" size="50" value="<?=$sinsei_aten2?>"/></td>
</tr>
<tr>
<th><?=$DOUIISI?></td>
<td><input type="text" name="required_douiisi" style="ime-mode: active" maxlength="50" size="50" value="<?=$douiisi?>"/></td>
</tr>
<tr>
<th><?=$DOUIISIBYOIN?></td>
<td><input type="text" name="required_douiisibyoin" style="ime-mode: active" maxlength="50" size="50" value="<?=$douiisibyoin?>"/></td>
</tr>
<tr>
<th><?=$ISI_YUBIN?></td>
<td><input type="text" name="required_isi_yubin" style="ime-mode: active" maxlength="50" size="50" value="<?=$isi_yubin?>"/></td>
</tr>
<tr>
<th><?=$ISIJYUSYO?></td>
<td><input type="text" name="required_isijyusyo" style="ime-mode: active" maxlength="50" size="50" value="<?=$isijyusyo?>"/></td>
</tr>
<tr>
<th><?=$ISINOSYOBYOMEI?></td>
<td><input type="text" name="required_isinosyobyomei" style="ime-mode: active" maxlength="50" size="50" value="<?=$isinosyobyomei?>"/></td>
</tr>
<tr>
<th><?=$DOUINENGAPPI?></td>
<td><input type="text" name="required_douinengappi" style="ime-mode: active" maxlength="50" size="50" value="<?=$douinengappi?>"/></td>
</tr>
<tr>
<th><?=$DOUIKIKAN_JI?></td>
<td><input type="text" name="required_douikikan_ji" style="ime-mode: active" maxlength="50" size="50" value="<?=$douikikan_ji?>"/></td>
</tr>
<tr>
<th><?=$DOUKIKAN_ITARU?></td>
<td><input type="text" name="required_doukikan_itaru" style="ime-mode: active" maxlength="50" size="50" value="<?=$doukikan_itaru?>"/></td>
</tr>
<tr>
<th><?=$TEKIYO?></td>
<td><input type="text" name="required_tekiyo" style="ime-mode: active" maxlength="50" size="50" value="<?=$tekiyo?>"/></td>
</tr>
<tr>
<th><?=$SINSEIKAISU?></td>
<td><input type="text" name="required_sinseikaisu" style="ime-mode: active" maxlength="50" size="50" value="<?=$sinseikaisu?>"/></td>
</tr>
<tr>
<th><?=$OTHER_CK?></td>
<td><input type="text" name="required_other_ck" style="ime-mode: active" maxlength="50" size="50" value="<?=$other_ck?>"/></td>
</tr>
<tr>
<th><?=$HA_MA?></td>
<td>
<input type="radio" name="required_hari_bt" value="1"<?php if ($hari_bt == '鍼灸'){echo 'checked';}?>>鍼灸
<input type="radio" name="required_ma_bt" value="1"<?php if ($ma_bt == 'マッサージ'){echo 'checked';}?>>マッサージ
</td>
</tr>
<tr>
<th><?=$SEJYUTU?></td>
<td>
<select name="required_sejyutu">
<option value=""<?php if ($sejyutu == '') { print ' selected'; }; ?>>本人</option>
<option value="1"<?php if ($sejyutu == '1') { print ' selected'; }; ?>>1術</option>
<option value="2"<?php if ($sejyutu == '2') { print ' selected'; }; ?>>2術</option>
</select>
</td>
</tr>
<tr>
<th><?=$SEJYUTUNAIYO?></td>
<td>
<select name="required_sejyutunaiyo">
<option value=""<?php if ($sejyutunaiyo == "") { print ' selected'; }; ?>>-</option>
<option value="はり・きゅう併用(電気鍼・電気温灸器併用)"<?php if ($sejyutunaiyo == "はり・きゅう併用(電気鍼・電気温灸器併用)") { print ' selected'; }; ?>>はり・きゅう併用(電気鍼・電気温灸器併用)</option>
<option value="はり・きゅう併用"<?php if ($sejyutunaiyo == "はり・きゅう併用") { print ' selected'; }; ?>>はり・きゅう併用</option>
<option value="はり(電気鍼併用)"<?php if ($sejyutunaiyo == "はり(電気鍼併用)") { print ' selected'; }; ?>>はり(電気鍼併用)</option>
<option value="はり"<?php if ($sejyutunaiyo == "はり") { print ' selected'; }; ?>>はり</option>
<option value="きゅう"<?php if ($sejyutunaiyo == "きゅう") { print ' selected'; }; ?>>きゅう</option>
</select>
</td>
</tr>
<tr>
<th><?=$TIRYO_SYOBYOMEI?></td>
<td>
<input type="checkbox" name="required_hari_ck1" value="a"<?php if ($kotei_ck == "a"){echo 'checked';}?>>神経痛
<input type="checkbox" name="required_hari_ck2" value="b"<?php if ($kotei_ck == "b"){echo 'checked';}?>>リウマチ
<input type="checkbox" name="required_hari_ck3" value="c"<?php if ($kotei_ck == "c"){echo 'checked';}?>>頸腕症候群<br>
<input type="checkbox" name="required_hari_ck4" value="d"<?php if ($kotei_ck == "d"){echo 'checked';}?>>五十肩
<input type="checkbox" name="required_hari_ck5" value="e"<?php if ($kotei_ck == "e"){echo 'checked';}?>>腰痛症
<input type="checkbox" name="required_hari_ck6" value="f"<?php if ($kotei_ck == "f"){echo 'checked';}?>>頚椎捻挫症後遺症<br>
<input type="checkbox" name="required_hari_ck7" value="g"<?php if ($kotei_ck == "g"){echo 'checked';}?>>その他
<input type="text" name="required_syoubyou_sonota" style="ime-mode: active" maxlength="50" size="40"  />
</td>
</tr>
<tr>
<th><?=$MA_SYOBYOMEI?></td>
<td>
<select name="required_ma_syobyomei">
<option value=""<?php if ($ma_syobyomei == ''){ print ' selected'; }; ?>>-</option>
<option value="脳梗塞後遺症"<?php if ($ma_syobyomei == '脳梗塞後遺症') { print ' selected'; }; ?>> 脳梗塞後遺症</option>
<option value="脳出血後遺症"<?php if ($ma_syobyomei == '脳出血後遺症') { print ' selected'; }; ?>> 脳出血後遺症</option>
<option value="くも膜下出血後遺症"<?php if ($ma_syobyomei == 'くも膜下出血後遺症') { print ' selected'; }; ?>> くも膜下出血後遺症</option>
<option value="頚肩関節周囲炎"<?php if ($ma_syobyomei == '頚肩関節周囲炎') { print ' selected'; }; ?>> 頚肩関節周囲炎</option>
<option value="頚肩腕症候群"<?php if ($ma_syobyomei == '頚肩腕症候群') { print ' selected'; }; ?>> 頚肩腕症候群</option>
<option value="パーキンソン病"<?php if ($ma_syobyomei == 'パーキンソン病') { print ' selected'; }; ?>> パーキンソン病</option>
<option value="多発性脳梗塞"<?php if ($ma_syobyomei == '多発性脳梗塞') { print ' selected'; }; ?>> 多発性脳梗塞</option>
<option value="バーチャ病"<?php if ($ma_syobyomei == 'バーチャ病') { print ' selected'; }; ?>> バーチャ病</option>
<option value="筋ジストロフィー"<?php if ($ma_syobyomei == '筋ジストロフィー') { print ' selected'; }; ?>> 筋ジストロフィー</option>
<option value="ニューロパチー"<?php if ($ma_syobyomei == 'ニューロパチー') { print ' selected'; }; ?>> ニューロパチー</option>
<option value="純粋アキネジア"<?php if ($ma_syobyomei == '純粋アキネジア') { print ' selected'; }; ?>> 純粋アキネジア</option>
<option value="神経陰性膀胱"<?php if ($ma_syobyomei == '神経陰性膀胱') { print ' selected'; }; ?>> 神経陰性膀胱</option>
<option value="膝関節症"<?php if ($ma_syobyomei == '膝関節症') { print ' selected'; }; ?>> 膝関節症</option>
<option value="骨折後遺症"<?php if ($ma_syobyomei == '骨折後遺症') { print ' selected'; }; ?>> 骨折後遺症</option>
<option value="慢性関節リウマチ"<?php if ($ma_syobyomei == '慢性関節リウマチ') { print ' selected'; }; ?>> 慢性関節リウマチ</option>
<option value="脊椎管ヘルニア"<?php if ($ma_syobyomei == '脊椎管ヘルニア') { print ' selected'; }; ?>> 脊椎管ヘルニア</option>
<option value="多発性関節リウマチ"<?php if ($ma_syobyomei == '多発性関節リウマチ') { print ' selected'; }; ?>> 多発性関節リウマチ</option>
<option value="腰椎椎間板ヘルニア"<?php if ($ma_syobyomei == '腰椎椎間板ヘルニア') { print ' selected'; }; ?>> 腰椎椎間板ヘルニア</option>
<option value="脳性麻痺"<?php if ($ma_syobyomei == '脳性麻痺') { print ' selected'; }; ?>> 脳性麻痺</option>
<option value="頚椎損傷"<?php if ($ma_syobyomei == '頚椎損傷') { print ' selected'; }; ?>> 頚椎損傷</option>
<option value="頸髄損傷"<?php if ($ma_syobyomei == '頸髄損傷') { print ' selected'; }; ?>> 頸髄損傷</option>
<option value="広範囲脊柱狭窄症"<?php if ($ma_syobyomei == '広範囲脊柱狭窄症') { print ' selected'; }; ?>> 広範囲脊柱狭窄症</option>
<option value="大腿骨頚部骨折後遺症"<?php if ($ma_syobyomei == '大腿骨頚部骨折後遺症') { print ' selected'; }; ?>> 大腿骨頚部骨折後遺症</option>
<option value="腰（胸）椎圧迫骨折後遺症"<?php if ($ma_syobyomei == '腰（胸）椎圧迫骨折後遺症') { print ' selected'; }; ?>> 腰（胸）椎圧迫骨折後遺症</option>
<option value="四肢筋萎縮"<?php if ($ma_syobyomei == '四肢筋萎縮') { print ' selected'; }; ?>> 四肢筋萎縮</option>
<option value="大脳皮質萎縮"<?php if ($ma_syobyomei == '大脳皮質萎縮') { print ' selected'; }; ?>> 大脳皮質萎縮</option>
<option value="多系統萎縮症"<?php if ($ma_syobyomei == '多系統萎縮症') { print ' selected'; }; ?>> 多系統萎縮症</option>
<option value="脊髄小脳変性症"<?php if ($ma_syobyomei == '脊髄小脳変性症') { print ' selected'; }; ?>> 脊髄小脳変性症</option>
<option value="サルコイドーシス"<?php if ($ma_syobyomei == 'サルコイドーシス') { print ' selected'; }; ?>> サルコイドーシス</option>
<option value="末梢神経障害"<?php if ($ma_syobyomei == '末梢神経障害') { print ' selected'; }; ?>> 末梢神経障害</option>
<option value="ギランバレー症候群"<?php if ($ma_syobyomei == 'ギランバレー症候群') { print ' selected'; }; ?>> ギランバレー症候群</option>
<option value="筋萎縮症"<?php if ($ma_syobyomei == '筋萎縮症') { print ' selected'; }; ?>> 筋萎縮症</option>
<option value="筋萎縮性側索硬化症"<?php if ($ma_syobyomei == '筋萎縮性側索硬化症') { print ' selected'; }; ?>> 筋萎縮性側索硬化症</option>
<option value="全身廃用症候群"<?php if ($ma_syobyomei == '全身廃用症候群') { print ' selected'; }; ?>> 全身廃用症候群</option>
<option value="上下肢筋肉廃用性萎縮"<?php if ($ma_syobyomei == '上下肢筋肉廃用性萎縮') { print ' selected'; }; ?>> 上下肢筋肉廃用性萎縮</option>
<option value="閉塞性動脈硬化症"<?php if ($ma_syobyomei == '閉塞性動脈硬化症') { print ' selected'; }; ?>> 閉塞性動脈硬化症</option>
<option value="長期透析合併症による関節障害"<?php if ($ma_syobyomei == '長期透析合併症による関節障害') { print ' selected'; }; ?>> 長期透析合併症による関節障害</option>
<option value="多発性筋炎"<?php if ($ma_syobyomei == '多発性筋炎') { print ' selected'; }; ?>> 多発性筋炎</option>
<option value="筋肉痛・筋力低下"<?php if ($ma_syobyomei == '筋肉痛・筋力低下') { print ' selected'; }; ?>> 筋肉痛・筋力低下</option>
<option value="打撲後遺症"<?php if ($ma_syobyomei == '打撲後遺症') { print ' selected'; }; ?>> 打撲後遺症</option>
<option value="ミトコンドリア脳節症"<?php if ($ma_syobyomei == 'ミトコンドリア脳節症') { print ' selected'; }; ?>> ミトコンドリア脳節症</option>
<option value="閉寒性動脈硬化症"<?php if ($ma_syobyomei == '閉寒性動脈硬化症') { print ' selected'; }; ?>> 閉寒性動脈硬化症</option>
<option value="肺気種"<?php if ($ma_syobyomei == '肺気種') { print ' selected'; }; ?>> 肺気種</option>
<option value="肺炎"<?php if ($ma_syobyomei == '肺炎') { print ' selected'; }; ?>> 肺炎</option>
<option value="特発性血小板減少性紫斑"<?php if ($ma_syobyomei == '特発性血小板減少性紫斑') { print ' selected'; }; ?>> 特発性血小板減少性紫斑</option>
<option value="慢性呼吸不全"<?php if ($ma_syobyomei == '慢性呼吸不全') { print ' selected'; }; ?>> 慢性呼吸不全</option>
</select>
</td>
</tr>
<tr>
<th><?=$MA_SEJYUTUKYOKUSYO?></td>
<td>
<input type="checkbox" name="required_hidari_jyosi" value="1"<?php if ($hidari_jyosi == '1'){echo 'checked';}?>>左上肢
<input type="checkbox" name="required_migi_jyosi" value="1"<?php if ($migi_jyosi == '1'){echo 'checked';}?>>右上肢
<input type="checkbox" name="required_hidari_kasi" value="1"<?php if ($hidari_kasi == '1'){echo 'checked';}?>>左下肢
<input type="checkbox" name="required_migi_kasi" value="1"<?php if ($migi_kasi == '1'){echo 'checked';}?>>右下肢
<input type="checkbox" name="required_kukan" value="1"<?php if ($kukan == '1'){echo 'checked';}?>>躯幹
</td>
</tr>
<tr>
<th><?=$ONANPO?></td>
<td><input type="checkbox" name="required_onanpo" value="1"<?php if ($onanpo == "1"){echo 'checked';}?>>温罨法</td>
</tr>
<tr>
<th><?=$DENKIKOSEN?></td>
<td><input type="checkbox" name="required_denkikosen" value="1"<?php if ($denkikosen == "1"){echo 'checked';}?>>電機光線</td>
</tr>
<tr>
<th><?=$HENKEITOSYU?></td>
<td>
<input type="checkbox" name="required_henkei_ck1" value="a"<?php if ($hidari_jyosi == "a"){echo 'checked';}?>>左上肢
<input type="checkbox" name="required_henkei_ck2" value="b"<?php if ($hidari_jyosi == "b"){echo 'checked';}?>>右上肢
<input type="checkbox" name="required_henkei_ck3" value="c"<?php if ($hidari_jyosi == "c"){echo 'checked';}?>>左下肢
<input type="checkbox" name="required_henkei_ck4" value="d"<?php if ($hidari_jyosi == "d"){echo 'checked';}?>>右下肢
</td>
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
	<p id="copyright">Copyright© 2010 日本マッサージ師支援協会(訪問マッサージ｜在宅医療マッサージ｜大阪)</br>
				〜笑顔と感謝そしておかげさま〜 All Rights Reserved.</p>
</div>

</body>

</html>