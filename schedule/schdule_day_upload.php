<?php
session_start();

require_once '../common/mysql.php';

require_once '../common/const.php';

require_once '../common/function.php';

/**

 * キャンセル

 */

	if (isset($_POST['cancel'])) {
	$sid=$_POST["required_sejyutu_no"];
	header("Location:".url_schedule_no.$sid);

	exit();

	}


if (isset($_POST['entry'])) {
$new_id= "";
$new_member_id= "";
$new_sejyutu_no= "";
$new_riyo_no= "";
$new_id= "";
$new_ka_nick_name= "";
$new_start= "";
$new_end= "";
$new_from_chiryoin= "";
$new_syoken= "";

$new_id= htmlspecialchars($_POST["required_id"], ENT_QUOTES);
$new_member_id= htmlspecialchars($_POST["required_member_no"], ENT_QUOTES);
$new_sejyutu_no= htmlspecialchars($_POST["required_sejyutu_no"], ENT_QUOTES);
$new_riyo_no= htmlspecialchars($_POST["required_riyo_no"], ENT_QUOTES);
$new_ka_nick_name= htmlspecialchars($_POST["required_ka_nick_name"], ENT_QUOTES);
$new_start= htmlspecialchars($_POST["required_start"], ENT_QUOTES);
$new_end= htmlspecialchars($_POST["required_end"], ENT_QUOTES);
$new_from_chiryoin= htmlspecialchars($_POST["required_from_chiryoin"], ENT_QUOTES);
$new_syoken= htmlspecialchars($_POST["required_syoken"], ENT_QUOTES);


$sid=$_POST["required_sejyutu_no"];


	$mysql = new MySQL_cls();
	$mysql->MySQL();
    $sql = "UPDATE evenement SET member_id='$new_member_id', sejyutu_no='$new_sejyutu_no',kanjya_no='$new_riyo_no',title='$new_ka_nick_name',start='$new_start',end='$new_end',from_chiryoin='$new_from_chiryoin',syoken='$new_syoken' where id='$new_id'";
	$mysql->actQuery($sql);
$_SESSION["test"]=$sql;
	header("Location:".url_schedule_no.$sid);

	exit();
}
?>