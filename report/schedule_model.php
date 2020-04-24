<?php
session_start();

require_once '../common/mysql.php';

require_once '../common/function.php';



$errMsg = "";

$userId = "";

$userPass = "";



/**

* ログインチェック

*/

if($_SERVER["REQUEST_METHOD"] == "POST"){
	/**
	 * 報告
	 */
	if (isset($_POST['data_count'])) {
		for ($i = 0;$i<= $_POST['data_count'];$i++){
			if(isset($_POST['report'.$i])){

				$event_no = htmlspecialchars($_POST['event_no'.$i], ENT_QUOTES,'UTF-8');
				$hour = htmlspecialchars($_POST["sejyututime_h".$i], ENT_QUOTES,'UTF-8');
				$mini = htmlspecialchars($_POST["sejyututime_m".$i], ENT_QUOTES,'UTF-8');
				$day = htmlspecialchars($_POST["sejyutubi"], ENT_QUOTES,'UTF-8');

				$datetime = $day." ".$hour.":".$mini;
				$start =date('Y-m-d H:i', strtotime($datetime));
				$tmp = strtotime($datetime.'+20 minute');
				$end =date('Y-m-d H:i', $tmp);
				$from_chiryoin = htmlspecialchars($_POST["from_chiryoin".$i], ENT_QUOTES,'UTF-8');


				$mysql = new MySQL_cls();
				$mysql->MySQL();
				$sql = "UPDATE evenement SET
				start='$start',
				end='$end',
				from_chiryoin='$from_chiryoin',
				report='1' where id='$event_no'";
				$mysql->actQuery($sql);
				$errMsg .=  "報告しました。<br />";
				$sId=$_POST["sID"];
				header("Location:https://smilebest.info/report/schedule.php?no=".$sId);
				exit();
			}
		}
	}
	/**
	 * 中止
	 */
	if (isset($_POST['data_count'])) {
		for ($i = 0;$i<= $_POST['data_count'];$i++){
			if(isset($_POST['stop'.$i])){
				$event_no = htmlspecialchars($_POST['event_no'.$i], ENT_QUOTES,'UTF-8');

				$mysql = new MySQL_cls();
				$mysql->MySQL();
				$sql = "delete from evenement where id=".$event_no;
				$mysql->actQuery($sql);
				$errMsg .=  "削除しました。<br />";
				$sId=$_POST["sID"];
				header("Location:https://smilebest.info/report/schedule.php?no=".$sId);
				exit();
			}
		}
	}


	//エラーチェック

	if($_POST["zenjitu"])
	{
		$_SESSION["sejyutubi"]=date("Y/m/d",strtotime($_POST["sejyutubi"]."-1 day"));

	}
	if($_POST["yokujitu"])
	{

		$_SESSION["sejyutubi"]=date("Y/m/d",strtotime($_POST["sejyutubi"]."+1 day"));

	}



	$id=$_POST["userID"];
	$sId=$_POST["sID"];


	$mysql = new MySQL_cls();
	$mysql->MySQL();
	$sql = "select menber_id,user_name from report_users where user_id =  '$id'";
	$mysql->actQuery($sql);
	$row = $mysql->getResult();
	//	$user_name = $row["user_name"];
	$user_name = $id;
	$_SESSION["schid"]= $id;
	$_SESSION["user_id"]=NULL;
	unset($_SESSION["user_id"]);
	$_SESSION["mid"]=$row["member_id"];
	$_SESSION["uid"]=$id;

	header("Location:https://smilebest.info/report/schedule.php?no=".$sId);
	exit();
}