<?php
session_start();

require_once '../common/connect.php';

require_once '../common/const.php';

require_once '../common/function.php';




$mId =$_SESSION["mid"];

/**

 * 検索 $mysql->actQuery(SELECT001. " WHERE member_id = '$mId' AND obj LIKE '" .$_POST["kensaku"] . "%'" . "ORDER BY id ASC");

 */
if($_SERVER["REQUEST_METHOD"] == "POST"){
	if (isset($_POST['serch'])) {
$_SESSION["uid"]=$_SESSION["kid"];
	$serch_data = array();
	$serch_data['member_id'] = $mId;
	$serch_data['kensaku'] = $_POST["kensaku"]."%";
	$serch_no = "";
	$obj = new connect();
		if($_REQUEST["optionmenu"]=="1,ID"){
//			$sql = SELECT015. " WHERE member_id = :member_id AND ID LIKE ? ORDER BY ID ASC";
			$sql ="SELECT
					RIYOUSHA.NO,
					RIYOUSHA.ID,
					RIYOUSHA.kanjyamei,
					RIYOUSHA.nick_name,
					SEJYUTUSYA.name,
					RIYOUSHA.hokenjya_mei,
					RIYOUSHA.douinengappi
					FROM
					RIYOUSHA
					LEFT JOIN SEJYUTUSYA ON RIYOUSHA.syutanto = SEJYUTUSYA.NO
					WHERE
					RIYOUSHA.member_id = :member_id
					 AND RIYOUSHA.ID = :ID LIKE :ID";
			$serch_no ="1";
		}

		if($_REQUEST["optionmenu"]=="2,患者名"){
			$sql = SELECT016. " WHERE member_id = :member_id AND kanjyamei LIKE ? ORDER BY id ASC";
			$serch_no ="2";
		}

		if($_REQUEST["optionmenu"]=="3,保険者"){
			$sql = SELECT017. " WHERE member_id =: member_id AND hokenjya_mei LIKE ? ORDER BY id ASC";
			$serch_no ="3";
		}

		if($_REQUEST["optionmenu"]=="4,施術者"){
			$sql = SELECT015. " WHERE member_id =: member_id AND name LIKE ? ORDER BY id ASC";
			$serch_no ="4";
		}
	$get_data = $obj->select_kanjya($sql,$serch_data,$serch_no);
	foreach($get_data as $row){

				echo "	<td>" . $row["NO"] . "</td>" . KAIGYO;

				echo "	<td>" . $row["ID"] . "</td>" . KAIGYO;

				echo "	<td>" . $row["kanjyamei"] . "</td>" . KAIGYO;

				echo "	<td>" . $row["nick_name"] . "</td>" . KAIGYO;

				echo "	<td>" . $row["hokenjya_mei"] . "</td>" . KAIGYO;

				echo "	<td>" . $row["name"] . "</td>" . KAIGYO;

				echo "	<td>" . $row["douinengappi"] . "</td>" . KAIGYO;

				echo '	<td><a href="contact.php?no=' . $row["NO"] . '">' . SHOSAI . '</a></td>' . KAIGYO;

				echo "</tr>" . KAIGYO;


		}

	}
}
else{
/**

 * 初期画面表示

 */
	$obj = new connect();
	$serch_data = array();
	$sql=
	"SELECT
	RIYOUSHA.NO,
	RIYOUSHA.ID,
	RIYOUSHA.kanjyamei,
	RIYOUSHA.nick_name,
	SEJYUTUSYA.name,
	RIYOUSHA.hokenjya_mei,
	RIYOUSHA.douinengappi
	FROM
	RIYOUSHA
	LEFT JOIN SEJYUTUSYA ON RIYOUSHA.syutanto = SEJYUTUSYA.NO
	WHERE
	RIYOUSHA.member_id = :member_id";
	$serch_data['member_id'] = $mId;
	$serch_no ="4";
	$get_data = $obj->select_kanjya($sql,$serch_data,$serch_no);
	foreach($get_data as $row){

				echo "	<td>" . $row["NO"] . "</td>" . KAIGYO;

				echo "	<td>" . $row["ID"] . "</td>" . KAIGYO;

				echo "	<td>" . $row["kanjyamei"] . "</td>" . KAIGYO;

				echo "	<td>" . $row["nick_name"] . "</td>" . KAIGYO;

				echo "	<td>" . $row["hokenjya_mei"] . "</td>" . KAIGYO;

				echo "	<td>" . $row["name"] . "</td>" . KAIGYO;

				if($row["douinengappi"] == "0000-00-00"){
					$douinengappi = "";
				}else{
					$douinengappi = $row["douinengappi"];
				}
				echo "	<td>" . $douinengappi . "</td>" . KAIGYO;

				echo '	<td><a href="contact.php?no=' . $row["NO"] . '">' . SHOSAI . '</a></td>' . KAIGYO;

				echo "</tr>" . KAIGYO;

	}
}
