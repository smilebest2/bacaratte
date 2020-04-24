<?php
session_start();
$context = getParameter();

function getParameter()
{
    $parameter = array();
    switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $parameter = $_GET;
        break;
    case 'POST':
        $parameter = "post";
        break;
    case 'PUT':
        $parameter = "put";
        break;
    case 'DELETE':
    default:
        parse_str(file_get_contents('php://input'), $parameter);
        break;
    }
    return $parameter;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Content-Style-Type" content="text/css">


<title>crop</title>
<link href="crop/crop.css" rel="stylesheet" type="text/css" media="all"/>
<script src="crop/crop.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript">

    // getDataボタンが押された時の処理
$('#getData').on('click', function(){

   // crop のデータを取得
   var data = $('#img').cropper('getData');

   // 切り抜きした画像のデータ
   // このデータを元にして画像の切り抜きが行われます
   var image = {
     width: Math.round(data.width),
     height: Math.round(data.height),
     x: Math.round(data.x),
     y: Math.round(data.y),
     _token: 'jf89ajtr234534829057835wjLA-SF_d8Z' // csrf用
    };

   // post 処理
   $.post('/cropper', image, function(res){
     // 成功すれば trueと表示されます
     console.log(res);
   });

});
</script>
<style>

</style>
</head>
<body>
<form action="<?php echo $_SERVER["SCRIPT_NAME"]; ?>" method="post" enctype="multipart/form-data">
<div class="container">
    <h1>Cropper with a range of aspect ratio</h1>
    ファイル：<br />
  <input type="file" name="upfile" size="30" /><br />
  <br />
  <input type="submit" value="アップロード" />
  <input name="_method" type="hidden" value="PUT">
  <input type="file" name="name" val=>
    <div>
      <img id="image" src="card_pic/Koala.jpg" alt="Picture">
    </div>
  </div>
<button id="getData" >Get Data</button>
</form>
<p><?php
var_dump(file_get_contents("php://input"));
if (is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
  if (move_uploaded_file($_FILES["upfile"]["tmp_name"], "test_files/" . $_FILES["upfile"]["name"])) {
    chmod("files/" . $_FILES["upfile"]["name"], 0644);
    echo $_FILES["upfile"]["name"] . "をアップロードしました。";
  } else {
    echo "ファイルをアップロードできません。";
  }
} else {
  echo "ファイルが選択されていません。";
}

?></p>
</body>
</html>