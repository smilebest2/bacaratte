<?php
session_start();

require_once 'index_model.php';
require_once '../common/function.php';
require_once '../common/const.php';

if($_SESSION["uid"]){
$user_name = $_SESSION["una"];
$_SESSION["kid"]=$_SESSION["uid"];
$_SESSION["mId"]=$_SESSION["mid"];
}else{
header("Location:".url_index);
exit;
}

//var_dump($_SESSION["ddd"]);
//$_SESSION["ddd"]="";
//var_dump($_SESSION["aaa"]);
//$_SESSION["aaa"]="";
?>

<!DOCTYPE>

<html>

<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<meta http-equiv="Content-Style-Type" content="text/css" />

	<meta http-equiv="Content-Script-Type" content="text/javascript" />

	<title>患者一覧画面</title>

	<link href="../css/style.css" rel="stylesheet" type="text/css" />

</head>



<body>

<div id="wrapper">
	<div id="header"><br><br><br><br>
		<p class="headerTitle">患者一覧画面</p>
	</div>
	<label style="position: relative; left: 850px; top: 0px;"><?php echo $user_name  . " 様" ?></label>

<form action="<?php echo $_SERVER["SCRIPT_NAME"]; ?>" method="post">
<br/><br/>
  <TBODY style="margin-top:40px;">
    <TR>

      <INPUT type="submit" value=" 新規登録 " name="new_entry" style="position: relative; left: 800px; top: 0px;"></TD>
      <INPUT type="submit" value=" 戻る " name="back_bt" style="position: relative; left: 820px; top: 0px;"></TD>
      <br />
      <TD>　　　　　　検索</TD>
      <TD><INPUT size="30" type="text" name="kensaku"><TD colspan="1" align="center">
      <TD>　　　カテゴリメニュー</TD>
      <TD><SELECT name="optionmenu">
             <OPTION value='1,ID'>ID</OPTION>
    		 <OPTION value='2,患者名'>患者名</OPTION>
    		 <OPTION value='3,保険者'>保険者</OPTION>
    		 <OPTION value='4,施術者'>施術者</OPTION>
      <INPUT type="submit" value=" 検索 " name="serch" style="position: relative; left: 20px; top: 0px;"></TD>
    </TR>
  </TBODY>
<br />
<br />


<table>

	<thead>

		<tr>

			<th width="50"><?php echo NO;?></th>

			<th width="50"><?php echo ID;?></th>

			<th width="150"><?php echo "患者名";?></th>

			<th width="150"><?php echo "ニックネーム";?></th>

			<th width="100"><?php echo "保険者名";?></th>

			<th width="150"><?php echo "施術者名";?></th>

			<th width="150"><?php echo "同意年月日";?></th>

			<th width="30"></th>

		</tr>

	</thead>

	<tbody>

<?php

require_once 'index_data.php';

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

</body>

</html>