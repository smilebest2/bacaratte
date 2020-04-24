<?php
session_start();

require_once 'login_model.php';
require_once 'common/function.php';
require_once 'common/mysql.php';
require_once 'common/const.php';


require '../../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as XlsxReader;

//読み込み

$reader = new XlsxReader();
$spreadsheet = $reader->load('hello world.xlsx');
$sheet = $spreadsheet->getActiveSheet();

// 指定の領域を2次元配列として取得する
$dataArray = $sheet->rangeToArray('A1:AQ51');


/*保存処理
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Hello World !');

$writer = new Xlsx($spreadsheet);
$writer->save('hello world.xlsx');

<table border=1>
    <?php foreach($dataArray as $row){ ?>
    <tr>
        <?php foreach($row as $cel){ ?>
            <td><?= $cel?></td>
        <?php } ?>
    </tr>
    <?php } ?>
</table>
*/

//レスポンポンシブPCかスマホか
if((strpos($ua,'iPhone')!==false)||(strpos($ua,'iPod')!==false)||(strpos($ua,'Android')!==false)) {
	$css="<link rel=\"stylesheet\" media=\"screen and (max-device-width: 480px)\" href=\"../css/style_smf.css\">";
	$header_img="<a href=\"https://smilebest.info\"><img id=\"logo\" name=\"logo\" src=\"../index/img/header_smf.png\" /> </a>";
}else{
	$css="<link rel=\"stylesheet\" media=\"screen and (min-device-width: 1025px)\" href=\"../css/style.css\">";
	$header_img="<a href=\"https://smilebest.info\"><img id=\"logo\" name=\"logo\" src=\"../index/img/header.png\" /> </a>";
}

?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>タイトルです</title>
<meta name="viewport"
	content="width=device-width,
 initial-scale=1.0,user-scalable=no" />
<?php echo $css; ?>
</head>
<body>
	<div id="wrapper">
		<?php  echo $header_img; ?>
		<p class="headerTitle">ログイン画面</p>
		<form action="<?php echo $_SERVER["SCRIPT_NAME"]; ?>" method="post">

			<TBODY style="margin-top: 10px;">
			</TBODY>
			<br /> <br />
			<table id="table_login">

				<tr>

					<td>ユーザー名</td>

					<td><input type="text" name="user_id" style="ime-mode: disabled"
						font-size="150%" maxlength="8" value="tm1234" /></td>
					<br />


				</tr>

				<tr>

					<td>パスワード</td>

					<td><input type="password" name="user_pass"
						style="ime-mode: disabled" font-size="150%" maxlength="8"
						value="tm1234" /></td>

				</tr>

			</table>

			<Div Align="center">
				<colspan ="2" width="300"> <span class="errmsg"><?php echo $errMsg;?>
				</span>

			</Div>
			<br>
			<Div Align="center">
				<input type="reset" value="クリア" /> <input type="submit" value="ログイン" />
			</Div>

			<br /> <br />

		</form>
		<div id="footer">
			<p id="copyright">Copyright (c) 2014 株式会社スマイルベスト | smilebest All
				Rights Reserved.</p>
		</div>
	</div>
</body>
</html>

