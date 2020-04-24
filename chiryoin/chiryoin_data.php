<?php
session_start();

require_once '../common/connect.php';
require_once '../common/const.php';
require_once '../common/function.php';

$mId =$_SESSION["mid"];

if(isset($mId)){
	$obj = new connect();
	$sql = SELECT009 . " WHERE ID = :ID";
	$get_data = $obj->select_chiryoin($sql,$mId);
	foreach($get_data as $row){
		$denwabango=$row["denwabango"];
		$siharaikubun=$row["siharaikubun"];
		$ginkomei=$row["ginkomei"];
		$sitenmei=$row["sitenmei"];
		$kouza=$row["kouza"];
		$kouzameigi=$row["kouzameigi"];
		$kouzabango=$row["kouzabango"];
		$dairinin=$row["dairinin"];
		$dairinin_add=$row["dairinin_add"];
	}
}
if ($row){

	echo '<table id="table_contact" width="500">';

	echo '	<tr>';

	echo '		<th  width="30%">' . dairinin . '</th>';

	echo '		<td  width="70%">' . $row["dairinin"] . '</td>';

	echo '	</tr>';

	echo '	<tr>';

	echo '		<th>' . dairinin_add . '</td>';

	echo '		<td>' . $row["dairinin_add"] . '</td>';

	echo '	</tr>';
	echo '	<tr>';

	echo '		<th>' . denwabango . '</td>';

	echo '		<td>' . $row["denwabango"] . '</td>';

	echo '	</tr>';

	echo '	<tr>';

	echo '		<th>' . siharaikubun . '</td>';

	echo '		<td>' . $row["siharaikubun"] . '</td>';

	echo '	</tr>';

	echo '	<tr>';

	echo '		<th>' . ginkomei . '</td>';

	echo '		<td>' . $row["ginkomei"] . '</td>';

	echo '	</tr>';

	echo '	<tr>';

	echo '		<th>' . sitenmei . '</td>';

	echo '		<td>' . $row["sitenmei"] . '</td>';

	echo '	</tr>';

	echo '	<tr>';

	echo '		<th>' . kouza . '</td>';

	echo '		<td>' . $row["kouza"] . '</td>';

	echo '	</tr>';

	echo '	<tr>';

	echo '		<th>' . kouzameigi . '</td>';

	echo '		<td>' . $row["kouzameigi"] . '</td>';

	echo '	</tr>';

	echo '</table>';

}