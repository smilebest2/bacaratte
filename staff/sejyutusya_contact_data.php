<?php
session_start();
require_once '../common/mysql.php';

require_once '../common/const.php';

require_once '../common/function.php';



if(isset($_GET["no"]))

{

	$_SESSION["id"] = $_GET["no"];

}

$mId =$_SESSION["mid"];

$mysql = new MySQL_cls();
$mysql->MySQL();
$mysql->actQuery(SELECT010 . " WHERE member_id = '$mId' AND NO = '" . $_SESSION["id"] . "'");

if ($row = $mysql->getResult())

{

	echo '<table id="table_contact">';

	echo ' <tr><th width="150">' . NO . '</td><td width="400">' . $row["NO"] . '</td></tr>';
	echo ' <tr><th>' . ID . '</td><td>' . $row["ID"] . '</td></tr>';
	echo ' <tr><th>' . name . '</td><td>' . $row["name"] . '</td></tr>';
	echo ' <tr><th>' . nick_name . '</td><td>' . $row["nick_name"] . '</td></tr>';
	echo ' <tr><th>' . chiryoinmei . '</td><td>' . $row["chiryoinmei"] . '</td></tr>';
	echo ' <tr><th>' . add . '</td><td>' . $row["address"] . '</td></tr>';
	echo ' <tr><th>' . kanjya_ido_keido . '</th><td>' . kanjya_ido . $row["ido"] . '&nbsp' . kanjya_keido . $row["keido"] . '</td></tr>';
	echo ' <tr><th>' . lisence_hari . '</td><td>' . $row["lisence_hari"] . '</td></tr>';
	echo ' <tr><th>' . lisence_kyu . '</td><td>' . $row["lisence_kyu"] . '</td></tr>';
	echo ' <tr><th>' . lisence_ma . '</td><td>' . $row["lisence_ma"] . '</td></tr>';
	echo ' <tr><th>' . kanjya_tel . '</td><td>' . $row["contact"] . '</td></tr>';
	echo ' <tr><th>' . code . '</td><td>' . $row["code"] . '</td></tr>';
	echo ' <tr><th>' . code_ma . '</td><td>' . $row["code_ma"] . '</td></tr>';
	echo ' <tr><th>' . code_kokuho . '</td><td>' . $row["code_kokuho"] . '</td></tr>';
	echo ' <tr><th>' . hokenjyo_torokukubun . '</td><td>' . $row["hokenjyo_torokukubun"] . '</td></tr>';




	echo '</table>';

}