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
$sql="SELECT
	report_users.user_id,
	SEJYUTUSYA.nick_name
	FROM report_users
	INNER JOIN SEJYUTUSYA ON
	report_users.sejyutusya = SEJYUTUSYA.NO
	WHERE report_users.menber_id = '$mId'";
$mysql->actQuery($sql);
$cnt=0;
while (($row = $mysql->getResult())){
		$cnt++;
			echo "	<td>" . $row["nick_name"]."</td>" . KAIGYO;
			echo "	<td>" . $row["user_id"];
			echo "	<input type=\"hidden\" name=\"required_user_id".$cnt."\" value=\"".$row["user_id"]."\"/></td>" . KAIGYO;

			echo "	<td><input type=\"text\" name=\"required_oldpass".$cnt."\" pattern=\"^[0-9A-Za-z]+$\" maxlength=\"50\" size=\"50\" value=\"\"/></td>" . KAIGYO;

			echo "	<td><input type=\"text\" name=\"required_newpass".$cnt."\" pattern=\"^[0-9A-Za-z]+$\" maxlength=\"50\" size=\"50\" value=\"\"/></td>" . KAIGYO;

			echo "	<td><input type=\"submit\" value=\"変更\" name=\"settingpassword\" /><input type=\"submit\" value=\"削除\" name=\"deleteuser".$cnt."\" /></td>" . KAIGYO;

			echo "</tr>" . KAIGYO;

}
$mysql->actQuery("SELECT * FROM SEJYUTUSYA WHERE member_id = '$mId'");
$select="<select name=\"sejyutusya\">";
while (($row = $mysql->getResult())){
	$select.= "<option value=\"" . $row["NO"]."\">" . $row["nick_name"] . "</option>";
}
$select.="</select>";
echo "	<td>" . $select."</td>" . KAIGYO;
echo "	<td><input type=\"text\" name=\"required_user_id\" value=\"\"/></td>" . KAIGYO;

echo "	<td></td>" . KAIGYO;

echo "	<td><input type=\"text\" name=\"required_newpass\" pattern=\"^[0-9A-Za-z]+$\" maxlength=\"50\" size=\"50\" value=\"\"/></td>" . KAIGYO;

echo "	<td><input type=\"submit\" value=\"登録\" name=\"new_settingpassword\" /></td>" . KAIGYO;

echo "</tr>" . KAIGYO;
echo "	<input type=\"hidden\" name=\"required_datacount\" value=\"".$cnt."\"/>";
