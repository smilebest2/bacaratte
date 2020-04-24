<?php
session_start();

require_once '../common/mysql.php';

require_once '../common/const.php';

require_once '../common/function.php';

/**

 * キャンセル

 */

	if (isset($_POST['cancel'])) {
		$_SESSION["uid"]=$_SESSION["stfid"];
		$_SESSION["stfid"]="";

		header("Location:".url_sejyutusya);
		exit;
	}


/**

 * 緯度経度の取得

 */


 	if (isset($_POST['ido_keido_get_bt'])){

	$_SESSION["ste"]=$_SESSION["stfid"];
	$_SESSION["stfid"]="";
	$latlng = get_gps_from_address($_POST["required_address"]);

	if (isset($latlng['lat'])){
		$_SESSION["required_no"] = $_POST["id"];
		$_SESSION["required_ID"] = $_POST["required_ID"];
		$_SESSION["required_name"] = $_POST["required_name"];
		$_SESSION["required_nick_name"] = $_POST["required_nick_name"];
		$_SESSION["required_chiryoinmei"] = $_POST["required_chiryoinmei"];
		$_SESSION["required_address"] = $_POST["required_address"];
		$_SESSION["required_kanjya_ido"] = $_POST["required_kanjya_ido"];
		$_SESSION["required_kanjya_keido"] = $_POST["required_kanjya_keido"];
		$_SESSION["required_lisence_hari"] = $_POST["required_lisence_hari"];
		$_SESSION["required_lisence_kyu"] = $_POST["required_lisence_kyu"];
		$_SESSION["required_lisence_ma"] = $_POST["required_lisence_ma"];
		$_SESSION["required_kanjya_tel"] = $_POST["required_contact"];
		$_SESSION["required_code"] = $_POST["required_code"];
		$_SESSION["required_code_ma"] = $_POST["required_lisence_ma"];
		$_SESSION["required_code_kokuho"] = $_POST["required_code_kokuho"];
		$_SESSION["required_hokenjyo_torokukubun"] = $_POST["required_hokenjyo_torokukubun"];
		$_SESSION['lat'] = $latlng['lat'];
		$_SESSION['lng'] = $latlng['lng'];
		$_SESSION['out'] = $latlng['out'];
		header("Location:".url_sejyutusya_edit);
		exit;
	}
	else{
		$_SESSION["required_no"] = $_POST["id"];
		$_SESSION["required_ID"] = $_POST["required_ID"];
		$_SESSION["required_name"] = $_POST["required_name"];
		$_SESSION["required_nick_name"] = $_POST["required_nick_name"];
		$_SESSION["required_chiryoinmei"] = $_POST["required_chiryoinmei"];
		$_SESSION['required_address'] = "-------該当する緯度経度が見つかりません。住所を再入力ください。-------";
		$_SESSION["required_kanjya_ido"] = $_POST["required_kanjya_ido"];
		$_SESSION["required_kanjya_keido"] = $_POST["required_kanjya_keido"];
		$_SESSION["required_lisence_hari"] = $_POST["required_lisence_hari"];
		$_SESSION["required_lisence_kyu"] = $_POST["required_lisence_kyu"];
		$_SESSION["required_lisence_ma"] = $_POST["required_lisence_ma"];
		$_SESSION["required_kanjya_tel"] = $_POST["required_contact"];
		$_SESSION["required_code"] = $_POST["required_code"];
		$_SESSION["required_code_ma"] = $_POST["required_lisence_ma"];
		$_SESSION["required_code_kokuho"] = $_POST["required_code_kokuho"];
		$_SESSION["required_hokenjyo_torokukubun"] = $_POST["required_hokenjyo_torokukubun"];
		header("Location:".url_sejyutusya_edit);
		exit;
	}
 	}


if (isset($_POST['entry'])) {
	$new_id= "";
	$new_name= "";
	$new_nick_name= "";
	$new_chiryoinmei= "";
	$new_add= "";
	$new_kanjya_ido= "";
	$new_kanjya_keido= "";
	$new_lisence_hari= "";
	$new_lisence_kyu= "";
	$new_lisence_ma= "";
	$new_kanjya_tel= "";
	$new_code= "";
	$new_code_ma= "";
	$new_code_kokuho= "";
	$new_hokenjyo_torokukubun= "";


	$new_id= htmlspecialchars($_POST["required_ID"], ENT_QUOTES);
	$new_name= htmlspecialchars($_POST["required_name"], ENT_QUOTES);
	$new_nick_name= htmlspecialchars($_POST["required_nick_name"], ENT_QUOTES);
	$new_chiryoinmei= htmlspecialchars($_POST["required_chiryoinmei"], ENT_QUOTES);
	$new_address= htmlspecialchars($_POST["required_address"], ENT_QUOTES);
	$new_kanjya_ido= htmlspecialchars($_POST["required_kanjya_ido"], ENT_QUOTES);
	$new_kanjya_keido= htmlspecialchars($_POST["required_kanjya_keido"], ENT_QUOTES);
	$new_lisence_hari= htmlspecialchars($_POST["required_lisence_hari"], ENT_QUOTES);
	$new_lisence_kyu= htmlspecialchars($_POST["required_lisence_kyu"], ENT_QUOTES);
	$new_lisence_ma= htmlspecialchars($_POST["required_lisence_ma"], ENT_QUOTES);
	$new_kanjya_tel= htmlspecialchars($_POST["required_contact"], ENT_QUOTES);
	$new_code= htmlspecialchars($_POST["required_code"], ENT_QUOTES);
	$new_code_ma= htmlspecialchars($_POST["required_code_ma"], ENT_QUOTES);
	$new_code_kokuho= htmlspecialchars($_POST["required_code_kokuho"], ENT_QUOTES);
	$new_hokenjyo_torokukubun= htmlspecialchars($_POST["required_hokenjyo_torokukubun"], ENT_QUOTES);

	//空チェック
	if(!empty($new_id) && !empty($new_name) && !empty($new_nick_name)){
		$_SESSION["err1"]="";
		$mysql = new MySQL_cls();
		$mysql->MySQL();
	    $sql = "UPDATE SEJYUTUSYA SET
	    ID='$new_id',
	    name='$new_name',
	    nick_name='$new_nick_name',
	    chiryoinmei='$new_chiryoinmei',
	    address='$new_address',
	    ido='$new_kanjya_ido',
	    keido='$new_kanjya_keido',
	    lisence_hari='$new_lisence_hari',
	    lisence_kyu='$new_lisence_kyu',
	    lisence_ma='$new_lisence_ma',
	    contact='$new_kanjya_tel',
	    code='$new_code',
	    code_ma='$new_code_ma',
	    code_kokuho='$new_code_kokuho',
	    hokenjyo_torokukubun='$new_hokenjyo_torokukubun'
	    WHERE NO ='" . $_POST["id"] . "'";
	    $mysql->TrsBegin();
		$result=$mysql->actQuery($sql);
		if($result){
			$mysql->TrsCmt();
		}else{
			$mysql->TrsRbk();
		}
		$_SESSION["staid"]=$_SESSION["stfid"];
		$_SESSION["stfid"]="";
		$url="Location:". url_sejyutusya_no . $_POST["id"];
		header($url);

		exit;
	}else{
		$_SESSION["required_no"] = $_POST["id"];
		$_SESSION["required_ID"] = $_POST["required_ID"];
		$_SESSION["required_name"] = $_POST["required_name"];
		$_SESSION["required_nick_name"] = $_POST["required_nick_name"];
		$_SESSION["required_chiryoinmei"] = $_POST["required_chiryoinmei"];
		$_SESSION["required_address"] = $_POST["required_address"];
		$_SESSION["required_lisence_hari"] = $_POST["required_lisence_hari"];
		$_SESSION["required_lisence_kyu"] = $_POST["required_lisence_kyu"];
		$_SESSION["required_lisence_ma"] = $_POST["required_lisence_ma"];
		$_SESSION["required_kanjya_tel"] = $_POST["required_contact"];
		$_SESSION["required_code"] = $_POST["required_code"];
		$_SESSION["required_code_ma"] = $_POST["required_code_ma"];
		$_SESSION["required_code_kokuho"] = $_POST["required_code_kokuho"];
		$_SESSION["required_hokenjyo_torokukubun"] = $_POST["required_hokenjyo_torokukubun"];
		$_SESSION["err1"]="※ID 施術者名 ニックネーム 治療院名 住所は必ず入力してください。";
		$_SESSION["lat"]= $_POST["required_kanjya_ido"];
		$_SESSION["lng"]= $_POST["required_kanjya_keido"];
		$_SESSION["ste"]=$_SESSION["stfid"];
		$_SESSION["stfid"]="";
		header("Location:".url_sejyutusya_edit);
		exit;
	}
}

?>