<?php
session_start();

require_once '../common/connect.php';
require_once '../common/const.php';
require_once '../common/function.php';


/**
 * 検索
 */
if($_SERVER["REQUEST_METHOD"] == "POST"){
	if (isset($_POST['serch'])) {

	$mId =$_SESSION["mid"];
	$_SESSION["uid"]=$_SESSION["staid"];
	$serch_data = array();
	$serch_data['member_id'] = $mId;
	$serch_data['kensaku'] = $_POST["kensaku"]."%";
	$serch_no = "";
	$obj = new connect();
		if($_REQUEST["optionmenu"]=="1,ID"){
			$sql = SELECT010. " WHERE member_id = :member_id AND ID LIKE ? ORDER BY id ASC";
			$serch_no ="1";
		}

		if($_REQUEST["optionmenu"]=="2,施術者名"){
			$sql = SELECT010. " WHERE member_id = :member_id AND name LIKE ? ORDER BY id ASC";
			$serch_no ="2";
		}

		if($_REQUEST["optionmenu"]=="3,ニックネーム"){
			$sql = SELECT010. " WHERE member_id =: member_id AND nick_name LIKE ? ORDER BY id ASC";
			$serch_no ="3";
		}
		$get_data = $obj->select_sejyutusya($sql,$serch_data,$serch_no);
		foreach($get_data as $row){

			echo "	<div class=\"border\">";

			echo "	<td>" . $row["NO"] . "</td>" . KAIGYO;

			echo "	<td>" . $row["ID"] . "</td>" . KAIGYO;

			echo "	<td>" . $row["name"] . "</td>" . KAIGYO;

			echo "	<td>" . $row["nick_name"] . "</td>" . KAIGYO;

			echo "	<td>" . $row["chiryoinmei"] . "</td>" . KAIGYO;

			echo "	<td>" . $row["address"] . "</td>" . KAIGYO;

			echo '	<td><a href="sejyutusya_contact.php?no=' . $row["NO"] . '">' . SHOSAI . '</a></td>' . KAIGYO;

			echo "</tr>" . KAIGYO;

			echo "	</div>";

		}

	}
}
else{
/**

 * 初期画面表示

 */
	$mId =$_SESSION["mid"];

	$obj = new connect();
	$serch_data = array();
	$serch_data['member_id'] = $mId;

	$sql="SELECT * FROM SEJYUTUSYA WHERE member_id = :member_id ORDER BY NO ASC";
	$serch_no ="4";
	$get_data = $obj->select_sejyutusya($sql,$serch_data,$serch_no);
	foreach($get_data as $row){

		echo "	<td>" . $row["NO"] . "</td>" . KAIGYO;

		echo "	<td>" . $row["ID"] . "</td>" . KAIGYO;

		echo "	<td>" . $row["name"] . "</td>" . KAIGYO;

		echo "	<td>" . $row["nick_name"] . "</td>" . KAIGYO;

		echo "	<td>" . $row["chiryoinmei"] . "</td>" . KAIGYO;

		echo "	<td>" . $row["address"] . "</td>" . KAIGYO;

		echo '	<td><a href="sejyutusya_contact.php?no=' . $row["NO"] . '">' . SHOSAI . '</a></td>' . KAIGYO;

		echo "</tr>" . KAIGYO;

	}
}
