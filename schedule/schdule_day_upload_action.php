<?php
session_start();

require_once '../common/mysql.php';

require_once '../common/const.php';

require_once '../common/function.php';
require_once '../common/SchduleDataReg.php';

/**

 * キャンセル

 */

	if (isset($_POST['cancel'])) {
	$sid=$_POST["required_sejyutu_no"];
	header("Location:".url_schedule_no.$sid);

	exit();

	}

//登録
if (isset($_POST['entry'])) {

	$post_data['new_member_id']= "";
	$post_data['new_sejyutu_no']= "";
	$post_data['new_riyo_no']= "";
	$post_data['new_id']= "";
	$post_data['new_ka_nick_name']= "";
	$post_data['new_start']= "";
	$post_data['new_end']= "";
	$post_data['new_from_chiryoin']= "";
	$post_data['new_syoken']= "";

	//前患者家の距離計算
	$post_data=array();

	$time=date('c',strtotime($_POST["required_start"]));
	$post_data['new_sejyutu_month']= date('Y-m',strtotime($time));
	$post_data['new_sejyutu_day']= date('j',strtotime($time));

	$post_data['new_start']= htmlspecialchars($_POST["required_start"], ENT_QUOTES);
	$post_data['new_start_race']= date('Y-m-d H:i:s',strtotime($time));	//RACE1用

	$post_data['new_member_id']= htmlspecialchars($_POST["required_member_no"], ENT_QUOTES);
	$post_data['new_sejyutu_no']= htmlspecialchars($_POST["required_sejyutu_no"], ENT_QUOTES);
	$post_data['new_riyo_no']= htmlspecialchars($_POST["required_riyo_no"], ENT_QUOTES);
	$post_data['new_ka_nick_name']= htmlspecialchars($_POST["required_ka_nick_name"], ENT_QUOTES);

	$post_data['new_end']= htmlspecialchars($_POST["required_end"], ENT_QUOTES);
	$post_data['new_from_chiryoin']= htmlspecialchars($_POST["required_from_chiryoin"], ENT_QUOTES);
	$post_data['new_syoken']= htmlspecialchars($_POST["required_syoken"], ENT_QUOTES);
	$post_data['new_from_chiryoin_kyori']= $_POST["required_from_chiryoin_kyori"];
	$post_data['new_kanjya_ido']= $_POST["required_kanjya_ido"];
	$post_data['new_kanjya_keido']= $_POST["required_kanjya_keido"];
	$post_data['new_sejyutusya_add']= htmlspecialchars($_POST["required_sejyutusya_add"], ENT_QUOTES);

	$after_riyosya = "";
	$post_data['sid']=$_POST["required_sejyutu_no"];


	$regist = SchduleDataReg::schdule_data_reg($post_data);
/*
	//保険料計算
	$sql = "select * from RACE_DATA1 ";
	$sql .= "WHERE ";
	$sql .= "member_id = '$new_member_id' ";
	$sql .= "AND sejyutu_no = '$new_sejyutu_no' ";
	$sql .= "AND kanjya_no = '$new_riyo_no' ";
	$sql .= "AND sejyutu_month='$new_sejyutu_month'";
	$mysql->actQuery($sql);
	$race_data=$mysql->getResult();
	var_dump($race_data);
	die;
*/

	header("Location:".url_schedule_no.$post_data['sid']);

	exit();
}
?>