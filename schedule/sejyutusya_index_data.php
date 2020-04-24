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
		if($_REQUEST["optionmenu"]=="1,ID"){
//			$mysql->actQuery(SELECT010. " WHERE ID LIKE '" .$_POST["kensaku"] . "%'" . "ORDER BY id ASC");
			$mysql->actQuery(SELECT010. " WHERE member_id = '$mId' AND ID LIKE '" .$_POST["kensaku"] . "%'" . "ORDER BY id ASC");

		}


		if($_REQUEST["optionmenu"]=="2,施術者名"){
//			$mysql->actQuery(SELECT010. " WHERE name LIKE '" .$_POST["kensaku"] . "%'" . "ORDER BY id ASC");
			$mysql->actQuery(SELECT010. " WHERE member_id = '$mId' AND name LIKE '" .$_POST["kensaku"] . "%'" . "ORDER BY id ASC");

		}

		if($_REQUEST["optionmenu"]=="3,ニックネーム"){
//			$mysql->actQuery(SELECT010. " WHERE nick_name LIKE '" .$_POST["kensaku"] . "%'" . "ORDER BY id ASC");
			$mysql->actQuery(SELECT010. " WHERE member_id = '$mId' AND nick_name LIKE '" .$_POST["kensaku"] . "%'" . "ORDER BY id ASC");
		}

	while (($row = $mysql->getResult()))

		{


				echo "	<div class=\"border\">";

				echo "	<td>" . $row["NO"] . "</td>" . KAIGYO;

				echo "	<td>" . $row["ID"] . "</td>" . KAIGYO;

				echo "	<td>" . $row["name"] . "</td>" . KAIGYO;

				echo "	<td>" . $row["nick_name"] . "</td>" . KAIGYO;

				echo "	<td>" . $row["chiryoinmei"] . "</td>" . KAIGYO;

				echo "	<td>" . $row["address"] . "</td>" . KAIGYO;

				echo '	<td><a href="schedule.php?no=' . $row["NO"] . '">' . SHOSAI . '</a></td>' . KAIGYO;

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
//	$mysql->actQuery(SELECT012);

	$sql="SELECT * FROM SEJYUTUSYA WHERE member_id = '$mId' ORDER BY NO ASC";
	$mysql->actQuery($sql);

	while (($row = $mysql->getResult()))

	{


				echo "	<td>" . $row["NO"] . "</td>" . KAIGYO;

				echo "	<td>" . $row["ID"] . "</td>" . KAIGYO;

				echo "	<td>" . $row["name"] . "</td>" . KAIGYO;

				echo "	<td>" . $row["nick_name"] . "</td>" . KAIGYO;

				echo "	<td>" . $row["chiryoinmei"] . "</td>" . KAIGYO;

				echo "	<td>" . $row["address"] . "</td>" . KAIGYO;


				echo '	<td><a href="schedule.php?no=' . $row["NO"] . '">' . SHOSAI . '</a></td>' . KAIGYO;



				echo "</tr>" . KAIGYO;

	}
}
