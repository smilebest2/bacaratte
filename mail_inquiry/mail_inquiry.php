<?php

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

	<title>メール問い合わせ</title>

	<link href="../css/style.css" rel="stylesheet" type="text/css" />

</head>



<body>

<div id="wrapper">
	<center><a href="https://smilebest.info"><img id="logo" name="logo" src="../index/img/header.png" /></a></center><br><br>
		<p class="headerTitle">メール問い合わせ</p>



<form action="mail.php" method="post">
  <TBODY style="margin-top:10px;">
    <TR>
      <INPUT type="submit" value=" キャンセル " name="back" style="position: relative; left: 900px; top: 0px;"></TD>
    </TR>
  </TBODY>
<br/>
<br/>
	<table id="table_login">

		<tr>


			<td>氏名</td>

			<td><input type="text" name="name" style="ime-mode: disabled" maxlength="20"  /></td>
			<br/>


		</tr>

		<tr>

			<td>メールアドレス</td>

			<td><input type="text" name="mailadd" style="ime-mode: disabled" maxlength="20" /></td>

		</tr>

		<tr>

			<td>問い合わせ内容</td>

			<td><textarea name="coment" cols=40 rows=4 ></textarea></td>

		</tr>

	</table>

	<Div Align="center"><colspan="2" width="300"><span class="errmsg"><?php echo $errMsg;?></span></Div><br>
	<Div Align="center"><input type="reset" value="クリア" />
	<input type="submit" value="送信" /></Div>

	<br />

	<br />

</form>
<div id="footer">
	<p id="copyright">Copyright (c) 2014 株式会社スマイルベスト | smilebest All Rights Reserved.</p>
</div>


</div>

</body>

</html>

