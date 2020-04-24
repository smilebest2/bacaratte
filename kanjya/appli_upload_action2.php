<?php
session_start();

require_once '../common/mysql.php';

require_once '../common/const.php';

require_once '../common/function.php';


$mId =$_SESSION["mid"];

/**

 * キャンセル

 */

	if (isset($_POST['cancel'])) {

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
		unset($_SESSION["lat"]);
		unset($_SESSION["lng"]);
		unset($_SESSION["err1"]);

		$_SESSION["uid"]=$_SESSION["kneid"];
		$_SESSION["kneid"]="";

		header("Location:".url_kanjya);

		exit;

	}


/**

 * 緯度経度の取得

 */

 	if (isset($_POST['ido_keido_get_bt'])){

	$_SESSION["keid"]=$_SESSION["kneid"];
	$_SESSION["kneid"]="";

	$latlng = get_gps_from_address($_POST["required_kanjya_jyusyo"]);

	//距離計算
	if (isset($latlng['lng'])){
		$ng_flg="";

			$seNO=htmlspecialchars($_POST["required_syutanto"], ENT_QUOTES);
			$mysql = new MySQL_cls();
			$mysql->MySQL();
			$sql = "select ido,keido from SEJYUTUSYA where NO = '$seNO'";
			$mysql->actQuery($sql);
			while (($row_se = $mysql->getResult())){
				$se_ido= $row_se["ido"];
				$se_keido= $row_se["keido"];
			}
			$ka_ido=htmlspecialchars($_POST["required_kanjya_ido"], ENT_QUOTES);
			$ka_keido=htmlspecialchars($_POST["required_kanjya_keido"], ENT_QUOTES);
			$kyori="";
			$kyori_rtn=location_distance($latlng['lat'], $latlng['lng'], $se_ido, $se_keido);
			$kyori=$kyori_rtn["distance_unit"];
	}




	if (isset($latlng['lat'])){
	$_SESSION['add'] = $_POST["required_kanjya_jyusyo"];
	$_SESSION['lat'] = $latlng['lat'];
	$_SESSION['lng'] = $latlng['lng'];
	$_SESSION['out'] = $latlng['out'];

	$_SESSION["required_ID"] = $_POST["required_ID"];
	$_SESSION["required_kanjyamei"] = $_POST["required_kanjyamei"];
	$_SESSION["required_kanjyamei_kana"] = $_POST["required_kanjyamei_kana"];
	$_SESSION["required_nick_name"] = $_POST["required_nick_name"];
	$_SESSION["required_kanjya_yubin"] = $_POST["required_kanjya_yubin"];
	$_SESSION["required_kanjya_jyusyo"] = $_POST["required_kanjya_jyusyo"];
	$_SESSION["required_kanjya_ido"] = $_POST["required_kanjya_ido"];
	$_SESSION["required_kanjya_keido"] = $_POST["required_kanjya_keido"];
	$_SESSION["required_kanjya_tel"] = $_POST["required_kanjya_tel"];
	$_SESSION["required_kanjya_birth"] = $_POST["required_kanjya_birth"];
	$_SESSION["required_hihokensya_simei"] = $_POST["required_hihokensya_simei"];
	$_SESSION["required_hihokensy_kana"] = $_POST["required_hihokensy_kana"];
	$_SESSION["required_hihokensya_yubin"] = $_POST["required_hihokensya_yubin"];
	$_SESSION["required_hihokensya_jyusyo"] = $_POST["required_hihokensya_jyusyo"];
	$_SESSION["required_hihokensya_jyusyo_kana"] = $_POST["required_hihokensya_jyusyo_kana"];
	$_SESSION["required_hihokensya_birth"] = $_POST["required_hihokensya_birth"];
	$_SESSION["required_kotei_kyori"] = $_POST["required_kotei_kyori"];
	$_SESSION["required_hokenjya_bango"] = $_POST["required_hokenjya_bango"];
	$_SESSION["required_hokenjya_mei"] = $_POST["required_hokenjya_mei"];
	$_SESSION["required_hihokenjya_kigou"] = $_POST["required_hihokenjya_kigou"];
	$_SESSION["required_hihokenjya_bango"] = $_POST["required_hihokenjya_bango"];
	$_SESSION["required_sityosonbango"] = $_POST["required_sityosonbango"];
	$_SESSION["required_jyukyusyabango"] = $_POST["required_jyukyusyabango"];
	$_SESSION["required_hatubyomataha"] = $_POST["required_hatubyomataha"];
	$_SESSION["required_hatubyonengappi"] = $_POST["required_hatubyonengappi"];
	$_SESSION["required_syoryonengappi"] = $_POST["required_syoryonengappi"];
	$_SESSION["required_sinsei_aten"] = $_POST["required_sinsei_aten"];
	$_SESSION["required_sinsei_aten2"] = $_POST["required_sinsei_aten2"];
	$_SESSION["required_douiisi"] = $_POST["required_douiisi"];
	$_SESSION["required_douiisibyoin"] = $_POST["required_douiisibyoin"];
	$_SESSION["required_isi_yubin"] = $_POST["required_isi_yubin"];
	$_SESSION["required_isijyusyo"] = $_POST["required_isijyusyo"];
	$_SESSION["required_isinosyobyomei"] = $_POST["required_isinosyobyomei"];
	$_SESSION["required_douinengappi"] = $_POST["required_douinengappi"];
	$_SESSION["required_douikikan_ji"] = $_POST["required_douikikan_ji"];
	$_SESSION["required_doukikan_itaru"] = $_POST["required_doukikan_itaru"];
	$_SESSION["required_tekiyo"] = $_POST["required_tekiyo"];
	$_SESSION["required_from_chiryoin_kyori"] = $kyori;
	$_SESSION["required_sinseikaisu"] = $_POST["required_sinseikaisu"];
	$_SESSION["required_other_ck"] = $_POST["required_other_ck"];
	$_SESSION["required_syutanto"] = $_POST["required_syutanto"];
	$_SESSION["required_kanjya_seibetu"] = $_POST["required_kanjya_seibetu"];
	$_SESSION["required_hihokensya_seibetu"] = $_POST["required_hihokensya_seibetu"];
	$_SESSION["required_ouryouryo_ck"] = $_POST["required_ouryouryo_ck"];
	$_SESSION["required_kotei_ck"] = $_POST["required_kotei_ck"];
	$_SESSION["required_zokugara"] = $_POST["required_zokugara"];
	$_SESSION["required_hokensyubetu"] = $_POST["required_hokensyubetu"];
	$_SESSION["required_syuhoken_wariai"] = $_POST["required_syuhoken_wariai"];
	$_SESSION["required_kouhiumu"] = $_POST["required_kouhiumu"];
	$_SESSION["required_kouhihoken_wariai"] = $_POST["required_kouhihoken_wariai"];
	$_SESSION["required_gyoumujyou"] = $_POST["required_gyoumujyou"];
	$_SESSION["required_seikyukubun"] = $_POST["required_seikyukubun"];
	$_SESSION["required_tenki"] = $_POST["required_tenki"];
	$_SESSION["required_hari_bt"] = $_POST["required_hari_bt"];
	$_SESSION["required_ma_bt"] = $_POST["required_ma_bt"];
	$_SESSION["required_sejyutu"] = $_POST["required_sejyutu"];
	$_SESSION["required_sejyutunaiyo"] = $_POST["required_sejyutunaiyo"];
	$_SESSION["required_hari_ck"] = $_POST["required_hari_ck"];
	$_SESSION["required_ma_syobyomei"] = $_POST["required_ma_syobyomei"];
	$_SESSION["required_hidari_jyosi"] = $_POST["required_hidari_jyosi"];
	$_SESSION["required_migi_jyosi"] = $_POST["required_migi_jyosi"];
	$_SESSION["required_hidari_kasi"] = $_POST["required_hidari_kasi"];
	$_SESSION["required_migi_kasi"] = $_POST["required_migi_kasi"];
	$_SESSION["required_kukan"] = $_POST["required_kukan"];
	$_SESSION["required_onanpo"] = $_POST["required_onanpo"];
	$_SESSION["required_denkikosen"] = $_POST["required_denkikosen"];
	$_SESSION["required_henkei_ck1"] = $_POST["required_henkei_ck1"];
	$_SESSION["required_henkei_ck2"] = $_POST["required_henkei_ck2"];
	$_SESSION["required_henkei_ck3"] = $_POST["required_henkei_ck3"];
	$_SESSION["required_henkei_ck4"] = $_POST["required_henkei_ck4"];


	header("Location:".url_kanjya_edit);
	exit;
	}
	else{
	$_SESSION['add'] = "-------該当する緯度経度が見つかりません。住所を再入力ください。-------";

	$_SESSION["required_ID"] = $_POST["required_ID"];
	$_SESSION["required_kanjyamei"] = $_POST["required_kanjyamei"];
	$_SESSION["required_kanjyamei_kana"] = $_POST["required_kanjyamei_kana"];
	$_SESSION["required_nick_name"] = $_POST["required_nick_name"];
	$_SESSION["required_kanjya_yubin"] = $_POST["required_kanjya_yubin"];


	$_SESSION["required_kanjya_tel"] = $_POST["required_kanjya_tel"];
	$_SESSION["required_kanjya_birth"] = $_POST["required_kanjya_birth"];
	$_SESSION["required_hihokensya_simei"] = $_POST["required_hihokensya_simei"];
	$_SESSION["required_hihokensy_kana"] = $_POST["required_hihokensy_kana"];
	$_SESSION["required_hihokensya_yubin"] = $_POST["required_hihokensya_yubin"];
	$_SESSION["required_hihokensya_jyusyo"] = $_POST["required_hihokensya_jyusyo"];
	$_SESSION["required_hihokensya_jyusyo_kana"] = $_POST["required_hihokensya_jyusyo_kana"];
	$_SESSION["required_hihokensya_birth"] = $_POST["required_hihokensya_birth"];
	$_SESSION["required_kotei_kyori"] = $_POST["required_kotei_kyori"];
	$_SESSION["required_hokenjya_bango"] = $_POST["required_hokenjya_bango"];
	$_SESSION["required_hokenjya_mei"] = $_POST["required_hokenjya_mei"];
	$_SESSION["required_hihokenjya_kigou"] = $_POST["required_hihokenjya_kigou"];
	$_SESSION["required_hihokenjya_bango"] = $_POST["required_hihokenjya_bango"];
	$_SESSION["required_sityosonbango"] = $_POST["required_sityosonbango"];
	$_SESSION["required_jyukyusyabango"] = $_POST["required_jyukyusyabango"];
	$_SESSION["required_hatubyomataha"] = $_POST["required_hatubyomataha"];
	$_SESSION["required_hatubyonengappi"] = $_POST["required_hatubyonengappi"];
	$_SESSION["required_syoryonengappi"] = $_POST["required_syoryonengappi"];
	$_SESSION["required_sinsei_aten"] = $_POST["required_sinsei_aten"];
	$_SESSION["required_sinsei_aten2"] = $_POST["required_sinsei_aten2"];
	$_SESSION["required_douiisi"] = $_POST["required_douiisi"];
	$_SESSION["required_douiisibyoin"] = $_POST["required_douiisibyoin"];
	$_SESSION["required_isi_yubin"] = $_POST["required_isi_yubin"];
	$_SESSION["required_isijyusyo"] = $_POST["required_isijyusyo"];
	$_SESSION["required_isinosyobyomei"] = $_POST["required_isinosyobyomei"];
	$_SESSION["required_douinengappi"] = $_POST["required_douinengappi"];
	$_SESSION["required_douikikan_ji"] = $_POST["required_douikikan_ji"];
	$_SESSION["required_doukikan_itaru"] = $_POST["required_doukikan_itaru"];
	$_SESSION["required_tekiyo"] = $_POST["required_tekiyo"];
	//距離計算の場合の判定処理
	if($kyori != ""){
//				if($ng_flg!="not_data"){
			$_SESSION["required_from_chiryoin_kyori"] = $kyori;
//				}else{
//					$_SESSION["required_from_chiryoin_kyori"] ="緯度経度を先に取得してください。";
//				}
		$_SESSION["required_kanjya_jyusyo"] = $_POST["required_kanjya_jyusyo"];
		$_SESSION["required_kanjya_ido"] = $_POST["required_kanjya_ido"];
		$_SESSION["required_kanjya_keido"] = $_POST["required_kanjya_keido"];
		}else{
		$_SESSION["required_from_chiryoin_kyori"] ="";		//緯度経度の取得時は距離をクリア
		$_SESSION["required_kanjya_jyusyo"] = "-------該当する緯度経度が見つかりません。住所を再入力ください。-------";
		$_SESSION["required_kanjya_ido"] = "";
		$_SESSION["required_kanjya_keido"] ="";
	}
	$_SESSION["required_sinseikaisu"] = $_POST["required_sinseikaisu"];
	$_SESSION["required_other_ck"] = $_POST["required_other_ck"];
	$_SESSION["required_syutanto"] = $_POST["required_syutanto"];
	$_SESSION["required_kanjya_seibetu"] = $_POST["required_kanjya_seibetu"];
	$_SESSION["required_hihokensya_seibetu"] = $_POST["required_hihokensya_seibetu"];
	$_SESSION["required_ouryouryo_ck"] = $_POST["required_ouryouryo_ck"];
	$_SESSION["required_kotei_ck"] = $_POST["required_kotei_ck"];
	$_SESSION["required_zokugara"] = $_POST["required_zokugara"];
	$_SESSION["required_hokensyubetu"] = $_POST["required_hokensyubetu"];
	$_SESSION["required_syuhoken_wariai"] = $_POST["required_syuhoken_wariai"];
	$_SESSION["required_kouhiumu"] = $_POST["required_kouhiumu"];
	$_SESSION["required_kouhihoken_wariai"] = $_POST["required_kouhihoken_wariai"];
	$_SESSION["required_gyoumujyou"] = $_POST["required_gyoumujyou"];
	$_SESSION["required_seikyukubun"] = $_POST["required_seikyukubun"];
	$_SESSION["required_tenki"] = $_POST["required_tenki"];
	$_SESSION["required_hari_bt"] = $_POST["required_hari_bt"];
	$_SESSION["required_ma_bt"] = $_POST["required_ma_bt"];
	$_SESSION["required_sejyutu"] = $_POST["required_sejyutu"];
	$_SESSION["required_sejyutunaiyo"] = $_POST["required_sejyutunaiyo"];
	$_SESSION["required_hari_ck"] = $_POST["required_hari_ck"];
	$_SESSION["required_ma_syobyomei"] = $_POST["required_ma_syobyomei"];
	$_SESSION["required_hidari_jyosi"] = $_POST["required_hidari_jyosi"];
	$_SESSION["required_migi_jyosi"] = $_POST["required_migi_jyosi"];
	$_SESSION["required_hidari_kasi"] = $_POST["required_hidari_kasi"];
	$_SESSION["required_migi_kasi"] = $_POST["required_migi_kasi"];
	$_SESSION["required_kukan"] = $_POST["required_kukan"];
	$_SESSION["required_onanpo"] = $_POST["required_onanpo"];
	$_SESSION["required_denkikosen"] = $_POST["required_denkikosen"];
	$_SESSION["required_henkei_ck1"] = $_POST["required_henkei_ck1"];
	$_SESSION["required_henkei_ck2"] = $_POST["required_henkei_ck2"];
	$_SESSION["required_henkei_ck3"] = $_POST["required_henkei_ck3"];
	$_SESSION["required_henkei_ck4"] = $_POST["required_henkei_ck4"];

	header("Location:".url_kanjya_edit);
	exit;
	}
 	}

$id=$_POST['id'];

$new_no= "";
$new_id= "";
$new_kanjyamei= "";
$new_kanjyamei_kana= "";
$new_kanjya_seibetu= "";
$new_kanjya_yubin= "";
$new_kanjya_jyusyo= "";
$new_nick_name= "";
$new_kanjya_ido= "";
$new_kanjya_keido= "";
$new_kanjya_tel= "";
$new_kanjya_birth= "";
$new_hihokensya_simei= "";
$new_hihokensy_kana= "";
$new_hihokensya_seibetu= "";
$new_hihokensya_yubin= "";
$new_hihokensya_jyusyo= "";
$new_hihokensya_jyusyo_kana= "";
$new_hihokensya_birth= "";
$new_ouryouryo_ck= "";
$new_zokugara= "";
$new_hokensyubetu= "";
$new_hokenjya_bango= "";
$new_hokenjya_mei= "";
$new_hihokenjya_kigou= "";
$new_hihokenjya_bango= "";
$new_kouhiumu= "";
$new_sityosonbango= "";
$new_jyukyusyabango= "";
$new_syuhoken_wariai= "";
$new_kouhihoken_wariai= "";
$new_sejyutu= "";
$new_sejyutunaiyo= "";
$new_hatubyomataha= "";
$new_hatubyonengappi= "";
$new_tiryo_syobyomei= "";
$new_gyoumujyou= "";
$new_seikyukubun= "";
$new_tenki= "";
$new_syoryonengappi= "";
$new_sinsei_aten= "";
$new_sinsei_aten2= "";
$new_douiisi= "";
$new_douiisibyoin= "";
$new_isi_yubin= "";
$new_isijyusyo= "";
$new_isinosyobyomei= "";
$new_douinengappi= "";
$new_douikikan_ji= "";
$new_doukikan_itaru= "";
$new_tekiyo= "";
$new_from_chiryoin_kyori= "";
$new_sinseikaisu= "";
$new_syoubyou_sonota= "";
$new_other_ck= "";
$new_syutanto= "";
$new_hukutanto= "";
$new_ma_syobyomei= "";
$new_hidari_jyosi= "";
$new_migi_jyosi= "";
$new_hidari_kasi= "";
$new_migi_kasi= "";
$new_kukan= "";
$new_onanpo= "";
$new_denkikosen= "";
$new_henkeitosyu= "";
$new_ma_bt= "";
$new_hari_bt= "";
$new_kotei_ck= "";
$new_kotei_kyori= "";


$_REQUEST["required_kanjya_seibetu"];
$new_NO= htmlspecialchars($_POST["required_NO"], ENT_QUOTES);
$new_id= htmlspecialchars($_POST["required_ID"], ENT_QUOTES);
$new_kanjyamei= htmlspecialchars($_POST["required_kanjyamei"], ENT_QUOTES);
$new_kanjyamei_kana= htmlspecialchars($_POST["required_kanjyamei_kana"], ENT_QUOTES);
$new_kanjya_seibetu= htmlspecialchars($_POST["required_kanjya_seibetu"], ENT_QUOTES);
$new_kanjya_yubin= htmlspecialchars($_POST["required_kanjya_yubin"], ENT_QUOTES);
$new_kanjya_jyusyo= htmlspecialchars($_POST["required_kanjya_jyusyo"], ENT_QUOTES);
$new_nick_name= htmlspecialchars($_POST["required_nick_name"], ENT_QUOTES);
$new_kanjya_ido= htmlspecialchars($_POST["required_kanjya_ido"], ENT_QUOTES);
$new_kanjya_keido= htmlspecialchars($_POST["required_kanjya_keido"], ENT_QUOTES);
$new_kanjya_tel= htmlspecialchars($_POST["required_kanjya_tel"], ENT_QUOTES);
$new_kanjya_birth= htmlspecialchars($_POST["required_kanjya_birth"], ENT_QUOTES);
$new_hihokensya_simei= htmlspecialchars($_POST["required_hihokensya_simei"], ENT_QUOTES);
$new_hihokensy_kana= htmlspecialchars($_POST["required_hihokensy_kana"], ENT_QUOTES);
$new_hihokensya_seibetu= htmlspecialchars($_POST["required_hihokensya_seibetu"], ENT_QUOTES);
$new_hihokensya_yubin= htmlspecialchars($_POST["required_hihokensya_yubin"], ENT_QUOTES);
$new_hihokensya_jyusyo= htmlspecialchars($_POST["required_hihokensya_jyusyo"], ENT_QUOTES);
$new_hihokensya_jyusyo_kana= htmlspecialchars($_POST["required_hihokensya_jyusyo_kana"], ENT_QUOTES);
$new_hihokensya_birth= htmlspecialchars($_POST["required_hihokensya_birth"], ENT_QUOTES);
$new_ouryouryo_ck= htmlspecialchars($_POST["required_ouryouryo_ck"], ENT_QUOTES);
$new_zokugara= htmlspecialchars($_POST["required_zokugara"], ENT_QUOTES);
$new_hokensyubetu= htmlspecialchars($_POST["required_hokensyubetu"], ENT_QUOTES);
$new_hokenjya_bango= htmlspecialchars($_POST["required_hokenjya_bango"], ENT_QUOTES);
$new_hokenjya_mei= htmlspecialchars($_POST["required_hokenjya_mei"], ENT_QUOTES);
$new_hihokenjya_kigou= htmlspecialchars($_POST["required_hihokenjya_kigou"], ENT_QUOTES);
$new_hihokenjya_bango= htmlspecialchars($_POST["required_hihokenjya_bango"], ENT_QUOTES);
$new_kouhiumu= htmlspecialchars($_POST["required_kouhiumu"], ENT_QUOTES);
$new_sityosonbango= htmlspecialchars($_POST["required_sityosonbango"], ENT_QUOTES);
$new_jyukyusyabango= htmlspecialchars($_POST["required_jyukyusyabango"], ENT_QUOTES);
$new_syuhoken_wariai= htmlspecialchars($_POST["required_syuhoken_wariai"], ENT_QUOTES);
$new_kouhihoken_wariai= htmlspecialchars($_POST["required_kouhihoken_wariai"], ENT_QUOTES);
$new_sejyutu= htmlspecialchars($_POST["required_sejyutu"], ENT_QUOTES);
$new_sejyutunaiyo= htmlspecialchars($_POST["required_sejyutunaiyo"], ENT_QUOTES);
$new_hatubyomataha= htmlspecialchars($_POST["required_hatubyomataha"], ENT_QUOTES);
$new_hatubyonengappi= htmlspecialchars($_POST["required_hatubyonengappi"], ENT_QUOTES);

$new_gyoumujyou= htmlspecialchars($_POST["required_gyoumujyou"], ENT_QUOTES);
$new_seikyukubun= htmlspecialchars($_POST["required_seikyukubun"], ENT_QUOTES);
$new_tenki= htmlspecialchars($_POST["required_tenki"], ENT_QUOTES);
$new_syoryonengappi= htmlspecialchars($_POST["required_syoryonengappi"], ENT_QUOTES);
$new_sinsei_aten= htmlspecialchars($_POST["required_sinsei_aten"], ENT_QUOTES);
$new_sinsei_aten2= htmlspecialchars($_POST["required_sinsei_aten2"], ENT_QUOTES);
$new_douiisi= htmlspecialchars($_POST["required_douiisi"], ENT_QUOTES);
$new_douiisibyoin= htmlspecialchars($_POST["required_douiisibyoin"], ENT_QUOTES);
$new_isi_yubin= htmlspecialchars($_POST["required_isi_yubin"], ENT_QUOTES);
$new_isijyusyo= htmlspecialchars($_POST["required_isijyusyo"], ENT_QUOTES);
$new_isinosyobyomei= htmlspecialchars($_POST["required_isinosyobyomei"], ENT_QUOTES);
$new_douinengappi= htmlspecialchars($_POST["required_douinengappi"], ENT_QUOTES);
$new_douikikan_ji= htmlspecialchars($_POST["required_douikikan_ji"], ENT_QUOTES);
$new_doukikan_itaru= htmlspecialchars($_POST["required_doukikan_itaru"], ENT_QUOTES);
$new_tekiyo= htmlspecialchars($_POST["required_tekiyo"], ENT_QUOTES);
$new_from_chiryoin_kyori= htmlspecialchars($_POST["required_from_chiryoin_kyori"], ENT_QUOTES);
$new_sinseikaisu= htmlspecialchars($_POST["required_sinseikaisu"], ENT_QUOTES);
$new_syoubyou_sonota= htmlspecialchars($_POST["required_syoubyou_sonota"], ENT_QUOTES);
$new_other_ck= htmlspecialchars($_POST["required_other_ck"], ENT_QUOTES);
$new_syutanto= htmlspecialchars($_POST["required_syutanto"], ENT_QUOTES);
$new_hukutanto= htmlspecialchars($_POST["required_hukutanto"], ENT_QUOTES);
$new_ma_syobyomei= htmlspecialchars($_POST["required_ma_syobyomei"], ENT_QUOTES);
$new_hidari_jyosi= htmlspecialchars($_POST["required_hidari_jyosi"], ENT_QUOTES);
$new_migi_jyosi= htmlspecialchars($_POST["required_migi_jyosi"], ENT_QUOTES);
$new_hidari_kasi= htmlspecialchars($_POST["required_hidari_kasi"], ENT_QUOTES);
$new_migi_kasi= htmlspecialchars($_POST["required_migi_kasi"], ENT_QUOTES);
$new_kukan= htmlspecialchars($_POST["required_kukan"], ENT_QUOTES);
$new_onanpo= htmlspecialchars($_POST["required_onanpo"], ENT_QUOTES);
$new_denkikosen= htmlspecialchars($_POST["required_denkikosen"], ENT_QUOTES);

$new_ma_bt= htmlspecialchars($_POST["required_ma_bt"], ENT_QUOTES);
$new_hari_bt= htmlspecialchars($_POST["required_hari_bt"], ENT_QUOTES);
$new_kotei_ck= htmlspecialchars($_POST["required_kotei_ck"], ENT_QUOTES);
$new_kotei_kyori= htmlspecialchars($_POST["required_kotei_kyori"], ENT_QUOTES);

$new_tiryo_syobyomei= htmlspecialchars($_POST["required_hari_ck1"], ENT_QUOTES)
					. htmlspecialchars($_POST["required_hari_ck2"], ENT_QUOTES)
					. htmlspecialchars($_POST["required_hari_ck3"], ENT_QUOTES)
					. htmlspecialchars($_POST["required_hari_ck4"], ENT_QUOTES)
					. htmlspecialchars($_POST["required_hari_ck5"], ENT_QUOTES)
					. htmlspecialchars($_POST["required_hari_ck6"], ENT_QUOTES)
					. htmlspecialchars($_POST["required_hari_ck7"], ENT_QUOTES);

$new_henkeitosyu= htmlspecialchars($_POST["required_henkei_ck1"], ENT_QUOTES)
					. htmlspecialchars($_POST["required_henkei_ck2"], ENT_QUOTES)
					. htmlspecialchars($_POST["required_henkei_ck3"], ENT_QUOTES)
					. htmlspecialchars($_POST["required_henkei_ck4"], ENT_QUOTES);


	$mysql = new MySQL_cls();
	$mysql->MySQL();
    $sql = "UPDATE RIYOUSHA SET ID='$new_id',kanjyamei='$new_kanjyamei',kanjyamei_kana='$new_kanjyamei_kana',kanjya_seibetu='$new_kanjya_seibetu',kanjya_yubin='$new_kanjya_yubin',kanjya_jyusyo='$new_kanjya_jyusyo',nick_name='$new_nick_name',kanjya_ido='$new_kanjya_ido',kanjya_keido='$new_kanjya_keido',kanjya_tel='$new_kanjya_tel',kanjya_birth='$new_kanjya_birth',hihokensya_simei='$new_hihokensya_simei',hihokensy_kana='$new_hihokensy_kana',hihokensya_seibetu='$new_hihokensya_seibetu',hihokensya_yubin='$new_hihokensya_yubin',hihokensya_jyusyo='$new_hihokensya_jyusyo',hihokensya_jyusyo_kana='$new_hihokensya_jyusyo_kana',hihokensya_birth='$new_hihokensya_birth',ouryouryo_ck='$new_ouryouryo_ck',zokugara='$new_zokugara',hokensyubetu='$new_hokensyubetu',hokenjya_bango='$new_hokenjya_bango',hokenjya_mei='$new_hokenjya_mei',hihokenjya_kigou='$new_hihokenjya_kigou',hihokenjya_bango='$new_hihokenjya_bango',kouhiumu='$new_kouhiumu',sityosonbango='$new_sityosonbango',jyukyusyabango='$new_jyukyusyabango',syuhoken_wariai='$new_syuhoken_wariai',kouhihoken_wariai='$new_kouhihoken_wariai',sejyutu='$new_sejyutu',sejyutunaiyo='$new_sejyutunaiyo',hatubyomataha='$new_hatubyomataha',hatubyonengappi='$new_hatubyonengappi',tiryo_syobyomei='$new_tiryo_syobyomei',gyoumujyou='$new_gyoumujyou',seikyukubun='$new_seikyukubun',tenki='$new_tenki',syoryonengappi='$new_syoryonengappi',sinsei_aten='$new_sinsei_aten',sinsei_aten2='$new_sinsei_aten2',douiisi='$new_douiisi',douiisibyoin='$new_douiisibyoin',isi_yubin='$new_isi_yubin',isijyusyo='$new_isijyusyo',isinosyobyomei='$new_isinosyobyomei',douinengappi='$new_douinengappi',douikikan_ji='$new_douikikan_ji',doukikan_itaru='$new_doukikan_itaru',tekiyo='$new_tekiyo',from_chiryoin_kyori='$new_from_chiryoin_kyori',sinseikaisu='$new_sinseikaisu',syoubyou_sonota='$new_syoubyou_sonota',other_ck='$new_other_ck',syutanto='$new_syutanto',hukutanto='$new_hukutanto',ma_syobyomei='$new_ma_syobyomei',hidari_jyosi='$new_hidari_jyosi',migi_jyosi='$new_migi_jyosi',hidari_kasi='$new_hidari_kasi',migi_kasi='$new_migi_kasi',kukan='$new_kukan',onanpo='$new_onanpo',denkikosen='$new_denkikosen',henkeitosyu='$new_henkeitosyu',ma_bt='$new_ma_bt',hari_bt='$new_hari_bt',kotei_ck='$new_kotei_ck',kotei_kyori='$new_kotei_kyori' WHERE NO ='$new_NO' AND member_id ='$mId' AND id ='" . $_POST["id"] . "'";
	$mysql->TrsBegin();
	$result=$mysql->actQuery($sql);
	if($result){
		$mysql->TrsCmt();
	}else{
		$mysql->TrsRbk();
	}
	$_SESSION["uid"]=$_SESSION["kneid"];
	$_SESSION["kneid"]="";

	header("Location:".url_kanjya);
	exit;

?>