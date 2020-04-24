<?php
session_start();

require_once '../common/mysql.php';
require_once '../common/const.php';
require_once '../common/function.php';

require '../../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as XlsxReader;
use PhpOffice\PhpSpreadsheet\IOFactory;

if(isset($_GET["no"]))

{

	$_SESSION["id"] = $_GET["no"];

}

$mId =$_SESSION["mid"];

$mysql = new MySQL_cls();
$mysql->MySQL();
$sql = "SELECT * FROM RACE_DATA1";
$sql .= " LEFT JOIN RIYOUSHA ON RACE_DATA1.kanjya_no = RIYOUSHA.NO ";
$sql .= "WHERE ";
$sql .= "RACE_DATA1.member_id = ".$mId;
$sql .= " AND RACE_DATA1.NO = ".$_SESSION["id"];
$mysql->actQuery($sql);

//$mysql->actQuery(SELECT001 . " WHERE member_id = '$mId' AND NO = '" . $_SESSION["id"] . "'");


//なぜか文字化けしたので
$ARI=ari;
$NASI=nasi;
$OURYORYO=ouryoryo;

//患者データ取得
if ($row = $mysql->getResult()){

//担当施術者のデータ変換NOから施術者ニックネーム
$mId=$_SESSION["mId"];
$seNO=htmlspecialchars($row["syutanto"], ENT_QUOTES);
$sql = "select nick_name from SEJYUTUSYA where NO = '$seNO'";

	$mysql->actQuery($sql);
	while (($row_seno = $mysql->getResult())){
		$syutanto= $row_seno["nick_name"];
	}

}
if($row["kanjya_birth"] == "0000-00-00"){
	$row["kanjya_birth"] = "";
}else{
	if(date("Y",$row["kanjya_birth"]) > 1989){
		$nengo = 2;
	}else{
		$nengo = 1;
	}
}
if($row["douinengappi"] == "0000-00-00"){
	$row["douinengappi"] = "";
}
$sityoson_ban = str_split($row["sityosonbango"]);
$hoken_ban = str_split($row["hokenjya_bango"]);
$jyukyusya_ban = str_split($row["jyukyusyabango"]);
$hihoken_ban = str_split($row["hihokenjya_bango"]);

//読み込み
$reader = new XlsxReader();
$spreadsheet = $reader->load('KOUKI.xlsx');
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('G7', $sityoson_ban[0]);
$sheet->setCellValue('I7', $sityoson_ban[1]);
$sheet->setCellValue('K7', $sityoson_ban[2]);
$sheet->setCellValue('M7', $sityoson_ban[3]);
$sheet->setCellValue('O7', $sityoson_ban[4]);
$sheet->setCellValue('Q7', $sityoson_ban[5]);
$sheet->setCellValue('S7', $sityoson_ban[6]);

$sheet->setCellValue('G8', $jyukyusya_ban[0]);
$sheet->setCellValue('I8', $jyukyusya_ban[1]);
$sheet->setCellValue('K8', $jyukyusya_ban[2]);
$sheet->setCellValue('M8', $jyukyusya_ban[3]);
$sheet->setCellValue('O8', $jyukyusya_ban[4]);
$sheet->setCellValue('Q8', $jyukyusya_ban[5]);
$sheet->setCellValue('S8', $jyukyusya_ban[6]);

$sheet->setCellValue('AC7', $hoken_ban[0]);
$sheet->setCellValue('AE7', $hoken_ban[1]);
$sheet->setCellValue('AG7', $hoken_ban[2]);
$sheet->setCellValue('AI7', $hoken_ban[3]);
$sheet->setCellValue('AK7', $hoken_ban[4]);
$sheet->setCellValue('AM7', $hoken_ban[5]);
$sheet->setCellValue('AO7', $hoken_ban[6]);
$sheet->setCellValue('AQ7', $hoken_ban[7]);

$sheet->setCellValue('AC8', $hihoken_ban[0]);
$sheet->setCellValue('AE8', $hihoken_ban[1]);
$sheet->setCellValue('AG8', $hihoken_ban[2]);
$sheet->setCellValue('AI8', $hihoken_ban[3]);
$sheet->setCellValue('AK8', $hihoken_ban[4]);
$sheet->setCellValue('AM8', $hihoken_ban[5]);
$sheet->setCellValue('AO8', $hihoken_ban[6]);
$sheet->setCellValue('AQ8', $hihoken_ban[7]);

$sheet->setCellValue('G9', $row["kanjyamei_kana"]);
$sheet->setCellValue('G10', $row["kanjyamei"]);
$sheet->setCellValue('S10', $row["zokugara"]);
$sheet->setCellValue('AC9', $row["hihokensya_simei"]);

$writer = new Xlsx($spreadsheet);
$writer->save('hello world.xlsx');

$reader = IOFactory::createReader('Xlsx');
$spreadsheet = $reader->load('hello world.xlsx');
$sheet1 = $spreadsheet->setActiveSheetIndex(0);

// 行ループ
// getRowIteratorの第1引数は開始行です
foreach ($sheet1->getRowIterator(1) as $row_index => $row)
{
    // 行内の列ループ
    // getCellIteratorの第1引数は開始列です
    // $cell_indexにはA,B,C...のアルファベットが格納されます
    foreach ($row->getCellIterator('A') as $cell_index => $cell)
    {
        // セルの値を取得
        $value = $cell->getValue();

        // 整形された値を取得
        $formated_value = $cell->getFormattedValue();

        // 処理 ...
        // ...
        // ...
	}
}
var_dump($value);
var_dump($formated_value);
?>

