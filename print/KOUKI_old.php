<?php
session_start();

require_once '../common/mysql.php';
require_once '../common/const.php';
require_once '../common/function.php';


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
$sityoson_ban = str_split($row["sityosonbango"],7);
$hoken_ban = str_split($row["hokenjya_bango"],7);
$jyukyusya_ban = str_split($row["jyukyusyabango"],7);
$hihoken_ban = str_split($row["hihokenjya_bango"],7);


?>
<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
<meta http-equiv=Content-Type content="text/html; charset=shift_jis">
<meta name=ProgId content=Excel.Sheet>
<meta name=Generator content="Microsoft Excel 14">
<link rel=File-List href="KOUKI.files/filelist.xml">
<!--[if !mso]>
<style>
v\:* {behavior:url(#default#VML);}
o\:* {behavior:url(#default#VML);}
x\:* {behavior:url(#default#VML);}
.shape {behavior:url(#default#VML);}
</style>
<![endif]-->
<style id="各申請書_21411_Styles">
<!--table
	{mso-displayed-decimal-separator:"\.";
	mso-displayed-thousand-separator:"\,";}
.font521411
	{color:windowtext;
	font-size:6.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;}
.font621411
	{color:windowtext;
	font-size:6.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;}
.font721411
	{color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;}
.font821411
	{color:white;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;}
.xl6821411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl6921411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7021411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7121411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	border-top:.5pt dotted windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7221411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7321411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7421411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.5pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7521411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7621411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.5pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:m;
	text-align:general;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	mso-text-control:shrinktofit;}
.xl7721411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7821411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:"\[JPN\]\[$-411\]yy";
	text-align:general;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	mso-text-control:shrinktofit;}
.xl7921411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:m;
	text-align:general;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	mso-text-control:shrinktofit;}
.xl8021411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:d;
	text-align:general;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	mso-text-control:shrinktofit;}
.xl8121411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl8221411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl8321411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt hairline windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl8421411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt hairline windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	mso-text-control:shrinktofit;}
.xl8521411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt hairline windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl8621411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt hairline windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	mso-text-control:shrinktofit;}
.xl8721411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl8821411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	mso-text-control:shrinktofit;}
.xl8921411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl9021411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl9121411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl9221411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	mso-text-control:shrinktofit;}
.xl9321411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl9421411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl9521411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	mso-text-control:shrinktofit;}
.xl9621411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl9721411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl9821411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center-across;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl9921411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center-across;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl10021411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center-across;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl10121411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl10221411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:14.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl10321411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:left;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl10421411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl10521411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl10621411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:left;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl10721411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl10821411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl10921411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl11021411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl11121411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl11221411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:22.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:"_\(\0022\\0022* \#\,\#\#0_\)\;_\(\0022\\0022* \\\(\#\,\#\#0\\\)\;_\(\0022\\0022* \0022-\0022_\)\;_\(\@_\)";
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl11321411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:"_\(\0022\\0022* \#\,\#\#0_\)\;_\(\0022\\0022* \\\(\#\,\#\#0\\\)\;_\(\0022\\0022* \0022-\0022_\)\;_\(\@_\)";
	text-align:general;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl11421411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl11521411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:"_\(\0022\\0022* \#\,\#\#0_\)\;_\(\0022\\0022* \\\(\#\,\#\#0\\\)\;_\(\0022\\0022* \0022-\0022_\)\;_\(\@_\)";
	text-align:general;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl11621411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl11721411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl11821411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:left;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl11921411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl12021411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:left;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl12121411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl12221411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl12321411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:left;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl12421411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl12521411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:left;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl12621411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl12721411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl12821411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl12921411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl13021411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl13121411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:14.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl13221411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl13321411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:m;
	text-align:general;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	mso-text-control:shrinktofit;}
.xl13421411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:d;
	text-align:general;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	mso-text-control:shrinktofit;}
.xl13521411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl13621411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.5pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:"\[JPN\]\[$-411\]y";
	text-align:general;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	mso-text-control:shrinktofit;}
.xl13721411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.5pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:d;
	text-align:general;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	mso-text-control:shrinktofit;}
.xl13821411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:"\[JPN\]\[$-411\]yy";
	text-align:general;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl13921411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:"\[JPN\]\[$-411\]yy";
	text-align:center;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl14021411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl14121411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:right;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	mso-text-control:shrinktofit;}
.xl14221411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl14321411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl14421411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl14521411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl14621411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl14721411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl14821411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl14921411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl15021411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	mso-text-control:shrinktofit;}
.xl15121411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	mso-text-control:shrinktofit;}
.xl15221411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	mso-text-control:shrinktofit;}
.xl15321411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	mso-text-control:shrinktofit;}
.xl15421411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	mso-text-control:shrinktofit;}
.xl15521411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	mso-text-control:shrinktofit;}
.xl15621411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	mso-text-control:shrinktofit;}
.xl15721411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	mso-text-control:shrinktofit;}
.xl15821411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	mso-text-control:shrinktofit;}
.xl15921411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl16021411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl16121411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl16221411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl16321411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl16421411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl16521411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl16621411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl16721411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl16821411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl16921411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl17021411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl17121411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl17221411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl17321411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl17421411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl17521411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl17621411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl17721411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	mso-text-control:shrinktofit;}
.xl17821411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	layout-flow:vertical-ideographic;}
.xl17921411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	layout-flow:vertical-ideographic;}
.xl18021411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	layout-flow:vertical-ideographic;}
.xl18121411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:m;
	text-align:center;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl18221411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:d;
	text-align:center;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl18321411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	mso-text-control:shrinktofit;}
.xl18421411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:1vh;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	mso-text-control:shrinktofit;}
.xl18521411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:"0_\)\;\[Red\]\\\(0\\\)";
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt hairline windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl18621411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:"0_\)\;\[Red\]\\\(0\\\)";
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt hairline windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt hairline windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl18721411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	mso-text-control:shrinktofit;}
.xl18821411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl18921411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl19021411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl19121411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl19221411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:"0_\)\;\[Red\]\\\(0\\\)";
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt hairline windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl19321411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:6.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:right;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl19421411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:6.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:right;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl19521411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:6.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:right;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl19621411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl19721411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl19821411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl19921411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl20021411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl20121411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl20221411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl20321411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	mso-text-control:shrinktofit;}
.xl20421411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl20521411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl20621411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl20721411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:"\#\,\#\#0_ ";
	text-align:right;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl20821411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl20921411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl21021411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl21121411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl21221411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl21321411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl21421411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:m;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl21521411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:m;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl21621411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:right;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl21721411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:right;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl21821411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl21921411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:"\#\,\#\#0";
	text-align:right;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl22021411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:"\#\,\#\#0";
	text-align:right;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl22121411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:right;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl22221411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:"\#\,\#\#0_ ";
	text-align:right;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl22321411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:left;
	vertical-align:middle;
	border-top:.5pt hairline windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl22421411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:left;
	vertical-align:middle;
	border-top:.5pt hairline windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl22521411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:left;
	vertical-align:middle;
	border-top:.5pt hairline windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl22621411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:"\#\,\#\#0";
	text-align:right;
	vertical-align:middle;
	border-top:.5pt hairline windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl22721411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:"\#\,\#\#0";
	text-align:right;
	vertical-align:middle;
	border-top:.5pt hairline windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl22821411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:right;
	vertical-align:middle;
	border-top:.5pt hairline windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl22921411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:left;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt hairline windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl23021411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:left;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt hairline windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl23121411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:left;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt hairline windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl23221411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:"\#\,\#\#0";
	text-align:right;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt hairline windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl23321411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:"\#\,\#\#0";
	text-align:right;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt hairline windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl23421411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:right;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt hairline windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl23521411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:left;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl23621411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:left;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl23721411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl23821411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl23921411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl24021411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl24121411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl24221411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl24321411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl24421411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl24521411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:left;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl24621411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl24721411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl24821411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	mso-text-control:shrinktofit;}
.xl24921411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	mso-text-control:shrinktofit;}
.xl25021411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	mso-text-control:shrinktofit;}
.xl25121411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	mso-text-control:shrinktofit;}
.xl25221411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl25321411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl25421411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl25521411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl25621411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl25721411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:left;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl25821411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl25921411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt dotted windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl26021411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt dotted windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl26121411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl26221411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl26321411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl26421411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl26521411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl26621411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl26721411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl26821411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl26921411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl27021411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl27121411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl27221411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl27321411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl27421411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl27521411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt dotted windowtext;
	border-right:none;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl27621411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt dotted windowtext;
	border-right:none;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl27721411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl27821411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl27921411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl28021411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl28121411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl28221411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl28321411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl28421411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl28521411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl28621411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl28721411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl28821411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:14.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt hairline windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt hairline windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl28921411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:14.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt hairline windowtext;
	mso-diagonal-up:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl29021411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:14.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-diagonal-up:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl29121411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:14.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt hairline windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl29221411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:14.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt hairline windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl29321411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:"\[JPN\]\[$-411\]yy";
	text-align:center;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl29421411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:"\[JPN\]\[$-411\]yy";
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl29521411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:m;
	text-align:center;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl29621411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:m;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl29721411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt hairline windowtext;
	border-right:none;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl29821411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt hairline windowtext;
	border-right:none;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl29921411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt hairline windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl30021411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:14.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:"\@";
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt hairline windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt hairline windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl30121411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:14.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:"\@";
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt hairline windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl30221411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:14.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl30321411
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:14.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
ruby
	{ruby-align:left;}
rt
	{color:windowtext;
	font-size:6.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"ＭＳ Ｐゴシック", monospace;
	mso-font-charset:128;
	mso-char-type:katakana;}
-->
</style>
</head>

<body>
<!--[if !excel]>　　<![endif]-->
<!--次の情報は、Excel の Web ページとして発行ウィザードで生成されました。-->
<!--同じアイテムが Excel から再発行されるとき、DIV タグ間のすべての情報が置き換えられます。-->
<!----------------------------->
<!--Excel の Web ページとして発行 ウィザードのアウトプットの始まり-->
<!----------------------------->

<div id="各申請書_21411" align=center x:publishsource="Excel">

<table border=0 cellpadding=0 cellspacing=0 width=803 class=xl6921411
 style='border-collapse:collapse;table-layout:fixed;width:612pt'>
 <col class=xl6921411 width=20 style='mso-width-source:userset;mso-width-alt:
 640;width:15pt'>
 <col class=xl6921411 width=19 style='mso-width-source:userset;mso-width-alt:
 608;width:14pt'>
 <col class=xl6921411 width=17 span=20 style='mso-width-source:userset;
 mso-width-alt:544;width:13pt'>
 <col class=xl6921411 width=19 style='mso-width-source:userset;mso-width-alt:
 608;width:14pt'>
 <col class=xl6921411 width=20 style='mso-width-source:userset;mso-width-alt:
 640;width:15pt'>
 <col class=xl6921411 width=17 span=21 style='mso-width-source:userset;
 mso-width-alt:544;width:13pt'>
 <col class=xl6921411 width=13 style='mso-width-source:userset;mso-width-alt:
 416;width:10pt'>
 <col class=xl6921411 width=15 style='mso-width-source:userset;mso-width-alt:
 480;width:11pt'>
 <tr height=13 style='mso-height-source:userset;height:9.75pt'>
  <td height=13 class=xl6921411 width=20 style='height:9.75pt;width:15pt'></td>
  <td class=xl6921411 width=19 style='width:14pt'></td>
  <td class=xl6921411 width=17 style='width:13pt'></td>
  <td class=xl6921411 width=17 style='width:13pt'></td>
  <td colspan=21 rowspan=2 class=xl30321411 width=362 style='width:276pt'>後期高齢者医療療養費支給申請書</td>
  <td class=xl13121411 width=17 style='width:13pt'></td>
  <td class=xl6921411 colspan=5 width=85 style='width:65pt'>施術師コード</td>
  <td rowspan=2 class=xl25221411 width=17 style='width:13pt'>1</td>
  <td rowspan=2 class=xl25221411 width=17 style='width:13pt'>1</td>
  <td rowspan=2 class=xl25221411 width=17 style='width:13pt'>1</td>
  <td rowspan=2 class=xl25221411 width=17 style='width:13pt'>1</td>
  <td rowspan=2 class=xl25221411 width=17 style='width:13pt'>1</td>
  <td rowspan=2 class=xl25221411 width=17 style='width:13pt'>1</td>
  <td rowspan=2 class=xl25221411 width=17 style='width:13pt'>1</td>
  <td rowspan=2 class=xl25221411 width=17 style='width:13pt'>1</td>
  <td rowspan=2 class=xl25221411 width=17 style='width:13pt'>1</td>
  <td rowspan=2 class=xl25221411 width=17 style='width:13pt'>1</td>
  <td class=xl10121411 width=17 style='width:13pt'></td>
  <td class=xl10121411 width=17 style='width:13pt'></td>
  <td class=xl10121411 width=17 style='width:13pt'></td>
  <td class=xl6921411 width=17 style='width:13pt'></td>
  <td class=xl6921411 width=13 style='width:10pt'></td>
  <td class=xl6921411 width=15 style='width:11pt'></td>
 </tr>
 <tr height=13 style='mso-height-source:userset;height:9.75pt'>
  <td height=13 class=xl6921411 style='height:9.75pt'></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl13121411></td>
  <td class=xl13121411></td>
  <td class=xl13121411></td>
  <td class=xl13121411></td>
  <td class=xl13121411></td>
  <td class=xl6921411></td>
  <td class=xl10121411></td>
  <td class=xl10121411></td>
  <td class=xl10121411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr class=xl7021411 height=13 style='mso-height-source:userset;height:9.75pt'>
  <td height=13 class=xl7021411 style='height:9.75pt'></td>
  <td class=xl7021411></td>
  <td class=xl7021411></td>
  <td class=xl7021411></td>
  <td colspan=19 rowspan=2 class=xl30221411></td>
  <td rowspan=2 class=xl19021411></td>
  <td class=xl7021411></td>
  <td colspan=2 rowspan=2 class=xl27321411></td>
  <td colspan=2 rowspan=2 class=xl19021411></td>
  <td class=xl7021411></td>
  <td colspan=7 rowspan=3 height=39 width=119 style='height:29.25pt;width:91pt'
  align=left valign=top><!--[if gte vml 1]><v:shapetype id="_x0000_t75"
   coordsize="21600,21600" o:spt="75" o:preferrelative="t" path="m@4@5l@4@11@9@11@9@5xe"
   filled="f" stroked="f">
   <v:stroke joinstyle="miter"/>
   <v:formulas>
    <v:f eqn="if lineDrawn pixelLineWidth 0"/>
    <v:f eqn="sum @0 1 0"/>
    <v:f eqn="sum 0 0 @1"/>
    <v:f eqn="prod @2 1 2"/>
    <v:f eqn="prod @3 21600 pixelWidth"/>
    <v:f eqn="prod @3 21600 pixelHeight"/>
    <v:f eqn="sum @0 0 1"/>
    <v:f eqn="prod @6 1 2"/>
    <v:f eqn="prod @7 21600 pixelWidth"/>
    <v:f eqn="sum @8 21600 0"/>
    <v:f eqn="prod @7 21600 pixelHeight"/>
    <v:f eqn="sum @10 21600 0"/>
   </v:formulas>
   <v:path o:extrusionok="f" gradientshapeok="t" o:connecttype="rect"/>
   <o:lock v:ext="edit" aspectratio="t"/>
  </v:shapetype><v:shape id="Oval_x0020_13" o:spid="_x0000_s3077" type="#_x0000_t75"
   style='position:absolute;margin-left:13.5pt;margin-top:7.5pt;width:63.75pt;
   height:15pt;z-index:5;visibility:visible;mso-wrap-style:square;
   v-text-anchor:top' o:gfxdata="UEsDBBQABgAIAAAAIQDw94q7/QAAAOIBAAATAAAAW0NvbnRlbnRfVHlwZXNdLnhtbJSRzUrEMBDH
74LvEOYqbaoHEWm6B6tHFV0fYEimbdg2CZlYd9/edD8u4goeZ+b/8SOpV9tpFDNFtt4puC4rEOS0
N9b1Cj7WT8UdCE7oDI7ekYIdMayay4t6vQvEIrsdKxhSCvdSsh5oQi59IJcvnY8TpjzGXgbUG+xJ
3lTVrdTeJXKpSEsGNHVLHX6OSTxu8/pAEmlkEA8H4dKlAEMYrcaUSeXszI+W4thQZudew4MNfJUx
QP7asFzOFxx9L/lpojUkXjGmZ5wyhjSRJQ8YKGvKv1MWzIkL33VWU9lGfl98J6hz4cZ/uUjzf7Pb
bHuj+ZQu9z/UfAMAAP//AwBQSwMEFAAGAAgAAAAhADHdX2HSAAAAjwEAAAsAAABfcmVscy8ucmVs
c6SQwWrDMAyG74O9g9G9cdpDGaNOb4VeSwe7CltJTGPLWCZt376mMFhGbzvqF/o+8e/2tzCpmbJ4
jgbWTQuKomXn42Dg63xYfYCSgtHhxJEM3Elg372/7U40YalHMvokqlKiGBhLSZ9aix0poDScKNZN
zzlgqWMedEJ7wYH0pm23Ov9mQLdgqqMzkI9uA+p8T9X8hx28zSzcl8Zy0Nz33r6iasfXeKK5UjAP
VAy4LM8w09zU50C/9q7/6ZURE31X/kL8TKv1x6wXNXYPAAAA//8DAFBLAwQUAAYACAAAACEA38L5
bqwCAAArBwAAEAAAAGRycy9zaGFwZXhtbC54bWy0VdtunDAQfa/Uf7D8vuGysBcUiCJ2t4rUJpHS
foAXzGLF2Mj23lT13zs2sEma9KKsygvDjD3neM54uLw6NBztqNJMihQHFz5GVBSyZGKT4m9fV6MZ
RtoQURIuBU3xkWp8lX38cHkoVUJEUUuFIIXQCThSXBvTJp6ni5o2RF/IlgqIVlI1xMCn2nilIntI
3nAv9P2Jp1tFSalrSs2ii+DM5TZ7mVPOrx1E56qUbDqrkDwbB5eeJWFttwOMu6rK5nEYnyLW4YJK
7rOwc1tz8Nl44EfTab8FYm6Ly/yEZ+QJIhtPTtlPzj/jRm/jhrP4TdgBTLeoIYWSKcbI0IPhTDyC
3YGK3UN7r3oCt7t7hViZ4glGgjQg092OcBSMsXda0S0niW4/y+JR96KRd0jWECYAR+Y1ERt6raBm
tdUQ2sfidaLc9vzc13OyGmij9f6LLIEm2RoJByLJoVLNuZRsHllV6JDiOAijKIZePqZ4HIdRGFtm
JIEqogLiM38+AR8qIB5MA7vUMu942IWt0uYTlWdzQjZRiqGRWaupOyrZfdamQxtQLKKQK8b5uTVw
p+Ti3DRon2J7jxxhLTkrLTlLU6vNOucKQX+l2HcP7tGa4l+aqSHqcduOCtm0xLA148wc3SjAqCmS
m42Qiqy57Y0gGjKD+Sp1w+BqaFmZC0jlge6soMNwgXyB73V9CnsTTjekOD48jZpccqluREmhFyZR
r/2Lcyq5FaWrpu3tZW8bwnhnQ69w0bcU6HluwftMaKtYir/P/flytpxFoyicLEeRv1iMrld5NJqs
gmm8GC/yfBH8sNrA2WpWllQ87533F8sJ/Fu1V+4ZNPkfav9Vq/lrqbyXRXC3GK758AZt+pFkB8/J
7MciZ1SYBTHE3kf7M/nlr+N83V8u+wkAAP//AwBQSwMEFAAGAAgAAAAhAOYBlGEaAQAAlwEAAA8A
AABkcnMvZG93bnJldi54bWxskEFPAjEQhe8m/odmTLxJFxCCSJdsRKInElDCtW6nuxu37aat7OKv
dwgaOHicN/O9vtfZvDM126MPlbMC+r0EGNrcqcoWAt7flncTYCFKq2TtLAo4YIB5en01k1PlWrvG
/SYWjExsmEoBZYzNlPOQl2hk6LkGLe2080ZGGn3BlZctmZuaD5JkzI2sLL1QygafSsw/N19GwGKy
2A8Pi6zYqed2s+NyuQ1uK8TtTZc9AovYxfPxL/2qBIyB6ZfDh6/UWoaIXgDVoXJUDFJK3NWZzUvn
mV5jqL6pzknX3hnmXStgACx3tYBhH47CSuuAUcDDaDAiK1pdKsCPptGd0Ps/lFJcoMNJP/kf5edA
6YyG83+mPwAAAP//AwBQSwECLQAUAAYACAAAACEA8PeKu/0AAADiAQAAEwAAAAAAAAAAAAAAAAAA
AAAAW0NvbnRlbnRfVHlwZXNdLnhtbFBLAQItABQABgAIAAAAIQAx3V9h0gAAAI8BAAALAAAAAAAA
AAAAAAAAAC4BAABfcmVscy8ucmVsc1BLAQItABQABgAIAAAAIQDfwvlurAIAACsHAAAQAAAAAAAA
AAAAAAAAACkCAABkcnMvc2hhcGV4bWwueG1sUEsBAi0AFAAGAAgAAAAhAOYBlGEaAQAAlwEAAA8A
AAAAAAAAAAAAAAAAAwUAAGRycy9kb3ducmV2LnhtbFBLBQYAAAAABAAEAPUAAABKBgAAAAA=
" o:insetmode="auto">
   <v:imagedata src="KOUKI.files/各申請書_21411_image001.png" o:title=""/>
   <o:lock v:ext="edit" aspectratio="f"/>
   <x:ClientData ObjectType="Pict">
    <x:SizeWithCells/>
    <x:CF>Bitmap</x:CF>
    <x:AutoPict/>
   </x:ClientData>
  </v:shape><![endif]--><![if !vml]>
  <span style='mso-ignore:vglayout;
  position:absolute;z-index:5;margin-left:18px;margin-top:10px;width:85px;
  height:20px'><img width=85 height=20 src="KOUKI.files/各申請書_21411_image002.png"
  v:shapes="Oval_x0020_13"></span><![endif]><span style='mso-ignore:vglayout2'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td colspan=7 rowspan=3 height=39 class=xl27321411 width=119
    style='height:29.25pt;width:91pt'>（はり・きゅう用）</td>
   </tr>
  </table>
  </span></td>
  <td class=xl7021411></td>
  <td class=xl7021411></td>
  <td class=xl7021411></td>
  <td class=xl10421411>　</td>
  <td class=xl10421411>　</td>
  <td class=xl10421411>　</td>
  <td class=xl10421411>　</td>
  <td class=xl7021411></td>
  <td class=xl7021411></td>
  <td class=xl7021411></td>
 </tr>
 <tr height=13 style='mso-height-source:userset;height:9.75pt'>
  <td height=13 class=xl6921411 style='height:9.75pt'></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td colspan=4 class=xl20021411 style='border-right:.5pt solid black'>高齢９</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=13 style='mso-height-source:userset;height:9.75pt'>
  <td height=13 class=xl6921411 style='height:9.75pt'></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td colspan=3 rowspan=2 class=xl27321411 style='border-bottom:.5pt solid black'>(平成</td>
  <td colspan=2 rowspan=2 class=xl29321411 style='border-bottom:.5pt solid black'><?php echo date("Y",strtotime($row["sejyutu_month"])) - 1988 ?></td>
  <td rowspan=2 class=xl27321411 style='border-bottom:.5pt solid black'>年</td>
  <td colspan=2 rowspan=2 class=xl29521411 style='border-bottom:.5pt solid black'><?php echo date("n",strtotime($row["sejyutu_month"])) ?></td>
  <td colspan=3 rowspan=2 class=xl27321411 style='border-bottom:.5pt solid black'>月分）</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td colspan=4 class=xl20021411 style='border-right:.5pt solid black'>高齢７</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=6 style='mso-height-source:userset;height:4.5pt'>
  <td height=6 class=xl6921411 style='height:4.5pt'></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=28 style='mso-height-source:userset;height:21.0pt'>
  <td colspan=6 height=28 class=xl9021411 style='border-right:.5pt solid black;
  height:21.0pt'>市町村番号</td>
  <td colspan=2 class=xl29121411 style='border-left:none'><?php echo $sityoson_ban[0]; ?></td>
  <td colspan=2 class=xl28821411 style='border-left:none'><?php echo $sityoson_ban[1]; ?></td>
  <td colspan=2 class=xl28821411 style='border-left:none'><?php echo $sityoson_ban[2]; ?></td>
  <td colspan=2 class=xl28821411 style='border-left:none'><?php echo $sityoson_ban[3]; ?></td>
  <td colspan=2 class=xl28821411 style='border-left:none'><?php echo $sityoson_ban[4]; ?></td>
  <td colspan=2 class=xl28821411 style='border-left:none'><?php echo $sityoson_ban[5]; ?></td>
  <td colspan=2 class=xl28821411 style='border-left:none'><?php echo $sityoson_ban[6]; ?></td>
  <td colspan=2 class=xl28821411 style='border-right:.5pt solid black;
  border-left:none'><?php echo $sityoson_ban[7]; ?></td>
  <td colspan=6 class=xl26121411 style='border-right:.5pt solid black;
  border-left:none'>保険者番号</td>
  <td colspan=2 class=xl29121411 style='border-left:none'><?php echo $hoken_ban[0]; ?></td>
  <td colspan=2 class=xl28821411 style='border-left:none'><?php echo $hoken_ban[1]; ?></td>
  <td colspan=2 class=xl28821411 style='border-left:none'><?php echo $hoken_ban[2]; ?></td>
  <td colspan=2 class=xl28821411 style='border-left:none'><?php echo $hoken_ban[3]; ?></td>
  <td colspan=2 class=xl28821411 style='border-left:none'><?php echo $hoken_ban[4]; ?></td>
  <td colspan=2 class=xl28821411 style='border-left:none'><?php echo $hoken_ban[5]; ?></td>
  <td colspan=2 class=xl28821411 style='border-left:none'><?php echo $hoken_ban[6]; ?></td>
  <td colspan=2 class=xl28821411 style='border-right:.5pt solid black;
  border-left:none'><?php echo $hoken_ban[7]; ?></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=28 style='mso-height-source:userset;height:21.0pt'>
  <td colspan=6 height=28 class=xl9321411 style='border-right:.5pt solid black;
  height:21.0pt'>受給者番号</td>
  <td colspan=2 class=xl29121411 style='border-left:none'><?php echo $jyukyusya_ban[0]; ?></td>
  <td colspan=2 class=xl28821411 style='border-left:none'><?php echo $jyukyusya_ban[1]; ?></td>
  <td colspan=2 class=xl28821411 style='border-left:none'><?php echo $jyukyusya_ban[2]; ?></td>
  <td colspan=2 class=xl28821411 style='border-left:none'><?php echo $jyukyusya_ban[3]; ?></td>
  <td colspan=2 class=xl28821411 style='border-left:none'><?php echo $jyukyusya_ban[4]; ?></td>
  <td colspan=2 class=xl28821411 style='border-left:none'><?php echo $jyukyusya_ban[5]; ?></td>
  <td colspan=2 class=xl28821411 style='border-left:none'><?php echo $jyukyusya_ban[6]; ?></td>
  <td colspan=2 class=xl28921411 style='border-right:.5pt solid black;
  border-left:none'><?php echo $jyukyusya_ban[6]; ?></td>
  <td colspan=6 class=xl26121411 style='border-right:.5pt solid black;
  border-left:none'>被保険者番号</td>
  <td colspan=2 class=xl29121411 style='border-left:none'><?php echo $hihoken_ban[0]; ?></td>
  <td colspan=2 class=xl28821411 style='border-left:none'><?php echo $hihoken_ban[1]; ?></td>
  <td colspan=2 class=xl28821411 style='border-left:none'><?php echo $hihoken_ban[2]; ?></td>
  <td colspan=2 class=xl28821411 style='border-left:none'><?php echo $hihoken_ban[3]; ?></td>
  <td colspan=2 class=xl30021411 style='border-left:none'><?php echo $hihoken_ban[4]; ?></td>
  <td colspan=2 class=xl30021411 style='border-left:none'><?php echo $hihoken_ban[5]; ?></td>
  <td colspan=2 class=xl30021411 style='border-left:none'><?php echo $hihoken_ban[6]; ?></td>
  <td colspan=2 class=xl30021411 style='border-right:.5pt solid black;
  border-left:none'><?php echo $hihoken_ban[7]; ?></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=16 style='mso-height-source:userset;height:12.0pt'>
  <td colspan=6 height=16 class=xl9321411 style='border-right:.5pt solid black;
  height:12.0pt'>フリガナ</td>
  <td colspan=12 class=xl25921411 style='border-left:none'><?php echo $row["kanjyamei_kana"]; ?></td>
  <td colspan=4 class=xl26121411 style='border-right:.5pt solid black'>続　柄</td>
  <td colspan=6 rowspan=2 class=xl15921411 width=107 style='border-right:.5pt solid black;
  width:81pt'>被　保　険　者</br>（組合員・世帯主）</br>氏　　　名</td>
  <td colspan=16 rowspan=2 class=xl26921411 style='border-right:.5pt solid black'><?php echo $row["hihokensya_simei"]; ?></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=29 style='mso-height-source:userset;height:21.75pt'>
  <td colspan=6 rowspan=2 height=49 class=xl29721411 width=107
  style='border-right:.5pt solid black;border-bottom:.5pt solid black;
  height:36.75pt;width:81pt'>施術を受けた者の</br>氏名</td>
  <td colspan=11 rowspan=2 class=xl27521411 style='border-bottom:.5pt solid black'><?php echo $row["kanjyamei"]; ?></td>
  <td class=xl7121411 style='border-top:none'>男</td>
  <td colspan=4 rowspan=3 class=xl27921411 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'><?php echo $row["zokugara"]; ?></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=20 style='mso-height-source:userset;height:15.0pt'>
  <td height=20 class=xl7221411 style='height:15.0pt'>女</td>
  <td colspan=22 class=xl25521411 width=379 style='border-right:.5pt solid black;
  border-left:none;width:289pt'>発症又は負傷の原因及びその経過</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=20 style='mso-height-source:userset;height:15.0pt'>
  <td colspan=6 height=20 class=xl28421411 style='border-right:.5pt solid black;
  height:15.0pt'>生年月日</td>
  <?php
  if($nengo == 1){
  	$nen = date("Y",strtotime($row["kanjya_birth"])) - 1925;
  }else{
  	$nen = date("Y",strtotime($row["kanjya_birth"])) - 1988;
  }
  ?>
  <td class=xl7321411>大</td>
  <td class=xl7321411>・</td>
  <td class=xl7321411>昭</td>
  <td class=xl7321411>・</td>
  <td class=xl7321411>平</td>
  <td class=xl7421411>　</td>
  <td class=xl13621411 style='border-top:none'><?php echo $nen; ?></td>
  <td class=xl7521411>年</td>
  <td class=xl7621411 style='border-top:none'><?php echo date("n",$row["kanjya_birth"]); ?></td>
  <td class=xl7521411>月</td>
  <td class=xl13721411 style='border-top:none'><?php echo date("j",$row["kanjya_birth"]); ?></td>
  <td class=xl7721411 style='border-top:none'>日</td>
  <td colspan=22 class=xl23721411 width=379 style='border-right:.5pt solid black;
  border-left:none;width:289pt'>テストテスト</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=21 style='mso-height-source:userset;height:15.75pt'>
  <td rowspan=18 height=399 class=xl17821411 style='border-bottom:.5pt solid black;
  height:299.25pt;border-top:none'>施</br></br></br>術</br></br></br>内</br></br></br>容</br></br></br>欄</td>
  <td colspan=10 class=xl20021411 style='border-right:.5pt solid black;
  border-left:none'>初　療　年　月　日</td>
  <td colspan=18 class=xl25321411 style='border-left:none'>施　　術　　期　　間</td>
  <td colspan=3 class=xl25421411 width=51 style='border-left:none;width:39pt'>実日数</td>
  <td colspan=12 class=xl25421411 width=204 style='width:156pt'>業務上・外、第三者行為の有無</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=21 style='mso-height-source:userset;height:15.75pt'>
  <td colspan=2 height=21 class=xl9021411 style='height:15.75pt;border-left:
  none'>平成</td>
  <td class=xl13821411 style='border-top:none'>　</td>
  <td class=xl7821411 align=right style='border-top:none'>28</td>
  <td class=xl7721411 style='border-top:none'>年</td>
  <td class=xl7921411 align=right style='border-top:none'>5</td>
  <td class=xl7721411 style='border-top:none'>月</td>
  <td class=xl7721411 style='border-top:none'>　</td>
  <td class=xl8021411 align=right style='border-top:none'>2</td>
  <td class=xl8121411 style='border-top:none'>日</td>
  <td colspan=18 class=xl25221411 style='border-left:none'>自 平成29年6月1日 ～ 至
  平成29年6月30日</td>
  <td colspan=2 class=xl25621411 width=34 style='border-left:none;width:26pt'>　</td>
  <td class=xl8221411 width=17 style='border-top:none;width:13pt'>日</td>
  <td colspan=12 class=xl25421411 width=204 style='width:156pt'>1.業務上　2.第三者行為である　3.その他</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=21 style='mso-height-source:userset;height:15.75pt'>
  <td colspan=22 height=21 class=xl24521411 style='height:15.75pt;border-left:
  none'>　傷病名　　　1.神経痛　　2.リウマチ　　3.頸腕症候群</td>
  <td colspan=2 rowspan=2 class=xl12521411 style='border-bottom:.5pt solid black'>他.　</td>
  <td colspan=7 rowspan=2 class=xl24821411 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>　</td>
  <td colspan=12 class=xl25221411 style='border-left:none'>発病又は負傷年月日</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=21 style='mso-height-source:userset;height:15.75pt'>
  <td colspan=22 height=21 class=xl23521411 style='height:15.75pt;border-left:
  none'>　　　　　　　　 4.五十肩　　5.腰痛症　　6.頚椎捻挫症後遺症</td>
  <td colspan=12 class=xl25221411 style='border-left:none'>不詳</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=21 style='mso-height-source:userset;height:15.75pt'>
  <td rowspan=2 height=42 class=xl17821411 style='border-bottom:.5pt solid black;
  height:31.5pt;border-top:none'>初</br>回</td>
  <td colspan=30 class=xl24521411 style='border-right:.5pt solid black;
  border-left:none'>1.はり　　　2.はり(電気鍼併用)　　　3.きゅう　　　4.きゅう(電気温灸器併用)</td>
  <td colspan=12 class=xl23721411 width=204 style='border-right:.5pt solid black;
  border-left:none;width:156pt'>請　　求　　区　　分</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=21 style='mso-height-source:userset;height:15.75pt'>
  <td colspan=24 height=21 class=xl23521411 style='height:15.75pt;border-left:
  none'>5.はり・きゅう併用　　6.はり・きゅう併用(電気鍼・電気温灸器併用)</td>
  <td colspan=4 class=xl22221411>2,000 </td>
  <td colspan=2 class=xl7321411 style='border-right:.5pt solid black'>円</td>
  <td colspan=12 class=xl23721411 width=204 style='border-right:.5pt solid black;
  border-left:none;width:156pt'>新　　　　規　・　継　　　続</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=21 style='mso-height-source:userset;height:15.75pt'>
  <td rowspan=6 height=126 class=xl17821411 style='border-bottom:.5pt solid black;
  height:94.5pt;border-top:none'>2</br>回</br>目</br>以</br>降</td>
  <td colspan=16 class=xl22921411 style='border-right:.5pt solid black;
  border-left:none'>はり</td>
  <td colspan=3 class=xl23221411 style='border-left:none'>200</td>
  <td class=xl8321411 width=17 style='border-top:none;width:13pt'>円</td>
  <td class=xl8321411 width=19 style='border-top:none;width:14pt'>×</td>
  <td colspan=2 class=xl23421411 width=37 style='width:28pt'>12</td>
  <td class=xl8321411 width=17 style='border-top:none;width:13pt'>回</td>
  <td class=xl8321411 width=17 style='border-top:none;width:13pt'>＝</td>
  <td colspan=4 class=xl23421411>2,000 </td>
  <td class=xl8421411 style='border-top:none'>円</td>
  <td colspan=12 class=xl25621411 width=204 style='border-left:none;width:156pt'>転　　　　　　　帰</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=21 style='mso-height-source:userset;height:15.75pt'>
  <td colspan=16 height=21 class=xl22321411 style='border-right:.5pt solid black;
  height:15.75pt;border-left:none'>はり　(電気鍼併用)</td>
  <td colspan=3 class=xl22621411 style='border-left:none'>200</td>
  <td class=xl8521411 width=17 style='border-top:none;width:13pt'>円</td>
  <td class=xl8521411 width=19 style='border-top:none;width:14pt'>×</td>
  <td colspan=2 class=xl22821411 width=37 style='width:28pt'>12</td>
  <td class=xl8521411 width=17 style='border-top:none;width:13pt'>回</td>
  <td class=xl8521411 width=17 style='border-top:none;width:13pt'>＝</td>
  <td colspan=4 class=xl22221411>2,000 </td>
  <td class=xl8621411 style='border-top:none'>円</td>
  <td colspan=12 class=xl25621411 width=204 style='border-left:none;width:156pt'>継続　・　治癒　・中止　・　転医</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=21 style='mso-height-source:userset;height:15.75pt'>
  <td colspan=16 height=21 class=xl22921411 style='border-right:.5pt solid black;
  height:15.75pt;border-left:none'>きゅう</td>
  <td colspan=3 class=xl23221411 style='border-left:none'>200</td>
  <td class=xl8321411 width=17 style='border-top:none;width:13pt'>円</td>
  <td class=xl8321411 width=19 style='border-top:none;width:14pt'>×</td>
  <td colspan=2 class=xl23421411 width=37 style='width:28pt'>12</td>
  <td class=xl8321411 width=17 style='border-top:none;width:13pt'>回</td>
  <td class=xl8321411 width=17 style='border-top:none;width:13pt'>＝</td>
  <td colspan=4 class=xl23421411>2,000 </td>
  <td class=xl8421411 style='border-top:none'>円</td>
  <td colspan=12 class=xl16821411 width=204 style='border-right:.5pt solid black;
  border-left:none;width:156pt'>摘　　　　　　要</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=21 style='mso-height-source:userset;height:15.75pt'>
  <td colspan=16 height=21 class=xl22321411 style='border-right:.5pt solid black;
  height:15.75pt;border-left:none'>きゅう　(電気温灸器併用)</td>
  <td colspan=3 class=xl22621411 style='border-left:none'>200</td>
  <td class=xl8521411 width=17 style='border-top:none;width:13pt'>円</td>
  <td class=xl8521411 width=19 style='border-top:none;width:14pt'>×</td>
  <td colspan=2 class=xl22821411 width=37 style='width:28pt'>12</td>
  <td class=xl8521411 width=17 style='border-top:none;width:13pt'>回</td>
  <td class=xl8521411 width=17 style='border-top:none;width:13pt'>＝</td>
  <td colspan=4 class=xl22821411>2,000 </td>
  <td class=xl8621411 style='border-top:none'>円</td>
  <td colspan=12 rowspan=8 class=xl17121411 width=204 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black;width:156pt'>往療理由：傷病症状に伴う歩行困難　施術箇所：体幹、四肢</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=21 style='mso-height-source:userset;height:15.75pt'>
  <td colspan=16 height=21 class=xl22921411 style='border-right:.5pt solid black;
  height:15.75pt;border-left:none'>はり・きゅう併用</td>
  <td colspan=3 class=xl23221411 style='border-left:none'>200</td>
  <td class=xl8321411 width=17 style='border-top:none;width:13pt'>円</td>
  <td class=xl8321411 width=19 style='border-top:none;width:14pt'>×</td>
  <td colspan=2 class=xl23421411 width=37 style='width:28pt'>21</td>
  <td class=xl8321411 width=17 style='border-top:none;width:13pt'>回</td>
  <td class=xl8321411 width=17 style='border-top:none;width:13pt'>＝</td>
  <td colspan=4 class=xl23421411>2,000 </td>
  <td class=xl8421411 style='border-top:none'>円</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=21 style='mso-height-source:userset;height:15.75pt'>
  <td colspan=16 height=21 class=xl22321411 style='border-right:.5pt solid black;
  height:15.75pt;border-left:none'>はり・きゅう併用　(電気鍼・電気温灸器併用)</td>
  <td colspan=3 class=xl22621411 style='border-left:none'>200</td>
  <td class=xl8521411 width=17 style='border-top:none;width:13pt'>円</td>
  <td class=xl8521411 width=19 style='border-top:none;width:14pt'>×</td>
  <td colspan=2 class=xl22821411 width=37 style='width:28pt'>12</td>
  <td class=xl8521411 width=17 style='border-top:none;width:13pt'>回</td>
  <td class=xl8521411 width=17 style='border-top:none;width:13pt'>＝</td>
  <td colspan=4 class=xl22821411>2,000 </td>
  <td class=xl8621411 style='border-top:none'>円</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=21 style='mso-height-source:userset;height:15.75pt'>
  <td colspan=8 height=21 class=xl9021411 style='height:15.75pt;border-left:
  none'>往　療　料</td>
  <td class=xl8721411 style='border-top:none'>　</td>
  <td class=xl8721411 style='border-top:none'>　</td>
  <td class=xl7721411 style='border-top:none'>　</td>
  <td class=xl7721411 style='border-top:none'>　</td>
  <td colspan=5 class=xl8721411 style='border-right:.5pt solid black'>2ｋｍまで</td>
  <td colspan=3 class=xl21921411 style='border-left:none'>1,800</td>
  <td class=xl14021411 width=17 style='border-top:none;width:13pt'>円</td>
  <td class=xl14021411 width=19 style='border-top:none;width:14pt'>×</td>
  <td colspan=2 class=xl22121411 width=37 style='width:28pt'>12</td>
  <td class=xl14021411 width=17 style='border-top:none;width:13pt'>回</td>
  <td class=xl14021411 width=17 style='border-top:none;width:13pt'>＝</td>
  <td colspan=4 class=xl22221411>2,000 </td>
  <td class=xl8821411 style='border-top:none'>円</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=21 style='mso-height-source:userset;height:15.75pt'>
  <td colspan=6 height=21 class=xl21621411 style='height:15.75pt;border-left:
  none'>加　算　</td>
  <td class=xl7721411 style='border-top:none'>（</td>
  <td class=xl7721411 style='border-top:none'>　</td>
  <td class=xl8721411 style='border-top:none'>　</td>
  <td colspan=3 class=xl8721411>22</td>
  <td class=xl8721411 style='border-top:none'>　</td>
  <td class=xl8721411 style='border-top:none'>ｋｍ）</td>
  <td class=xl7721411 style='border-top:none'>　</td>
  <td class=xl8721411 style='border-top:none'>　</td>
  <td class=xl8921411 style='border-top:none'>　</td>
  <td colspan=3 class=xl21921411 style='border-left:none'>770</td>
  <td class=xl14021411 width=17 style='border-top:none;width:13pt'>円</td>
  <td class=xl14021411 width=19 style='border-top:none;width:14pt'>×</td>
  <td colspan=2 class=xl22121411 width=37 style='width:28pt'>12</td>
  <td class=xl14021411 width=17 style='border-top:none;width:13pt'>回</td>
  <td class=xl14021411 width=17 style='border-top:none;width:13pt'>＝</td>
  <td colspan=4 class=xl22221411>2,000 </td>
  <td class=xl8821411 style='border-top:none'>円</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=21 style='mso-height-source:userset;height:15.75pt'>
  <td colspan=10 height=21 class=xl20821411 style='border-right:.5pt solid black;
  height:15.75pt;border-left:none'>合　　　　　　　　　計</td>
  <td class=xl9021411 style='border-top:none;border-left:none'>　</td>
  <td class=xl8721411 style='border-top:none'>　</td>
  <td class=xl8721411 style='border-top:none'>　</td>
  <td class=xl8721411 style='border-top:none'>　</td>
  <td class=xl8721411 style='border-top:none'>　</td>
  <td class=xl8721411 style='border-top:none'>　</td>
  <td class=xl8721411 style='border-top:none'>　</td>
  <td class=xl8721411 style='border-top:none'>　</td>
  <td class=xl8721411 style='border-top:none'>　</td>
  <td class=xl8721411 style='border-top:none'>　</td>
  <td class=xl7721411 style='border-top:none'>　</td>
  <td class=xl9121411 style='border-top:none'>　</td>
  <td class=xl9121411 style='border-top:none'>　</td>
  <td class=xl9121411 style='border-top:none'>　</td>
  <td colspan=6 class=xl20721411>18,000 </td>
  <td class=xl9221411 style='border-top:none'>円</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=21 style='mso-height-source:userset;height:15.75pt'>
  <td colspan=10 height=21 class=xl20421411 style='border-right:.5pt solid black;
  height:15.75pt;border-left:none'>一部負担金（　1　・　2　・　3割　）</td>
  <td class=xl9321411 style='border-top:none;border-left:none'>　</td>
  <td class=xl9421411 style='border-top:none'>　</td>
  <td class=xl9421411 style='border-top:none'>　</td>
  <td class=xl9421411 style='border-top:none'>　</td>
  <td class=xl9421411 style='border-top:none'>　</td>
  <td class=xl9421411 style='border-top:none'>　</td>
  <td class=xl9421411 style='border-top:none'>　</td>
  <td class=xl9421411 style='border-top:none'>　</td>
  <td class=xl9421411 style='border-top:none'>　</td>
  <td class=xl9421411 style='border-top:none'>　</td>
  <td class=xl7721411 style='border-top:none'>　</td>
  <td class=xl9121411 style='border-top:none'>　</td>
  <td class=xl9121411 style='border-top:none'>　</td>
  <td class=xl9121411 style='border-top:none'>　</td>
  <td colspan=6 class=xl20721411>2,000 </td>
  <td class=xl9221411 style='border-top:none'>円</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=21 style='mso-height-source:userset;height:15.75pt'>
  <td colspan=10 height=21 class=xl20821411 style='border-right:.5pt solid black;
  height:15.75pt;border-left:none'>請　　　求　　　額</td>
  <td class=xl9021411 style='border-left:none'>　</td>
  <td class=xl8721411>　</td>
  <td class=xl8721411>　</td>
  <td class=xl8721411>　</td>
  <td class=xl8721411>　</td>
  <td class=xl8721411>　</td>
  <td class=xl8721411>　</td>
  <td class=xl8721411>　</td>
  <td class=xl8721411>　</td>
  <td class=xl8721411>　</td>
  <td class=xl7721411 style='border-top:none'>　</td>
  <td class=xl9121411 style='border-top:none'>　</td>
  <td class=xl9121411 style='border-top:none'>　</td>
  <td class=xl9121411 style='border-top:none'>　</td>
  <td colspan=6 class=xl20721411>16,000 </td>
  <td class=xl9221411 style='border-top:none'>円</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=42 style='mso-height-source:userset;height:31.5pt'>
  <td colspan=5 height=42 width=87 style='border-right:.5pt solid black;
  height:31.5pt;width:66pt' align=left valign=top><!--[if gte vml 1]><v:shape
   id="Oval_x0020_28" o:spid="_x0000_s3078" type="#_x0000_t75" style='position:absolute;
   margin-left:37.5pt;margin-top:17.25pt;width:10.5pt;height:10.5pt;z-index:6;
   visibility:visible;mso-wrap-style:square;v-text-anchor:top' o:gfxdata="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
AAQABAD1AAAAJAYAAAAA
" o:insetmode="auto">
   <v:imagedata src="KOUKI.files/各申請書_21411_image003.png" o:title=""/>
   <o:lock v:ext="edit" aspectratio="f"/>
   <x:ClientData ObjectType="Pict">
    <x:SizeWithCells/>
    <x:CF>Bitmap</x:CF>
    <x:AutoPict/>
   </x:ClientData>
  </v:shape><![endif]--><![if !vml]>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td colspan=5 height=42 class=xl21121411 width=87 style='border-right:.5pt solid black;
    height:31.5pt;border-left:none;width:66pt'>施術日</br>往療◎</td>
   </tr>
  </table>
  </span></td>
  <td colspan=3 class=xl21421411 style='border-left:none'>6</td>
  <td class=xl8121411 style='border-top:none'>月</td>
  <td class=xl8721411 style='border-top:none'>　</td>
  <td class=xl9521411 style='border-top:none'>1</td>
  <td class=xl9521411 style='border-top:none'>2</td>
  <td class=xl9521411 style='border-top:none'>3</td>
  <td class=xl9521411 style='border-top:none'>4</td>
  <td class=xl9521411 style='border-top:none'>5</td>
  <td class=xl9521411 style='border-top:none'>6</td>
  <td class=xl9521411 style='border-top:none'>7</td>
  <td class=xl9521411 style='border-top:none'>8</td>
  <td class=xl9521411 style='border-top:none'>9</td>
  <td class=xl9521411 style='border-top:none'>10</td>
  <td class=xl9521411 style='border-top:none'>11</td>
  <td class=xl9521411 style='border-top:none'>12</td>
  <td class=xl9521411 style='border-top:none'>13</td>
  <td class=xl9521411 style='border-top:none'>14</td>
  <td class=xl9521411 style='border-top:none'>15</td>
  <td class=xl9521411 style='border-top:none'>16</td>
  <td class=xl9521411 style='border-top:none'>17</td>
  <td class=xl9521411 style='border-top:none'>18</td>
  <td class=xl9521411 style='border-top:none'>19</td>
  <td class=xl9521411 style='border-top:none'>20</td>
  <td class=xl9521411 style='border-top:none'>21</td>
  <td class=xl9521411 style='border-top:none'>22</td>
  <td class=xl9521411 style='border-top:none'>23</td>
  <td class=xl9521411 style='border-top:none'>24</td>
  <td class=xl9521411 style='border-top:none'>25</td>
  <td class=xl9521411 style='border-top:none'>26</td>
  <td class=xl9521411 style='border-top:none'>27</td>
  <td class=xl9521411 style='border-top:none'>28</td>
  <td class=xl9521411 style='border-top:none'>29</td>
  <td class=xl9521411 style='border-top:none'>30</td>
  <td class=xl9521411 style='border-top:none'>31</td>
  <td class=xl8721411 style='border-top:none'>　</td>
  <td class=xl8921411 style='border-top:none'>　</td>
  <td align=left valign=top><!--[if gte vml 1]><v:shape id="Oval_x0020_1"
   o:spid="_x0000_s3073" type="#_x0000_t75" style='position:absolute;
   margin-left:1.5pt;margin-top:30pt;width:32.25pt;height:30.75pt;z-index:1;
   visibility:visible;mso-wrap-style:square;v-text-anchor:top' o:gfxdata="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
BgAAAAA=
" o:insetmode="auto">
   <v:imagedata src="KOUKI.files/各申請書_21411_image005.png" o:title=""/>
   <o:lock v:ext="edit" aspectratio="f"/>
   <x:ClientData ObjectType="Pict">
    <x:SizeWithCells/>
    <x:CF>Bitmap</x:CF>
    <x:AutoPict/>
   </x:ClientData>
  </v:shape><![endif]--><![if !vml]><span style='mso-ignore:vglayout;
  position:absolute;z-index:1;margin-left:2px;margin-top:40px;width:43px;
  height:41px'><img width=43 height=41 src="KOUKI.files/各申請書_21411_image006.png"
  v:shapes="Oval_x0020_1"></span><![endif]><span style='mso-ignore:vglayout2'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td height=42 class=xl6921411 width=17 style='height:31.5pt;width:13pt'></td>
   </tr>
  </table>
  </span></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=17 style='mso-height-source:userset;height:12.75pt'>
  <td rowspan=5 height=77 class=xl17821411 style='border-bottom:.5pt solid black;
  height:57.75pt;border-top:none'>施</br>術</br>証</br>明</br>欄</td>
  <td class=xl9621411 colspan=17>　　上記のとおり施術を行い、その費用を領収しました。</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td colspan=6 class=xl9821411 align=center style='border-right:.5pt solid black'>保健所登録区分</td>
  <td colspan=13 class=xl9821411 align=center style='border-right:.5pt solid black'>1.施術所所在地　2.出張専業施術者所在地</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=17 style='mso-height-source:userset;height:12.75pt'>
  <td height=17 class=xl6921411 style='height:12.75pt'></td>
  <td colspan=2 class=xl12921411>平成　</td>
  <td colspan=2 class=xl13921411>25</td>
  <td class=xl6921411>年</td>
  <td colspan=2 class=xl18121411>6</td>
  <td class=xl6921411>月</td>
  <td colspan=2 class=xl18221411>31</td>
  <td class=xl6921411>日</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl10121411 colspan=2>住　所</td>
  <td colspan=19 class=xl17721411>大阪府大阪市浪速区日本橋東５-1-1-10</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6821411>　</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=9 style='mso-height-source:userset;height:6.75pt'>
  <td height=9 class=xl6921411 style='height:6.75pt'></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl10121411></td>
  <td class=xl6921411></td>
  <td colspan=10 rowspan=2 class=xl18321411>松原　稔</td>
  <td class=xl6921411></td>
  <td class=xl10221411></td>
  <td class=xl10221411></td>
  <td class=xl10221411></td>
  <td class=xl10221411></td>
  <td class=xl10221411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6821411>　</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=17 style='mso-height-source:userset;height:12.75pt'>
  <td height=17 class=xl6921411 style='height:12.75pt'></td>
  <td class=xl10121411 colspan=4>免許番号：第</td>
  <td colspan=3 class=xl20321411>9356</td>
  <td class=xl10321411>号</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl10121411 colspan=3>はり師</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl10121411 colspan=2>氏　名</td>
  <td class=xl6921411>&#12958;</td>
  <td class=xl10221411></td>
  <td class=xl6921411></td>
  <td class=xl13021411 colspan=2>電話</td>
  <td colspan=7 class=xl13021411 style='border-right:.5pt solid black'>06-6556-9939</td>
  <td class=xl6821411 style='border-left:none'>　</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=17 style='mso-height-source:userset;height:12.75pt'>
  <td height=17 class=xl7521411 style='height:12.75pt'>　</td>
  <td class=xl10421411 colspan=4>免許番号：第</td>
  <td colspan=3 class=xl20321411>9356</td>
  <td class=xl10421411>号</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl10421411 colspan=3>きゅう師</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7221411>　</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=17 style='mso-height-source:userset;height:12.75pt'>
  <td rowspan=5 height=85 class=xl17821411 style='border-bottom:.5pt solid black;
  height:63.75pt;border-top:none'>申</br>請</br>欄</td>
  <td class=xl9621411 colspan=23>　　上記の療養に要した費用に関して、療養費(医療費)の支給を申請します。</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl10521411 style='border-top:none'>　</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=17 style='mso-height-source:userset;height:12.75pt'>
  <td height=17 class=xl6921411 style='height:12.75pt'></td>
  <td colspan=2 class=xl12921411>平成　</td>
  <td colspan=2 class=xl13921411>25</td>
  <td class=xl6921411>年</td>
  <td colspan=2 class=xl18121411>6</td>
  <td class=xl6921411>月</td>
  <td colspan=2 class=xl18221411>31</td>
  <td class=xl6921411>日</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td colspan=3 class=xl11621411></td>
  <td colspan=3 class=xl12921411>住　所</td>
  <td colspan=19 class=xl17721411><?php echo $row["hihokensya_jyusyo"]; ?></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6821411>　</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=17 style='mso-height-source:userset;height:12.75pt'>
  <td height=17 class=xl6921411 style='height:12.75pt'></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td colspan=3 class=xl11621411>被保険者</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td colspan=10 rowspan=2 class=xl18321411>松原　稔</td>
  <td class=xl6921411></td>
  <td class=xl10221411></td>
  <td class=xl10221411></td>
  <td class=xl10221411></td>
  <td class=xl10221411></td>
  <td class=xl10221411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td align=left valign=top><!--[if gte vml 1]><v:shape id="Oval_x0020_4"
   o:spid="_x0000_s3075" type="#_x0000_t75" style='position:absolute;
   margin-left:1.5pt;margin-top:7.5pt;width:31.5pt;height:30pt;z-index:3;
   visibility:visible;mso-wrap-style:square;v-text-anchor:top' o:gfxdata="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
BQYAAAAABAAEAPUAAAApBgAAAAA=
" o:insetmode="auto">
   <v:imagedata src="KOUKI.files/各申請書_21411_image005.png" o:title=""/>
   <o:lock v:ext="edit" aspectratio="f"/>
   <x:ClientData ObjectType="Pict">
    <x:SizeWithCells/>
    <x:CF>Bitmap</x:CF>
    <x:AutoPict/>
   </x:ClientData>
  </v:shape><![endif]--><![if !vml]><span style='mso-ignore:vglayout;
  position:absolute;z-index:3;margin-left:2px;margin-top:10px;width:42px;
  height:40px'><img width=42 height=40 src="KOUKI.files/各申請書_21411_image007.png"
  v:shapes="Oval_x0020_4"></span><![endif]><span style='mso-ignore:vglayout2'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td height=17 class=xl6821411 width=17 style='height:12.75pt;width:13pt'>　</td>
   </tr>
  </table>
  </span></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=17 style='mso-height-source:userset;height:12.75pt'>
  <td height=17 class=xl6921411 style='height:12.75pt'></td>
  <td colspan=14 class=xl14121411>後期高齢者医療広域連合長　殿</td>
  <td colspan=3 class=xl11621411></td>
  <td colspan=3 class=xl12921411>氏　名</td>
  <td class=xl6921411>&#12958;</td>
  <td class=xl10221411></td>
  <td class=xl6921411></td>
  <td class=xl13021411 colspan=2>電話</td>
  <td colspan=7 class=xl13021411 style='border-right:.5pt solid black'><?php echo $row["kanjya_tel"]; ?></td>
  <td class=xl6821411 style='border-left:none'>　</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=17 style='mso-height-source:userset;height:12.75pt'>
  <td height=17 class=xl7521411 style='height:12.75pt'>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7221411>　</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=17 style='mso-height-source:userset;height:12.75pt'>
  <td rowspan=4 height=76 class=xl17821411 style='border-bottom:.5pt solid black;
  height:57.0pt;border-top:none'>支</br>払</br>機</br>関</br>欄</td>
  <td class=xl10621411 colspan=4>　　支払区分</td>
  <td class=xl10721411 style='border-top:none'>　</td>
  <td class=xl9721411 style='border-top:none'>　</td>
  <td class=xl10721411 style='border-top:none'>　</td>
  <td class=xl10721411 style='border-top:none'>　</td>
  <td class=xl10721411 style='border-top:none'>　</td>
  <td class=xl10721411 style='border-top:none'>　</td>
  <td class=xl9721411 style='border-top:none'>　</td>
  <td class=xl9721411 style='border-top:none'>　</td>
  <td class=xl10721411 style='border-top:none'>　</td>
  <td class=xl10821411 style='border-top:none'>　</td>
  <td class=xl10921411 colspan=4>預金の種類</td>
  <td class=xl10721411 style='border-top:none'>　</td>
  <td class=xl10721411 style='border-top:none'>　</td>
  <td class=xl9721411 style='border-top:none'>　</td>
  <td class=xl11021411 style='border-top:none'>　</td>
  <td class=xl11021411 style='border-top:none'>　</td>
  <td class=xl11121411 style='border-top:none'>　</td>
  <td class=xl10921411 colspan=4>金融機関名</td>
  <td class=xl11321411 style='border-top:none'>　</td>
  <td class=xl11321411 style='border-top:none'>　</td>
  <td class=xl11421411 style='border-top:none'>　</td>
  <td class=xl11421411 style='border-top:none'>　</td>
  <td class=xl11421411 style='border-top:none'>　</td>
  <td class=xl11321411 style='border-top:none'>　</td>
  <td class=xl11421411 style='border-top:none'>　</td>
  <td class=xl11421411 style='border-top:none'>　</td>
  <td class=xl11421411 style='border-top:none'>　</td>
  <td class=xl11321411 style='border-top:none'>　</td>
  <td class=xl11421411 style='border-top:none'>　</td>
  <td class=xl11421411 style='border-top:none'>　</td>
  <td class=xl11421411 style='border-top:none'>　</td>
  <td class=xl11321411 style='border-top:none'>　</td>
  <td class=xl11521411 style='border-top:none'>　</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=17 style='mso-height-source:userset;height:12.75pt'>
  <td height=17 class=xl10321411 style='height:12.75pt'></td>
  <td colspan=5 rowspan=2 class=xl11621411 style='border-bottom:.5pt solid black'>1.口座振替</td>
  <td class=xl10121411></td>
  <td colspan=5 rowspan=2 class=xl11621411 style='border-bottom:.5pt solid black'>2.窓口払</td>
  <td class=xl11621411></td>
  <td class=xl11721411>　</td>
  <td class=xl11821411 style='border-left:none'>　</td>
  <td class=xl10321411 colspan=8>1.普　通　　2当　座<span
  style='mso-spacerun:yes'>&nbsp;&nbsp; </span>3.貯　蓄</td>
  <td class=xl11721411>　</td>
  <td colspan=7 rowspan=2 class=xl18721411 style='border-bottom:.5pt solid black'>りそな</td>
  <td colspan=3 rowspan=2 class=xl18821411 style='border-bottom:.5pt solid black'>銀行</td>
  <td class=xl11921411></td>
  <td colspan=5 rowspan=2 class=xl19021411 style='border-bottom:.5pt solid black'>日本橋</td>
  <td colspan=3 rowspan=2 class=xl12921411 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>支店</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=17 style='mso-height-source:userset;height:12.75pt'>
  <td height=17 class=xl12021411 style='height:12.75pt'>　</td>
  <td class=xl10421411>　</td>
  <td class=xl12121411>　</td>
  <td class=xl12221411>　</td>
  <td class=xl12321411 style='border-left:none'>　</td>
  <td class=xl12021411 colspan=8>4.その他(　　　　　　　　　　　)</td>
  <td class=xl12221411>　</td>
  <td class=xl12421411>　</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=25 style='mso-height-source:userset;height:18.75pt'>
  <td colspan=5 height=25 class=xl20021411 style='border-right:.5pt solid black;
  height:18.75pt;border-left:none'>口座名義(カナ)</td>
  <td colspan=15 class=xl18421411 style='border-right:.5pt solid black;
  border-left:none'>ニホンマッサージシシエンキョウカイリジチイリジチイリジチイリジチョウノナカカツシ</td>
  <td colspan=4 class=xl9021411 style='border-right:.5pt solid black;
  border-left:none'>口座番号</td>
  <td colspan=2 class=xl18521411 style='border-left:none'>0 </td>
  <td colspan=2 class=xl18621411 style='border-left:none'>0 </td>
  <td colspan=2 class=xl18621411 style='border-left:none'>1 </td>
  <td colspan=2 class=xl18621411 style='border-left:none'>1 </td>
  <td colspan=2 class=xl18621411 style='border-left:none'>1 </td>
  <td colspan=2 class=xl18621411 style='border-left:none'>1 </td>
  <td colspan=2 class=xl18621411 style='border-right:.5pt solid black;
  border-left:none'>0 </td>
  <td colspan=5 class=xl19321411 style='border-right:.5pt solid black;
  border-left:none'>郵便局</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=17 style='mso-height-source:userset;height:12.75pt'>
  <td rowspan=10 height=141 class=xl17821411 style='border-bottom:.5pt solid black;
  height:105.75pt;border-top:none'>委</br></br>任</br></br>欄</td>
  <td class=xl12521411 colspan=21>　　本請求に基づく療養費(医療費)の受領を下記代理人に委任します。</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td align=left valign=top><!--[if gte vml 1]><v:shape id="Text_x0020_Box_x0020_2"
   o:spid="_x0000_s3074" type="#_x0000_t75" style='position:absolute;
   margin-left:4.5pt;margin-top:0;width:6pt;height:16.5pt;z-index:2;
   visibility:visible;mso-wrap-style:square;v-text-anchor:top' o:gfxdata="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
" o:insetmode="auto">
   <v:imagedata src="KOUKI.files/各申請書_21411_image008.png" o:title=""/>
   <o:lock v:ext="edit" aspectratio="f"/>
   <x:ClientData ObjectType="Pict">
    <x:SizeWithCells/>
    <x:CF>Bitmap</x:CF>
    <x:AutoPict/>
   </x:ClientData>
  </v:shape><![endif]--><![if !vml]><span style='mso-ignore:vglayout;
  position:absolute;z-index:2;margin-left:6px;margin-top:0px;width:8px;
  height:22px'><img width=8 height=22 src="KOUKI.files/各申請書_21411_image009.png"
  v:shapes="Text_x0020_Box_x0020_2"></span><![endif]><span style='mso-ignore:
  vglayout2'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td height=17 class=xl9621411 width=17 style='height:12.75pt;border-top:
    none;width:13pt'>　</td>
   </tr>
  </table>
  </span></td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl10521411 style='border-top:none'>　</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=17 style='mso-height-source:userset;height:12.75pt'>
  <td height=17 class=xl6921411 style='height:12.75pt'></td>
  <td class=xl6921411></td>
  <td class=xl6921411 colspan=2>平成</td>
  <td colspan=2 class=xl13921411>25</td>
  <td class=xl6921411>年</td>
  <td colspan=2 class=xl18121411>6</td>
  <td class=xl6921411>月</td>
  <td colspan=2 class=xl18221411>31</td>
  <td class=xl6921411>日</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl12621411>　</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr class=xl12721411 height=17 style='mso-height-source:userset;height:12.75pt'>
  <td height=17 class=xl12721411 style='height:12.75pt'></td>
  <td class=xl12721411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td colspan=3 class=xl12921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411 colspan=2>住所</td>
  <td class=xl6921411></td>
  <td colspan=19 class=xl17721411>大阪府大阪市浪速区日本橋東23-14-19</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl12721411></td>
  <td class=xl12721411></td>
  <td class=xl12721411></td>
  <td class=xl12721411></td>
  <td class=xl12721411></td>
  <td class=xl12721411></td>
  <td class=xl12721411></td>
  <td class=xl12721411></td>
  <td class=xl12721411></td>
  <td class=xl12821411>　</td>
  <td class=xl12721411></td>
  <td class=xl12721411></td>
  <td class=xl12721411></td>
 </tr>
 <tr height=17 style='mso-height-source:userset;height:12.75pt'>
  <td height=17 class=xl6921411 style='height:12.75pt'></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td colspan=3 class=xl12921411>被保険者</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td colspan=10 rowspan=2 class=xl18321411>松原　稔</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl12621411>　</td>
  <td colspan=3 rowspan=4 height=59 class=xl6921411 width=45 style='mso-ignore:
  colspan-rowspan;height:44.25pt;width:34pt'><!--[if gte vml 1]><v:shape id="Oval_x0020_5"
   o:spid="_x0000_s3076" type="#_x0000_t75" style='position:absolute;
   margin-left:1.5pt;margin-top:1.5pt;width:32.25pt;height:30.75pt;z-index:4;
   visibility:visible;mso-wrap-style:square;v-text-anchor:top' o:gfxdata="UEsDBBQABgAIAAAAIQDw94q7/QAAAOIBAAATAAAAW0NvbnRlbnRfVHlwZXNdLnhtbJSRzUrEMBDH
74LvEOYqbaoHEWm6B6tHFV0fYEimbdg2CZlYd9/edD8u4goeZ+b/8SOpV9tpFDNFtt4puC4rEOS0
N9b1Cj7WT8UdCE7oDI7ekYIdMayay4t6vQvEIrsdKxhSCvdSsh5oQi59IJcvnY8TpjzGXgbUG+xJ
3lTVrdTeJXKpSEsGNHVLHX6OSTxu8/pAEmlkEA8H4dKlAEMYrcaUSeXszI+W4thQZudew4MNfJUx
QP7asFzOFxx9L/lpojUkXjGmZ5wyhjSRJQ8YKGvKv1MWzIkL33VWU9lGfl98J6hz4cZ/uUjzf7Pb
bHuj+ZQu9z/UfAMAAP//AwBQSwMEFAAGAAgAAAAhADHdX2HSAAAAjwEAAAsAAABfcmVscy8ucmVs
c6SQwWrDMAyG74O9g9G9cdpDGaNOb4VeSwe7CltJTGPLWCZt376mMFhGbzvqF/o+8e/2tzCpmbJ4
jgbWTQuKomXn42Dg63xYfYCSgtHhxJEM3Elg372/7U40YalHMvokqlKiGBhLSZ9aix0poDScKNZN
zzlgqWMedEJ7wYH0pm23Ov9mQLdgqqMzkI9uA+p8T9X8hx28zSzcl8Zy0Nz33r6iasfXeKK5UjAP
VAy4LM8w09zU50C/9q7/6ZURE31X/kL8TKv1x6wXNXYPAAAA//8DAFBLAwQUAAYACAAAACEAWgjh
DWsCAACIBgAAEAAAAGRycy9zaGFwZXhtbC54bWzUVclu3DAMvRfoPwi6J/bMeJYYsYNg0hQB0iRA
2g/g2PJYiBZDUmb5+1KS7SztoWh6qU8Ul/cokqLPLw5SkB0zlmtV0MlpSglTla652hb0x/frkxUl
1oGqQWjFCnpkll6Unz+dH2qTg6pabQhCKJujoqCtc12eJLZqmQR7qjum0NpoI8Hh0WyT2sAewaVI
pmm6SGxnGNS2ZcxdRQstA7bb6zUT4jJQRFVjtIxSpUWZZeeJT8LLIQKF+6Ypp6v5cj6avCZYjd6X
2TLqvTwo34WgKYQE6BdCp0eOMluM6KPSx0xms9k8HW1vmAf9e+be/Q3rwGU7IqEyuqCUOHZwgqsn
lCOn2j12D6bnv9s9GMLrgs4pUSCxTfc7EGROk9EhekNuu1tdPdm+Z/AXHZPAFdLodQtqyy4N5t76
FuL0eL7Yk7s+vXB6navFrMlm/03XmCU8O433gfzQGPnRlDyObhpyKOhymq3mUyzGsaCrRTpJl6EU
kGMVSYUOs7M02Ct0mC0nWbQnMREP1BnrvjL94aSIByooDjLvLAt3hd2tdb5QLyye0WrB62suxL+o
gzXbzVoYglNQ0Ovw0R5XVn/Scwnm6bk7qbTswPENF9wdw4OlRFb5zVZpAxvhWzjJBmQUf4GWHAfY
6sadIlSC7eEVG1YA4k3SJI4TxuaCbaE6Pr4shLUW2tyommHHzsJsvSqTr5lQHy0W2SO0H4U3LQiH
1yVMwzdc9D8t4SL7XQ39gF6BbeOs2KO90s77QW70s6qD5N/3l152wEWUcYCF6h+8f9aj2C8dwZlC
aAfDVni30sNuiL+Q8icAAAD//wMAUEsDBBQABgAIAAAAIQDvHXU4GQEAAJYBAAAPAAAAZHJzL2Rv
d25yZXYueG1sVFDRTsIwFH038R+aa+KbdBKmMOkIMTH6JBkQfa3b3bq4ttgWNvh6L0IyfOs995xz
z+l01umG7dD52hoB94MIGJrcFrWpBKxXL3djYD5IU8jGGhSwRw+z9PpqKpPCtibD3TJUjEyMT6QA
FcIm4dznCrX0A7tBQ7vSOi0Dja7ihZMtmeuGD6PogWtZG7qg5AafFebfy60W4Hbbz7GpWv+RqXi9
OuDiJ1ILIW5vuvkTsIBd6Mln9VshIAZWvu6/XF1k0gd0AqgOlaNikFLirpmbXFnHygx9faA6J7x0
VjNnWwGjR2C5begxgiPyXpYeA/EmUUxetPqP8KNtsCfxmXFyuRBP4iElu9BGQDre5/kb+u9MfwEA
AP//AwBQSwECLQAUAAYACAAAACEA8PeKu/0AAADiAQAAEwAAAAAAAAAAAAAAAAAAAAAAW0NvbnRl
bnRfVHlwZXNdLnhtbFBLAQItABQABgAIAAAAIQAx3V9h0gAAAI8BAAALAAAAAAAAAAAAAAAAAC4B
AABfcmVscy8ucmVsc1BLAQItABQABgAIAAAAIQBaCOENawIAAIgGAAAQAAAAAAAAAAAAAAAAACkC
AABkcnMvc2hhcGV4bWwueG1sUEsBAi0AFAAGAAgAAAAhAO8ddTgZAQAAlgEAAA8AAAAAAAAAAAAA
AAAAwgQAAGRycy9kb3ducmV2LnhtbFBLBQYAAAAABAAEAPUAAAAIBgAAAAA=
" o:insetmode="auto">
   <v:imagedata src="KOUKI.files/各申請書_21411_image005.png" o:title=""/>
   <o:lock v:ext="edit" aspectratio="f"/>
   <x:ClientData ObjectType="Pict">
    <x:SizeWithCells/>
    <x:CF>Bitmap</x:CF>
    <x:AutoPict/>
   </x:ClientData>
  </v:shape><![endif]--><![if !vml]><span style='mso-ignore:vglayout'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td width=2 height=2></td>
   </tr>
   <tr>
    <td></td>
    <td><img width=43 height=41 src="KOUKI.files/各申請書_21411_image006.png"
    v:shapes="Oval_x0020_5"></td>
    <td width=0></td>
   </tr>
   <tr>
    <td height=16></td>
   </tr>
  </table>
  </span><![endif]><!--[if !mso & vml]><span style='width:33.75pt;height:44.25pt'></span><![endif]--></td>
 </tr>
 <tr height=17 style='mso-height-source:userset;height:12.75pt'>
  <td height=17 class=xl6921411 style='height:12.75pt'></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td colspan=3 class=xl12921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411 colspan=2>氏名</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411>&#12958;</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl12621411>　</td>
 </tr>
 <tr height=8 style='mso-height-source:userset;height:6.0pt'>
  <td height=8 class=xl6921411 style='height:6.0pt'></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl12921411></td>
  <td class=xl12921411></td>
  <td class=xl12921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl12921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl12621411>　</td>
 </tr>
 <tr height=17 style='mso-height-source:userset;height:12.75pt'>
  <td height=17 class=xl10121411 style='height:12.75pt'></td>
  <td class=xl10121411></td>
  <td class=xl13021411></td>
  <td class=xl6921411></td>
  <td colspan=3 rowspan=3 class=xl12921411>代理人</td>
  <td class=xl6921411></td>
  <td class=xl6921411 colspan=2>住所</td>
  <td class=xl6921411></td>
  <td colspan=19 class=xl17721411>大阪府大阪市中央区東心斎橋1-15-27 6Ｆ</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl13121411></td>
  <td class=xl13121411></td>
  <td class=xl13121411></td>
  <td class=xl13121411></td>
  <td class=xl13121411></td>
  <td class=xl13121411></td>
  <td class=xl13121411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl12621411>　</td>
 </tr>
 <tr height=7 style='mso-height-source:userset;height:5.25pt'>
  <td height=7 class=xl10121411 style='height:5.25pt'></td>
  <td class=xl10121411></td>
  <td class=xl13021411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl12921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl13121411></td>
  <td class=xl13121411></td>
  <td class=xl13121411></td>
  <td class=xl13121411></td>
  <td class=xl13121411></td>
  <td class=xl13121411></td>
  <td class=xl13121411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl12621411>　</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=17 style='mso-height-source:userset;height:12.75pt'>
  <td height=17 class=xl6921411 style='height:12.75pt'></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411 colspan=2>氏名</td>
  <td class=xl6921411></td>
  <td class=xl6921411 colspan=15>日本マッサージ師支援協会　理事長　野中勝志</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl13121411></td>
  <td class=xl13121411></td>
  <td class=xl13121411></td>
  <td class=xl13121411></td>
  <td class=xl13121411></td>
  <td class=xl13121411></td>
  <td class=xl13121411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl12621411>　</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=7 style='mso-height-source:userset;height:5.25pt'>
  <td height=7 class=xl7521411 style='height:5.25pt'>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7221411>　</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=17 style='mso-height-source:userset;height:12.75pt'>
  <td rowspan=4 height=68 class=xl17821411 style='border-bottom:.5pt solid black;
  height:51.0pt;border-top:none'>同</br>意</br>記</br>録</td>
  <td colspan=7 class=xl9021411 style='border-right:.5pt solid black;
  border-left:none'>同意医師の氏名</td>
  <td colspan=12 class=xl9021411 style='border-right:.5pt solid black;
  border-left:none'>住　　　　　所</td>
  <td colspan=10 class=xl9021411 style='border-left:none'>同　意　年　月　日</td>
  <td colspan=6 class=xl9021411 style='border-right:.5pt solid black'>傷病名</td>
  <td colspan=8 class=xl9021411 style='border-right:.5pt solid black;
  border-left:none'>要加療期間</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=17 style='mso-height-source:userset;height:12.75pt'>
  <td colspan=7 rowspan=3 height=51 class=xl9321411 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black;height:38.25pt'>松原　稔</td>
  <td colspan=12 rowspan=3 class=xl15021411 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>大阪府大阪市中央区日本橋1-3-1-3F</td>
  <td class=xl13221411 style='border-top:none;border-left:none'>　</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl9621411 style='border-top:none'>　</td>
  <td class=xl10521411 style='border-top:none'>　</td>
  <td colspan=6 rowspan=3 class=xl15921411 width=102 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black;width:78pt'>上記記載のとおり</td>
  <td colspan=8 rowspan=3 class=xl16821411 width=136 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black;width:104pt'>上記記載のとおり</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=17 style='mso-height-source:userset;height:12.75pt'>
  <td height=17 class=xl6821411 style='height:12.75pt;border-left:none'>　</td>
  <td class=xl6921411 colspan=2>平成</td>
  <td class=xl13921411><?php echo date("Y",strtotime($row["douinengappi"])) - 1988 ?></td>
  <td class=xl6921411>年</td>
  <td class=xl13321411 align=right><?php echo date("n",strtotime($row["douinengappi"])) ?></td>
  <td class=xl6921411>月</td>
  <td class=xl13421411 align=right><?php echo date("j",strtotime($row["douinengappi"])) ?></td>
  <td class=xl6921411>日</td>
  <td class=xl12621411>　</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=17 style='mso-height-source:userset;height:12.75pt'>
  <td height=17 class=xl13521411 style='height:12.75pt;border-left:none'>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7521411>　</td>
  <td class=xl7221411>　</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=15 style='height:11.25pt'>
  <td height=15 class=xl6921411 style='height:11.25pt'></td>
  <td class=xl10121411 colspan=5>記入上の注意</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=15 style='height:11.25pt'>
  <td height=15 class=xl6921411 style='height:11.25pt'></td>
  <td class=xl10121411 colspan=24>1.施術内容の傷病名、初回の施術内容については、該当する項目を○で囲んで下さい。</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=15 style='height:11.25pt'>
  <td height=15 class=xl6921411 style='height:11.25pt'></td>
  <td class=xl10121411 colspan=23>2.「摘要」欄は往療を必要とした理由、施術に関する特記事項等を記入して下さい。</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=15 style='height:11.25pt'>
  <td height=15 class=xl6921411 style='height:11.25pt'></td>
  <td class=xl10121411 colspan=39>3.初療の日から3ヶ月を経過した時点における同意書については、実際に医師から同意を得ていれば必ずしも添付は要しません。この場合には、</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=15 style='height:11.25pt'>
  <td height=15 class=xl6921411 style='height:11.25pt'></td>
  <td class=xl10121411 colspan=36>　同意をした医師の氏名、同意年月日、傷病名、要加療期間の指示等がある場合にはその期間を「同意記録」欄に記入して下さい。</td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=15 style='height:11.25pt'>
  <td height=15 class=xl6921411 style='height:11.25pt'></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=15 style='height:11.25pt'>
  <td height=15 class=xl6921411 style='height:11.25pt'></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <tr height=15 style='height:11.25pt'>
  <td height=15 class=xl6921411 style='height:11.25pt'></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
  <td class=xl6921411></td>
 </tr>
 <![if supportMisalignedColumns]>
 <tr height=0 style='display:none'>
  <td width=20 style='width:15pt'></td>
  <td width=19 style='width:14pt'></td>
  <td width=17 style='width:13pt'></td>
  <td width=17 style='width:13pt'></td>
  <td width=17 style='width:13pt'></td>
  <td width=17 style='width:13pt'></td>
  <td width=17 style='width:13pt'></td>
  <td width=17 style='width:13pt'></td>
  <td width=17 style='width:13pt'></td>
  <td width=17 style='width:13pt'></td>
  <td width=17 style='width:13pt'></td>
  <td width=17 style='width:13pt'></td>
  <td width=17 style='width:13pt'></td>
  <td width=17 style='width:13pt'></td>
  <td width=17 style='width:13pt'></td>
  <td width=17 style='width:13pt'></td>
  <td width=17 style='width:13pt'></td>
  <td width=17 style='width:13pt'></td>
  <td width=17 style='width:13pt'></td>
  <td width=17 style='width:13pt'></td>
  <td width=17 style='width:13pt'></td>
  <td width=17 style='width:13pt'></td>
  <td width=19 style='width:14pt'></td>
  <td width=20 style='width:15pt'></td>
  <td width=17 style='width:13pt'></td>
  <td width=17 style='width:13pt'></td>
  <td width=17 style='width:13pt'></td>
  <td width=17 style='width:13pt'></td>
  <td width=17 style='width:13pt'></td>
  <td width=17 style='width:13pt'></td>
  <td width=17 style='width:13pt'></td>
  <td width=17 style='width:13pt'></td>
  <td width=17 style='width:13pt'></td>
  <td width=17 style='width:13pt'></td>
  <td width=17 style='width:13pt'></td>
  <td width=17 style='width:13pt'></td>
  <td width=17 style='width:13pt'></td>
  <td width=17 style='width:13pt'></td>
  <td width=17 style='width:13pt'></td>
  <td width=17 style='width:13pt'></td>
  <td width=17 style='width:13pt'></td>
  <td width=17 style='width:13pt'></td>
  <td width=17 style='width:13pt'></td>
  <td width=17 style='width:13pt'></td>
  <td width=17 style='width:13pt'></td>
  <td width=13 style='width:10pt'></td>
  <td width=15 style='width:11pt'></td>
 </tr>
 <![endif]>
</table>

</div>


<!----------------------------->
<!--Excel の Web ページとして発行 ウィザードのアウトプットの終わり-->
<!----------------------------->
</body>

</html>
