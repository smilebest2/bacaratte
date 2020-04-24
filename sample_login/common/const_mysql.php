<?php

$FILEDIR ='../files/';
$FILETMP ='../tmpfile/';

/**

* MYSQL設定

*/

if ($_SERVER['HTTP_HOST'] != HOST_NAME)

{

	define("MYSQL_DB_NAME", 'smilebest_4000');

	define("MYSQL_USER_NAME", 'smilebest_user1');

	define("MYSQL_PASSWORD", 'Windows1');

}

else

{

	define("MYSQL_DB_NAME", 'smilebest_4000');

	define("MYSQL_USER_NAME", 'smilebest_user1');

	define("MYSQL_PASSWORD", 'Windows1');

}



/**

 * クエリ

 */

define("SELECT001", "SELECT * FROM RIYOUSHA");

define("SELECT002", "SELECT

						id

						, reg_d

						, mnt

						, obj

						, mgr

						, tel

						, atc_d

						, grt_prd

						, type

						, fin



					FROM


						data_table1

					");

//					WHERE
//
//						0 = 0 ");



define("SELECT003", "SELECT * FROM users_smilebest");

define("SELECT004", "SELECT * FROM RIYOUSHA");

define("SELECT005", "SELECT * FROM users WEHRE shainmei LIKE ");

define("SELECT006", "DELETE FROM users_smilebest");

define("SELECT007", "DELETE FROM RIYOUSHA");

define("SELECT008", "SELECT * FROM users_smilebest ORDER BY userID ASC");

define("SELECT009", "SELECT * FROM CHIRYOIN");

define("SELECT010", "SELECT * FROM SEJYUTUSYA");

define("SELECT011", "DELETE FROM SEJYUTUSYA");

define("SELECT012", "SELECT * FROM SEJYUTUSYA ORDER BY NO ASC");

define("SELECT013", "SELECT * FROM evenement ORDER BY NO id");

$sql ="SELECT RACE_DATA1.NO,RACE_DATA1.sejyutu_month,SEJYUTUSYA.nick_name,RIYOUSHA.kanjyamei,RIYOUSHA.hokensyubetu,RIYOUSHA.kouhiumu,RIYOUSHA.ma_bt,RIYOUSHA.hari_bt FROM RACE_DATA1 ";
$sql .= "INNER JOIN SEJYUTUSYA ON RACE_DATA1.sejyutu_no = SEJYUTUSYA.NO ";
$sql .= "INNER JOIN RIYOUSHA ON RACE_DATA1.kanjya_no = RIYOUSHA.NO ";
define("SELECT014", $sql);


