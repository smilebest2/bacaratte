<?php
session_start();

require_once 'member_regist_model.php';
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

	<title>登録完了</title>

	<link href="../css/style.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="js/const.js"></script>

</head>



<div id="wrapper">
	<div id="header"></br></br></br>
		<p class="headerTitle">登録完了</p>
	</div>


<form action="<?php echo $_SERVER["SCRIPT_NAME"]; ?>" method="post">
<a href="https://smilebest.info">
<?php

	echo '<table id="table_contact" width="500">';


	echo '</table>';
	echo '</br></br></br></br></br>';
	echo '<center><font size="3" ><span>会員登録が完了しました。</span></br></br>';
	echo '<center><font size="3" ><span>登録いただいたアドレスにメールを送信しましたので内容を確認ください。</span></br></br></br></br></br></br>';

?>
</a>

</Div>
<br />
</form>
<div id="footer">
	<p id="copyright">Copyright (c) 2014 株式会社スマイルベスト | smilebest All Rights Reserved.</p>
</div>
</body>

</html>