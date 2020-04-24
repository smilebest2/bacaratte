<?php
session_start();

require_once 'member_regist_ck_model.php';
require_once '../common/function.php';
require_once '../common/mysql.php';
require_once '../common/const.php';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">

<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<meta http-equiv="Content-Style-Type" content="text/css" />

	<meta http-equiv="Content-Script-Type" content="text/javascript" />

	<title>確認画面</title>

	<link href="../css/style.css" rel="stylesheet" type="text/css" />



	<script type="text/javascript" src="js/const.js"></script>

</head>



<div id="wrapper">
	<div id="header"></br></br></br>
		<p class="headerTitle">確認</p>
	</div>


<form action="<?php echo $_SERVER["SCRIPT_NAME"]; ?>" method="post">
<br/><br/><br/><br/>


<?php

	echo '<table id="table_contact" width="500">';

		echo '<tr>';
		echo ' <th width="250">' . member_name . '</td>';
		echo ' <td width="350"><label name="required_member_name" style="ime-mode: active" maxlength="50" size="50" value="' . $_POST["required_member_name"] . '" />' . $name . '</label></td>';
		echo '</tr>';
		echo '<tr>';
		echo ' <th>' . member_mail . '</td>';
		echo ' <td><label style="ime-mode: active" maxlength="50" size="50" value="' . $_POST["required_member_mail"] . '" />' . $mail . '</label></td>';
		echo '</tr>';
		echo '<tr>';		
	echo '	</tr>';
echo '<input type="hidden" name="required_member_name" value="' . $name . '" />';
echo '<input type="hidden" name="required_member_mail" value="' . $mail . '" />';
	echo '</table>';


?>

<br/>
<br/>
<br/>
  <TBODY>
    <TR>
      <INPUT type="submit" value=" 登　録 " name="regist" style="position: relative; left: 400px; top: 0px;"></TD>
      <INPUT type="submit" value=" 編　集 " name="edit" style="position: relative; left: 420px; top: 0px;"></TD>
      <br />
    </TR>
  </TBODY>

<br />
</form>
<div id="footer">
	<p id="copyright">Copyright (c) 2014 株式会社スマイルベスト | smilebest All Rights Reserved.</p>
</div>

</body>

</html>