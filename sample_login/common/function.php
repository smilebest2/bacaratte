<?php

require_once 'const.php';



/**

 * 共通関数

 */



//$_SERVERが持っている値

// $_SERVER['PHP_SELF']現在実行しているスクリプトのファイル名。ドキュメントルートから取得されます。

// $_SERVER['GATEWAY_INTERFACE']サーバーが使用しているCGIのバージョン。例："CGI/1.1"など

// $_SERVER['SERVER_NAME']サーバーのホスト名。

// $_SERVER['SERVER_SOFTWARE']サーバーの 認識文字列、つまりサーバソフト名です。

// $_SERVER['SERVER_PROTOCOL']ページがリクエストされた時のプロトコル名とバージョン。例："HTTP/1.0"など

// $_SERVER['REQUEST_METHOD']ページがリクエストされた時のリクエストメソッド名。例：'GET'・'HEAD'・'POST'・'PUT'など

// $_SERVER['REQUEST_TIME']リクエスト開始時のタイムスタンプ。PHP5.1.0以降で対応。

// $_SERVER['QUERY_STRING']ページがリクエストされた時に、検索引数があればそれが格納される。

// $_SERVER['DOCUMENT_ROOT']現在実行されているスクリプトのドキュメントルートディレクトリ。

// $_SERVER['HTTP_ACCEPT']現在のリクエストのAccept。ヘッダがあればその内容。

// $_SERVER['HTTP_ACCEPT_CHARSET']現在のリクエストのAccept-Charset。ヘッダがあればその内容。例：'UTF-8'

// $_SERVER['HTTP_ACCEPT_ENCODING']現在のリクエストのAccept-Encoding。ヘッダがあればその内容。例: "gzip"

// $_SERVER['HTTP_ACCEPT_LANGUAGE']現在のリクエストのAccept-Language。ヘッダがあればその内容。例："ja"・"en"

// $_SERVER['HTTP_CONNECTION']現在のリクエストのConnection。ヘッダがあればその内容。例："keep-alive"

// $_SERVER['HTTP_HOST']現在のリクエストのHost。ヘッダがあればその内容。

// $_SERVER['HTTP_REFERER']現在のページの前に参照していたページのURL。ブラウザによりセットされる値であり、またブラウザによってはこの値を変更する機能を持つものもあるので注意が必要。

// $_SERVER['HTTP_USER_AGENT']現在のリクエストのUser-Agent。ヘッダがあればその内容。ユーザエージェントとはまぁ、ブラウザの事。例："Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0; DigExt)"など

// $_SERVER['REMOTE_ADDR']ページを見ている人のIPアドレス。

// $_SERVER['REMOTE_HOST']ページを見ている人のホスト名。

// $_SERVER['REMOTE_PORT']ユーザーのマシンからWebサーバへの通信に使用されているポート番号。

// $_SERVER['SCRIPT_FILENAME']現在実行されているスクリプトの絶対パス

// $_SERVER['SERVER_ADMIN']サーバに設定されているSERVER_ADMINの値。

// $_SERVER['SERVER_PORT']Webサーバの通信ポートとして使用されているポート番号。通常は"80"番ポートが多いです。

// $_SERVER['SERVER_SIGNATURE']ページに追加する為にサーバ上で生成された、サーバーのバージョン名とバーチャルホスト名。

// $_SERVER['PATH_TRANSLATED']バーチャルからリアルへのマッピングがなされた後の、現在のスクリプトのファイルシステム上（ドキュメントルートではなく）でのパス。

// $_SERVER['SCRIPT_NAME']現在のスクリプトのパス。スクリプト自身のページを指定するのに$_SERVER['PHP_SELF']とともに重宝します。

// $_SERVER['REQUEST_URI']ページにアクセスするために指定されたURI。例："/index.html"・"/somedir/somefile.php"など

// $_SERVER['PHP_AUTH_USER']PHPをApacheのモジュールとして実行していて、HTTP認証をしている時にそのユーザ名がセットされる。

// $_SERVER['PHP_AUTH_PW']PHPをApacheのモジュールとして実行していて、HTTP認証をしている時にそのユーザのパスワードがセットされる。

// $_SERVER['AUTH_TYPE'']PHPをApacheのモジュールとして実行していて、HTTP認証をしている時にその認証形式がセットされる。

// $_SERVER['argv']	スクリプトに渡された引数を配列にしたものです。PHPがコマンドラインから実行された場合にコマンドライン引数としてアクセスする事ができます。GETメソッドを通して呼び出された場合は検索引数が格納されます。

// $_SERVER['argc']PHPがコマンドライン上で実行された場合にスクリプトに渡された引数の数が渡されます。



/**

 * ヘッダー部の組み立て

 */
 /**
function htmlheader($pagetitle){

$strret ="<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta http-equiv="Content-Style-Type" content="text/css" /><meta http-equiv="Content-Script-Type" content="text/javascript" /><title>$pagetitle</title><link href="../css/style.css" rel="stylesheet" type="text/css" /></head><body><div id="container">";
return $strret;
}


/**

 * 親ディレクトリのパスを取得

 */

function getParentDirPath()

{

	$path = $_SERVER["HTTP_HOST"];

	$path .= rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");

	return $path;

}



/**

 * 電話番号正規チェック

 * @param $value

 * @return エラーならメッセージ、エラーじゃなければ空文字

 */

function checkRegularTel($value)

{

	if(!preg_match("/^[0-9]{2,4}+-[0-9]{2,4}+-[0-9]{2,4}$/", $value))

	{

		return "電話番号が未入力か、正しくありません。<br />";

	}

	return "";

}



/**

 * メールアドレス正規チェック

 * @param $value

 * @return エラーならメッセージ、エラーじゃなければ空文字

 */

function checkRegularMail($value)

{

	if (!preg_match("/^[^@]+@([-a-z0-9]+\.)+[a-z]{2,}$/", $value))

	{

		return "ＰＣメールアドレスが正しくありません。<br />";

	}

	return "";

}



/**

 * パスワード正規チェック

 * @param $value

 * @return エラーならメッセージ、エラーじゃなければ空文字

 */

function checkRegularPass($value)

{

	if (!preg_match("/^[a-z]{2}+[0-9]{4}$/", $value))

	{

		return "パスワードは半角英字2桁＋半角数字4桁で入力して下さい。(記号不可)<br />";

	}

	return "";

}



/**

 * exit()の文字化け対応

 * @param unknown_type $status

 */

function mb_exit($status=0)

{

	if (is_string($status) && !headers_sent())

	{

		header('Content-Type: text/plain; charset=utf-8');

	}

	exit($status);

}



/**

 * 必須チェック

 * @param	Array	POST配列

 * @return	String	エラーメッセージ

 */

function checkRequired($arrayPost)

{

	$errMsg = null;

	foreach($arrayPost as $key => $value)

	{

		if(strrpos($key, "required") !== false)

		{

			if(strlen($value) <= 0)

			{

				$errMsg .= constant($key) . MSG_ERR_002 . "<br />";

			}

		}

	}

	return $errMsg;

}


/**

 * 緯度経度の取得

 */

function get_gps_from_address( $address='' ){
    $res = array();
    $req = 'http://maps.google.com/maps/api/geocode/xml';
    $req .= '?address='.urlencode($address);
    $req .= '&sensor=false';    
    $xml = simplexml_load_file($req) or die('XML parsing error');
    if ($xml->status == 'OK') {
        $location = $xml->result->geometry->location;
        $res['lat'] = (string)$location->lat[0];
        $res['lng'] = (string)$location->lng[0];
        
    }
    else{
    $res['out'] = "out";
    }
    return $res;
}

/**

 * 距離計算

 */
function location_distance($lat1, $lon1, $lat2, $lon2){
	$lat_average = deg2rad( $lat1 + (($lat2 - $lat1) / 2) );//２点の緯度の平均
	$lat_difference = deg2rad( $lat1 - $lat2 );//２点の緯度差
	$lon_difference = deg2rad( $lon1 - $lon2 );//２点の経度差
	$curvature_radius_tmp = 1 - 0.00669438 * pow(sin($lat_average), 2);
	$meridian_curvature_radius = 6335439.327 / sqrt(pow($curvature_radius_tmp, 3));//子午線曲率半径
	$prime_vertical_circle_curvature_radius = 6378137 / sqrt($curvature_radius_tmp);//卯酉線曲率半径
	
	//２点間の距離
	$distance = pow($meridian_curvature_radius * $lat_difference, 2) + pow($prime_vertical_circle_curvature_radius * cos($lat_average) * $lon_difference, 2);
	$distance = sqrt($distance);
	
	$distance_unit = round($distance);
//	if($distance_unit < 1000){//1000m以下ならメートル表記
//		$distance_unit = $distance_unit."m";
//	}else{//1000m以上ならkm表記
		$distance_unit = round($distance_unit / 100);
		$distance_unit = ($distance_unit / 10);
//	}
	
	//$hoge['distance']で小数点付きの直線距離を返す（メートル）
	//$hoge['distance_unit']で整形された直線距離を返す（1000m以下ならメートルで記述 例：836m ｜ 1000m以下は小数点第一位以上の数をkmで記述 例：2.8km）
	return array("distance" => $distance, "distance_unit" => $distance_unit);
}


/**

 * セッション管理用

 */
function session_register($var){
$_SESSION[$var] = "";
}

/**

 * パスワード、メールアドレスの比較

 * @param	Array	POST配列

 * @return	Boolean	true:一致 false:不一致

 */

function isSame($arrayPost)

{

	$pass = null;

	$passKakunin = null;

	$mail = null;

	$mailKakunin = null;

	foreach($arrayPost as $key => $value)

	{

		//パスワード

		if($pass === null && strrpos($key, "pass") !== false)

		{

			$pass = $value;

		}

		if(strrpos($key, "pass_kakunin") !== false)

		{

			$passKakunin = $value;

		}

		//メールアドレス

		if($mail === null && strrpos($key, "mail") !== false)

		{

			$mail = $value;

		}

		if(strrpos($key, "mail_kakunin") !== false)

		{

			$mailKakunin = $value;

		}

	}

	if($pass !== $passKakunin)

	{

		return false;

	}

	if($mail !== $mailKakunin)

	{

		return false;

	}

	return true;

}

/**

 * 配列の文字エンコードのチェックを行う
 
*/

function cken(array $data)
{
	$result = true;
	foreach($data as $key => $value){
		if(is_array($value)){
		//含まれている値が配列のとき文字列に連結する
			$value = implode("",$value);	//配列に入っている値を連結したストリングにしてチェックします
		}
		if(!mb_check_encoding($value)){
			//文字エンコードが一致しないとき
			$result = false;
			break;
		}
	}
	return $result;

}
/**

 * xss対策のためのHTMLエスケープ
 
*/
function es($data, $charset)
{
	//配列のとき
	if(is_array($data)){
		//再帰呼び出し
		return array_map(__METHOD__, $data);
	}else{
		htmlspecialchars($data, ENT_QUOTES, $charset);
	}

}
/********************************************************************************
function convGtJDate($src) {
    list($year, $month, $day) = explode('/', $src);
    if (!@checkdate($month, $day, $year) || $year < 1869 || strlen($year) !== 4
            || strlen($month) !== 2 || strlen($day) !== 2) return false;
    $date = str_replace('/', '', $src);
    if ($date >= 19890108) {
        $gengo = '平成';
        $wayear = $year - 1988;
    } elseif ($date >= 19261225) {
        $gengo = '昭和';
        $wayear = $year - 1925;
    } elseif ($date >= 19120730) {
        $gengo = '大正';
        $wayear = $year - 1911;
    } else {
        $gengo = '明治';
        $wayear = $year - 1868;
    }
    switch ($wayear) {
        case 1:
            $wadate = $gengo.'元年'.$month.'月'.$day.'日';
            break;
        default:
            $wadate = $gengo.sprintf("%02d", $wayear).'年'.$month.'月'.$day.'日';
    }
    return $wadate;
}
function convJtGDate($src) {
    $a = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '0');
    $g = mb_substr($src, 0, 2, 'UTF-8');
    array_unshift($a, $g);
    if (($g !== '明治' && $g !== '大正' && $g !== '昭和' && $g !== '平成')
            || (str_replace($a, '', $src) !== '年月日' && str_replace($a, '', $src) !== '元年月日')) return false;
    $y = strtok(str_replace($g, '', $src), '年月日');
    $m = strtok('年月日');
    $d = strtok('年月日');
    if (mb_strpos($src, '元年') !== false) $y = 1;
    if ($g === '平成') $y += 1988;
    elseif ($g === '昭和') $y += 1925;
    elseif ($g === '大正') $y += 1911;
    elseif ($g === '明治') $y += 1868;
    if (strlen($y) !== 4 || strlen($m) !== 2 || strlen($d) !== 2 || !@checkdate($m, $d, $y)) return false;
    return $y.'/'.$m.'/'.$d;
}



/********************************************************************************

 * デバック用の関数

 ********************************************************************************/



/**

 * 即座に変数の内容を出力

 * @param unknown_type $var

 */

function debugEcho($var)

{

	echo $var;

	flush();

	ob_flush();

}



/**

* preタグで囲んだprint_r出力

* @param mixed $var 出力したい変数

* @return void

*/



function debugPrintR($var)

{

	echo "<pre>";

	print_r($var);

	echo "</pre>";

}



/**

 * print_rの詳細版

 * @param unknown_type $arr

 */

function debugVarDump($arr)

{

	var_dump($arr);

}