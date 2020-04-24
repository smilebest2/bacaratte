<?php

require_once '../common/mysql.php';

require_once '../common/const.php';

require_once '../common/function.php';

/**

 * キャンセル

 */

	if (isset($_POST['back'])) {

	header("Location:".url_menu);

	exit();

	}



$id=$_POST['id'];


$new_denwabango= "";
$new_siharaikubun= "";
$new_ginkomei= "";
$new_sitenmei= "";
$new_kouza= "";
$new_kouzameigi= "";
$new_kouzabango= "";
$new_dairinin= "";
$new_dairinin_add= "";






$new_denwabango= htmlspecialchars($_POST["required_denwabango"], ENT_QUOTES);
$new_siharaikubun= htmlspecialchars($_POST["required_siharaikubun"], ENT_QUOTES);
$new_ginkomei= htmlspecialchars($_POST["required_ginkomei"], ENT_QUOTES);
$new_sitenmei= htmlspecialchars($_POST["required_sitenmei"], ENT_QUOTES);
$new_kouza= htmlspecialchars($_POST["required_kouza"], ENT_QUOTES);
$new_kouzameigi= htmlspecialchars($_POST["required_kouzameigi"], ENT_QUOTES);
$new_kouzabango= htmlspecialchars($_POST["required_kouzabango"], ENT_QUOTES);
$new_dairinin= htmlspecialchars($_POST["required_dairinin"], ENT_QUOTES);
$new_dairinin_add= htmlspecialchars($_POST["required_dairinin_add"], ENT_QUOTES);



	$mysql = new MySQL_cls();
	$mysql->MySQL();
    $sql = "UPDATE CHIRYOIN SET denwabango='$new_denwabango',siharaikubun='$new_siharaikubun',ginkomei='$new_ginkomei',sitenmei='$new_sitenmei',kouza='$new_kouza',kouzameigi='$new_kouzameigi',kouzabango='$new_kouzabango',dairinin='$new_dairinin',dairinin_add='$new_dairinin_add'WHERE ID ='" . 1 . "'";
	$mysql->actQuery($sql);

	header("Location:".url_chiryoin);

	exit();

?>