<?php
session_start();

require_once 'sejyutusya_index_model.php';
require_once '../common/function.php';
require_once '../common/const.php';

if($_SESSION["uid"]){
$user_name = $_SESSION["una"];
$_SESSION["staid"]=$_SESSION["uid"];

}else{
header("Location:".url_index);
exit;
}

?>

<!DOCTYPE>
<html>

<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<meta http-equiv="Content-Style-Type" content="text/css" />

	<meta http-equiv="Content-Script-Type" content="text/javascript" />

	<title>施術者一覧</title>

	<link href="../css/style.css" rel="stylesheet" type="text/css" />

</head>



<body>

<div id="wrapper">
	<div id="header"><br><br><br><br>
		<p class="headerTitle">施術者一覧画面</p>
	</div>
<label style="position: relative; left: 850px; top: 0px;"><?php echo $user_name  . " 様" ?></label>
<form action="<?php echo $_SERVER["SCRIPT_NAME"]; ?>" method="post">
<br/><br/>
  <TBODY style="margin-top:40px;">
    <TR>
      <INPUT type="submit" value=" 新規登録 " name="new_entry" style="position: relative; left: 700px; top: 0px;"></TD>
      <INPUT type="submit" value=" 戻る  " name="back_bt" style="position: relative; left: 720px; top: 0px;"></TD>
      <br/><br/>
      <TD>　　　　　　検索</TD>
      <TD><INPUT size="30" type="text" name="kensaku"><TD colspan="1" align="center">
      <TD>　　　カテゴリメニュー</TD>
      <TD><SELECT name="optionmenu">
             <OPTION value='1,ID'>ID</OPTION>
    		 <OPTION value='2,施術者名'>施術者名</OPTION>
    		 <OPTION value='3,ニックネーム'>ニックネーム</OPTION>
      <INPUT type="submit" value=" 検索 " name="serch" style="position: relative; left: 20px; top: 0px;"></TD>
    </TR>
  </TBODY>
<br />
<br />

<table id="table_index">

	<thead id="top_thead">

		<tr>

			<th width="50"><?php echo NO;?></th>

			<th width="50"><?php echo ID;?></th>

			<th width="200"><?php echo "施術者名";?></th>

			<th width="200"><?php echo "ニックネーム";?></th>

			<th width="100"><?php echo "治療院名";?></th>

			<th width="300"><?php echo "住所";?></th>

			<th width="30"></th>

		</tr>

	</thead>

	<tbody id="top_tbody">

<?php

require_once 'sejyutusya_index_data.php';

?>

	</tbody>

</table>
</div>


<br />
</form>
<div id="footer">
	<p id="copyright">Copyright© 2010 日本マッサージ師支援協会(訪問マッサージ｜在宅医療マッサージ｜大阪)</br>
				〜笑顔と感謝そしておかげさま〜 All Rights Reserved.</p>
	</div>
</div>
</body>

</html>