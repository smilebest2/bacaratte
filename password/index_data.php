<?php
session_start();

require_once '../common/mysql.php';

require_once '../common/const.php';

require_once '../common/function.php';




$mId =$_SESSION["mid"];


/**

 * 初期画面表示

 */
$mysql = new MySQL_cls();
$mysql->MySQL();
$mysql->actQuery("SELECT * FROM users_smilebest WHERE userID = '$mId'");
$cnt=0;
while (($row = $mysql->getResult())){
		$cnt++;
			echo "	<td>" . $row["user_id"];
			echo "	<input type=\"hidden\" name=\"required_user_id".$cnt."\" value=\"".$row["user_id"]."\"/></td>" . KAIGYO;

			echo "	<td><input type=\"text\" name=\"required_oldpass".$cnt."\" pattern=\"^[0-9A-Za-z]+$\" maxlength=\"50\" size=\"50\" value=\"\"/></td>" . KAIGYO;

			echo "	<td><input type=\"text\" name=\"required_newpass".$cnt."\" pattern=\"^[0-9A-Za-z]+$\" maxlength=\"50\" size=\"50\" value=\"\"/></td>" . KAIGYO;

			echo "	<td><input type=\"submit\" value=\"変更\" name=\"setingpassword\" /></td>" . KAIGYO;

			echo "</tr>" . KAIGYO;

}
echo "	<input type=\"hidden\" name=\"required_datacount\" value=\"".$cnt."\"/>";
