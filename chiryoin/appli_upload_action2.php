<?php
session_start();
require_once '../common/connect.php';
require_once '../common/const.php';
require_once '../common/function.php';

/**
 * キャンセル
 */

if (isset($_POST['cancel'])) {
	$_SESSION["uid"]=$_SESSION["lid"];
	$_SESSION["eld"]="";
	header("Location:".url_chiryoin);
	exit;
}

if (isset($_POST['entry'])) {
	$mId=htmlspecialchars($_POST["required_ID"], ENT_QUOTES);
	$chiryoin_data= array();
	$chiryoin_data['ID']= $mId;
	$chiryoin_data['denwabango']= htmlspecialchars($_POST["required_denwabango"], ENT_QUOTES);
	$chiryoin_data['siharaikubun']= htmlspecialchars($_POST["required_siharaikubun"], ENT_QUOTES);
	$chiryoin_data['ginkomei']= htmlspecialchars($_POST["required_ginkomei"], ENT_QUOTES);
	$chiryoin_data['sitenmei']= htmlspecialchars($_POST["required_sitenmei"], ENT_QUOTES);
	$chiryoin_data['kouza']= htmlspecialchars($_POST["required_kouza"], ENT_QUOTES);
	$chiryoin_data['kouzameigi']= htmlspecialchars($_POST["required_kouzameigi"], ENT_QUOTES);
	$chiryoin_data['kouzabango']= htmlspecialchars($_POST["required_kouzabango"], ENT_QUOTES);
	$chiryoin_data['dairinin']= htmlspecialchars($_POST["required_dairinin"], ENT_QUOTES);
	$chiryoin_data['dairinin_add']= htmlspecialchars($_POST["required_dairinin_add"], ENT_QUOTES);

	$obj = new connect();
	$sql = "SELECT count(*) FROM CHIRYOIN WHERE ID = :ID";
	$count = $obj->count_chiryoin($sql,$mId);

	if($count <> 0){
		$sql = "UPDATE CHIRYOIN SET denwabango= :denwabango,siharaikubun= :siharaikubun,ginkomei= :ginkomei,sitenmei= :sitenmei,kouza= :kouza,kouzameigi= :kouzameigi,kouzabango= :kouzabango,dairinin= :dairinin,dairinin_add= :dairinin_add  WHERE ID = :ID";
		$get_data = $obj->update_chiryoin($sql,$chiryoin_data);

	}else{
		$sql = "INSERT INTO CHIRYOIN (ID,denwabango,siharaikubun,ginkomei,sitenmei,kouza,kouzameigi,kouzabango,dairinin,dairinin_add) values ( :ID, :denwabango, :siharaikubun, :ginkomei, :sitenmei, :kouza, :kouzameigi, :kouzabango, :dairinin, :dairinin_add)";
		$get_data = $obj->insert_chiryoin($sql,$chiryoin_data);

	}
	$_SESSION["uid"]=$_SESSION["lid"];
	$_SESSION["eld"]="";
	header("Location: ".url_chiryoin);
//stash2
	exit;
}
?>