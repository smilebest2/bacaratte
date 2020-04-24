<?php
session_start();

require_once '../common/mysql.php';
require_once '../common/const.php';
require_once '../common/function.php';


/**

 * 検索 $mysql->actQuery(SELECT010. " WHERE obj LIKE '" .$_POST["kensaku"] . "%'" . "ORDER BY id ASC");

 */
if($_SERVER["REQUEST_METHOD"] == "POST"){
	if (isset($_POST['serch'])) {

	$mId =$_SESSION["mid"];
	$_SESSION["uid"]=$_SESSION["staid"];
	$mysql = new MySQL_cls();
	$mysql->MySQL();
		if($_REQUEST["optionmenu"]=="1,施術月"){
			$mysql->actQuery(SELECT014. " WHERE RACE_DATA1.member_id = '$mId' AND RACE_DATA1.sejyutu_month LIKE '" .$_POST["kensaku"] . "%'" . "ORDER BY id DESC");

		}

		if($_REQUEST["optionmenu"]=="2,施術者"){
			$mysql->actQuery(SELECT014. " WHERE RACE_DATA1.member_id = '$mId' AND SEJYUTUSYA.nick_name LIKE '" .$_POST["kensaku"] . "%'" . "ORDER BY id DESC");
		}

		if($_REQUEST["optionmenu"]=="3,患者名"){
			$mysql->actQuery(SELECT014. " WHERE RACE_DATA1.member_id = '$mId' AND RIYOUSHA.kanjyamei LIKE '" .$_POST["kensaku"] . "%'" . "ORDER BY id DESC");
		}

		if($_REQUEST["optionmenu"]=="4,主保険"){
			$mysql->actQuery(SELECT014. " WHERE RACE_DATA1.member_id = '$mId' AND RIYOUSHA.hokensyubetu LIKE '" .$_POST["kensaku"] . "%'" . "ORDER BY id DESC");
		}

		if($_REQUEST["optionmenu"]=="3,公費保険"){
			$mysql->actQuery(SELECT014. " WHERE RACE_DATA1.member_id = '$mId' AND RIYOUSHA.kouhiumu LIKE '" .$_POST["kensaku"] . "%'" . "ORDER BY id DESC");
		}
	while (($row = $mysql->getResult()))

		{


				echo "	<div class=\"border\">";

				echo "	<td>" . $row["NO"] . "</td>" . KAIGYO;

				echo "	<td>" . $row["sejyutu_month"] . "</td>" . KAIGYO;

				echo "	<td>" . $row["nick_name"] . "</td>" . KAIGYO;

				echo "	<td>" . $row["kanjyamei"] . "</td>" . KAIGYO;

				echo "	<td>" . $row["hokensyubetu"] . "</td>" . KAIGYO;

				echo "	<td>" . $row["kouhiumu"] . "</td>" . KAIGYO;
				$filename = "";
				switch ($row["hokensyubetu"]){

					case '国民健康保険':
						if($row["hari_bt"] == 1){$filename = "KOKUHO.html";}
						if($row["ma_bt"] == 1){$filename = "KOKUHO_ma.htm";}
						break;
					case '後期高齢者医療':
						if($row["hari_bt"] == 1){$filename = "KOUKI.php";}
						if($row["ma_bt"] == 1){$filename = "KOUKI_ma.php";}
						break;
					case '社会保険':
						if($row["hari_bt"] == 1){$filename = "SYAHO.htm";}
						if($row["ma_bt"] == 1){$filename = "SYAHO_ma.htm";}
						break;
					}

				echo '	<td><a href="' . $filename .'?no=' . $row["NO"] . '">' . INSATU . '</a></td>' . KAIGYO;

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
	$mysql = new MySQL_cls();
	$mysql->MySQL();
	$mysql->actQuery(SELECT014. " WHERE RACE_DATA1.member_id = '$mId' ORDER BY RACE_DATA1.sejyutu_month DESC");

	while (($row = $mysql->getResult()))

	{

				echo "	<td>" . $row["NO"] . "</td>" . KAIGYO;

				echo "	<td>" . $row["sejyutu_month"] . "</td>" . KAIGYO;

				echo "	<td>" . $row["nick_name"] . "</td>" . KAIGYO;

				echo "	<td>" . $row["kanjyamei"] . "</td>" . KAIGYO;

				echo "	<td>" . $row["hokensyubetu"] . "</td>" . KAIGYO;

				echo "	<td>" . $row["kouhiumu"] . "</td>" . KAIGYO;
				$filename = "";
				$row["NO"] = rawurlencode($row["NO"]);
				switch ($row["hokensyubetu"]){

					case '国民健康保険':
						if($row["hari_bt"] == 1){$filename = "KOKUHO.html";}
						if($row["ma_bt"] == 1){$filename = "KOKUHO_ma.htm";}
						break;
					case '後期高齢者医療':
						if($row["hari_bt"] == 1){$filename = "KOUKI.php";}
						if($row["ma_bt"] == 1){$filename = "KOUKI_ma.php";}
						break;
					case '社会保険':
						if($row["hari_bt"] == 1){$filename = "SYAHO.htm";}
						if($row["ma_bt"] == 1){$filename = "SYAHO_ma.htm";}
						break;
					}
				echo '	<td><a href="' . $filename . '?no=' . $row["NO"] . '">' . INSATU . '</a></td>' . KAIGYO;

				echo "</tr>" . KAIGYO;

	}
}
