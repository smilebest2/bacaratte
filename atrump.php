<?php
session_start();
$end_game = false;		//終了フラグ
$cards   = array();     //山札
$player  = array();     //プレイヤーの手札
$opp     = array();     //対戦相手の手札

if(!isset($_GET['next'])){
echo 'test';
	$cards = init_cards();
    $_SESSION['cards'] = $cards;
//    if(isset($_SESSION['player']))       $player = $_SESSION['player'];
//    if(isset($_SESSION['opponent']))     $opp    = $_SESSION['opponent'];
    if(isset($_SESSION['result']))       $_SESSION['result'] = NULL;
}

//勝敗履歴用
$rst = $_SESSION['result'];

if(isset($_SESSION['cards']) && !isset($_GET['next'])){
    $cards = $_SESSION['cards'];
    echo 'test2';
} else {
echo 'test3';
    $cards = $_SESSION['cards'];
    $cardsd = count($cards);
}
echo " card:" . $cardsd;
//2枚ずつカードを配る
$player[]    = array_shift($cards);
$opp[]       = array_shift($cards);
$player[]    = array_shift($cards);
$opp[]       = array_shift($cards);

//合計
$player_total    = sum_up_hands($player);
if($player_total > 9){
	if($player_total > 19){
		$player_total = $player_total - 20;
	}else{
		$player_total = $player_total - 10;
	}
}
$opp_total       = sum_up_hands($opp);
if($opp_total > 9){
	if($opp_total > 19){
		$opp_total = $opp_total - 20;
	}else{
		$opp_total = $opp_total -10;
	}
}

if($player_total > 7 || $opp_total > 7){  //プレイヤー、バンカーどちらかが8,9の場合
	$ck = "aaaa";
}else{
	//プレイヤー6か7か
	if($player_total > 5){
		//バンカー6か7か
		if($opp_total > 5){
			$ck = "bbbb";
			//バンカー6の場合はバンカーカード追加
			if($opp_total == 6){
				$ck = "cccc";
				$opp[]       = array_shift($cards);
				$opp_total       = sum_up_hands($opp);
			}
		}else{
			//ヒットアンドスタンドチャート
			//プレイヤーが6か7で3枚目を引いていないので無条件でバンカーカード追加
			$ck = "dddd";
			$opp[]       = array_shift($cards);
			$opp_total   = sum_up_hands($opp);
		}
	}else{
	$ck = "eeee";
		//プレイヤー5以下なのでカード追加
		$player[]   = array_shift($cards);
		$ck_total   = sum_up_hands($player);
		$new_card   = abs($ck_total - $player_total);
		$player_total = $ck_total;
		
		//ヒットアンドスタンドチャート
		if($opp_total == 6){
			if($new_card == 6 || $new_card == 16 || $new_card == 26 || $new_card == 7 || $new_card == 17 || $new_card == 27){
				$ck = "ffff";
				$opp[]       = array_shift($cards);
				$opp_total   = sum_up_hands($opp);
			}
		}
		if($opp_total == 5){
			if($new_card == 4 || $new_card == 14 || $new_card == 24 || $new_card == 5 || $new_card == 15 || $new_card == 25 || $new_card == 6 || $new_card == 16 || $new_card == 26 || $new_card == 7 || $new_card == 17 || $new_card == 27){
				$ck = "gggg";
				$opp[]       = array_shift($cards);
				$opp_total   = sum_up_hands($opp);
			}
		}
		if($opp_total == 4){
			if($new_card == 2 || $new_card == 12 || $new_card == 22 || $new_card == 3 || $new_card == 13 || $new_card == 23 || $new_card == 4 || $new_card == 14 || $new_card == 24 || $new_card == 5 || $new_card == 15 || $new_card == 25 || $new_card == 6 || $new_card == 16 || $new_card == 26 || $new_card == 7 || $new_card == 17 || $new_card == 27){
				$ck = "hhhh";
				$opp[]       = array_shift($cards);
				$opp_total   = sum_up_hands($opp);
			}
		}
		if($opp_total == 3){
			if($new_card <> 8 || $new_card <> 18 || $new_card <> 28){
				$ck = "jjjj";
				$opp[]       = array_shift($cards);
				$opp_total   = sum_up_hands($opp);
			}
		}
		if($opp_total < 3){
		$ck = "kkkk";
			$opp[]       = array_shift($cards);
			$opp_total   = sum_up_hands($opp);
		}
	}

}
//山カード配列を次回引き渡し用
$_SESSION['cards'] = $cards;

if($player_total > 19){
	$player_total = $player_total - 20;
}
if($player_total > 9){
	$player_total = $player_total - 10;
}
if($opp_total > 19){
	$opp_total = $opp_total -20;
}
if($opp_total > 9){
	$opp_total = $opp_total -10;
}

//勝敗結果
if($player_total > $opp_total){
	$_SESSION['result'] .= "P";
}
if($player_total == $opp_total){
	$_SESSION['result'] .= "t";
}
if($player_total < $opp_total){
	$_SESSION['result'] .= "B";
} 
$rst = $_SESSION['result'];
function init_cards(){
    //山札を用意する
    $cards = array();
    $suits = array('s', 'h', 'd', 'c');
	 for($cnt=1;$cnt<=8;$cnt++){
	    foreach($suits as $suit){
	        for($i=1;$i<=13;$i++){
	            $cards[] = array(
	                'num' => $i,
	                'suit' => $suit
	            );
	        }
	    }
	 }
    shuffle($cards);
    return $cards;
}
 
function sum_up_hands($hands){
    $ace = 0;
    $total = 0;
    foreach($hands as $card){
        $num = $card['num'];
        if($num > 10){
            $total += 10;
        }else {
            $total += $num;
        }
    }
    
    return $total;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Content-Style-Type" content="text/css">

<style type="text/css">
 <!--
body
        {
         margin:0px;
         padding:0px;
        }
#wrapper{
     width: 960px;
     margin: 0 auto;
}
#log_space
        {
         width:900px;
         height:200px;
         background-color:#cc6600;
        }
#logo
        {
         width:900px;
         height:50px;
         background-color:#cc6600;
         text-align: center;
         font-size: 100%;
        }
#player_card
        {
         width:450px;
         height:300px;
         float:left;
         background-color:#ff9933;
         text-align: center;
         font-size: 100%;
        }
#banker_card
        {
         width:450px;
         height:300px;
         float:left;
         background-color:#ff9933;
         text-align: center;
         font-size: 100%;
        }
#bet_player
        {
         width:450px;
         height:300px;
         float:left;
         background-color:#009933;
         text-align: center;
         font-size: 100%;
        }
#bet_banker
        {
         width:450px;
         height:300px;
         float:left;
         background-color:#009933;
         text-align: center;
         font-size: 100%;
        }
table , td, th {
	border: 1px solid #595959;
	border-collapse: collapse;
	background-color: #ffffff;
	margin-left: auto;
	margin-right: auto;
}
td, th {
	padding: 3px;
	width: 25px;
	height: 20px;
	font-size: 80%;
}
th {
	background: #f0e6cc;
}
.even {
	background: #fbf8f0;
}
.odd {
	background: #fefcf9;
}

 -->
</style>
<title>Baccarat</title>
</head>
<body>
<div id="wrapper">
<div id="log_space">
<br>
<table>
	<tbody>

	</tbody>
</table>
</div>
<div id="logo">BACCARAT</div>
<div id="player_card">PLAYER</div>
<div id="banker_card">BANKER</div>

<div id="bet_player">PLAYER</div>
<div id="bet_banker">BANKER</div>
</div>
</body>
</html>