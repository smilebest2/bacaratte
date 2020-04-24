<?php
session_start();

require_once 'contact_model.php';
require_once '../common/function.php';
require_once '../common/mysql.php';
require_once '../common/const.php';

if($_SESSION["kid"]){
$user_name = $_SESSION["una"];
$_SESSION["eid"]=$_SESSION["kid"];
$_SESSION["kid"]="";
}else{
header("Location:".url_index);
exit;
}



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">

<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<meta http-equiv="Content-Style-Type" content="text/css" />

	<meta http-equiv="Content-Script-Type" content="text/javascript" />

	<title>患者詳細画面</title>

	<link href="../css/style.css" rel="stylesheet" type="text/css" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
	<script type="text/javascript" src="js/const.js"></script>
	<script>

$(document).ready(function() {

	$('#delete').click(function(){
	    if(!confirm('本当に削除しますか？')){
	        /* キャンセルの時の処理 */
	        return false;
	    }else{
	    var id = <?php echo json_encode($_GET["no"], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
	    	$.ajax({
	            type: "POST",
	            url: '<?php echo url_kanjya_del; ?>',
	            data: {"delete_ck": true,"id":id},
	            success:function(j_data){
	            	if(j_data="OK"){
		            alert("削除しました。");
		        	location.replace('<?php echo url_kanjya; ?>');
		        	}else{
		            alert("予期せぬエラーが発生しました。");
		        	location.replace('<?php echo url_kanjya; ?>');

		        	}
		        }
	        });
	    }
	});

});
</script>

</head>



<body>

<div id="wrapper">
	<div id="header"><br><br><br><br>
		<p class="headerTitle">患者詳細</p>
	</div>
	<label style="position: relative; left: 850px; top: 0px;"><?php echo $user_name  . " 様" ?></label>
	<br>

<form action="<?php echo $_SERVER["SCRIPT_NAME"]; ?>" method="post">
<br><br>
<p>※削除ボタンをクリックすると下記データが削除されます</p>
<INPUT type="button" value=" 削 除 " id="delete" name="delete" style="position: relative; left: 210px; top: 0px;"></TD>
<tr><INPUT type="submit" value=" 編集 " name="edit" style="position: relative; left: 600px; top: 0px;"></tr>
<tr><INPUT type="submit" value=" 戻る " name="cancel" style="position: relative; left:620px; top: 0px;" ></tr>




<?php

require_once 'contact_data.php';

?>

<br />

  <TBODY>
    <TR>
      <INPUT type="submit" value=" 編 集 " name="edit" style="position: relative; left: 400px; top: 0px;"></TD>
      <INPUT type="submit" value=" ｷｬﾝｾﾙ " name="cancel" style="position: relative; left: 420px; top: 0px;"></TD>
      <br />
    </TR>
  </TBODY>

<br />
</form>
<div id="footer">
	<p id="copyright">Copyright© 2010 日本マッサージ師支援協会(訪問マッサージ｜在宅医療マッサージ｜大阪)</br>
				〜笑顔と感謝そしておかげさま〜 All Rights Reserved.</p>
</div>

</body>

</html>