<?php
session_start();

require_once 'baccrat_common/mysql.php';

require_once 'baccrat_common/const.php';
$userid =1;
if(isset($_GET["no"]))
{
	$no = $_GET["no"];
}

$pcard = array();     //プレイヤーの手札
$bcard = array();     //バンカーの手札

$date = date("Y-m-d H:i:s");
$sec = date("s");
$mysql = new MySQL_cls();
$mysql->MySQL();
$mysql->actQuery("SELECT * FROM  MATCH_RESULT_TBL".$no." ORDER BY TStamp DESC LIMIT 1");
$TBL_match = $mysql->getResult();

$second = date("s", strtotime($TBL_match[TStamp]));

$pcard= explode("/",$TBL_match[Pcard]);
$bcard= explode("/",$TBL_match[Bcard]);

$mysql->actQuery("SELECT * FROM  GAME_RESULT_TBL".$no." WHERE GameNo = '$TBL_match[GameNo]'");
$TBL_game = $mysql->getResult();

$mysql->actQuery("SELECT * FROM  User_Balance WHERE UserId = ".$userid);
$UserBl = $mysql->getResult();
//ゲーム結果をhtmlテーブル表用に文字列編集
$last_result = "";
$edit_rst = array();
for($i = 0; $i < 70; $i++) {
	for($ii = 0; $ii < 6; $ii++) {
		$edit_rst[$i][$ii] = "K";
	}
}

$gyo = 0;
$retu = 0;
$ren_flg = false;
$sp_gyo = 0;
if($sec < 15){
$TBL_game[GameResult] = substr($TBL_game[GameResult], 0, -1);
}
for($i = 0; $i < strlen($TBL_game[GameResult]); $i++) {

  if($i == 0){
  	$edit_rst[0][0] = mb_substr($TBL_game[GameResult],$i,1);
  }
//table表
//0/6/12/18/24/30///
//1/7/13/19/25/31//
//2/8/14/20/26//32//
//3/9/15/21//27/33//
//4/10/16/22/28/34///
//5/11/17/23/29/35//

  //結果テーブル表示処理
  if($i <> 0){
  	$befor_rst = mb_substr($TBL_game[GameResult],$i-1,1);
  	$last_rst = mb_substr($TBL_game[GameResult],$i,1);
 	//連続フラグ
 	$renzoku = false;
 	$tie_flg = false;
 	if($befor_rst == $last_rst){$renzoku = true;}
 	if($last_rst == "Q"){$renzoku = true; $tie_flg = true;}
 	if($last_rst == "R"){$renzoku = true; $tie_flg = true;}
 	if($last_rst == "S"){$renzoku = true; $tie_flg = true;}
 	if($last_rst == "T"){$renzoku = true; $tie_flg = true;}
 	if($last_rst == "U"){$renzoku = true; $tie_flg = true;}
 	if($last_rst == "C"){$renzoku = true; $tie_flg = true;}
 	if($last_rst == "D"){$renzoku = true; $tie_flg = true;}
 	if($last_rst == "E"){$renzoku = true; $tie_flg = true;}
 	if($last_rst == "F"){$renzoku = true; $tie_flg = true;}
 	if($last_rst == "G"){$renzoku = true; $tie_flg = true;}
 	if($befor_rst == "Q" && $last_rst == "P"){$renzoku = true; }
 	if($befor_rst == "R" && $last_rst == "P"){$renzoku = true; }
 	if($befor_rst == "S" && $last_rst == "P"){$renzoku = true; }
 	if($befor_rst == "T" && $last_rst == "P"){$renzoku = true; }
 	if($befor_rst == "U" && $last_rst == "P"){$renzoku = true; }
 	if($befor_rst == "C" && $last_rst == "B"){$renzoku = true; }
 	if($befor_rst == "D" && $last_rst == "B"){$renzoku = true; }
 	if($befor_rst == "E" && $last_rst == "B"){$renzoku = true; }
 	if($befor_rst == "F" && $last_rst == "B"){$renzoku = true; }
 	if($befor_rst == "G" && $last_rst == "B"){$renzoku = true; }

  	if($renzoku){
  		$gyo = $gyo + 1;
  		if($gyo > 5){
  			if ($edit_rst[$retu + ($gyo -5)][5] == "K") {
  				if($sp_gyo == 0){
  					$edit_rst[$retu + ($gyo -5)][5]=$last_rst;
  				}else{
  					$edit_rst[$retu + ($gyo -5)][5 - $sp_gyo]=$last_rst;
  				}
  			}else{
  				$sp_gyo = $sp_gyo + 1;
  				$edit_rst[$retu + ($gyo -5)][5 - $sp_gyo]=$last_rst;
  			}
  		}else{
  			if($tie_flg){
  				$gyo = $gyo -1;
  				$edit_rst[$retu][$gyo]=$last_rst;
  			}else{
				if ($edit_rst[$retu][$gyo] == "K") {
					if (!$ren_flg) {
						$edit_rst[$retu][$gyo]=$last_rst;
					}else{
						$edit_rst[$retu + 1][$gyo -1]=$last_rst;
					}

				}else{
					$edit_rst[$retu + 1][$gyo -1]=$last_rst;
					$ren_flg = true;
				}
  			}

  		}
  	}else{
		$gyo = 0;
		$sp_gyo = 0;
		$ren_flg = false;
  		$retu = $retu + 1;
  		$edit_rst[$retu][0]=$last_rst;

  	}
  }

}

//カードの情報
$cnt = 0;
$pcard_img = array();
$pcard3_flg = 0;
$ptotal=0;
$pcard_num = array();

$card_result="PLAYER";
foreach($pcard as $card){
  $pcard_img[$cnt] = 'card_pic/' . $card . '.gif';
  $num = substr($card,1);
  if(intval($num) > 9){
  	$num = 0;
  }
  $ptotal= $ptotal + intval($num);
  $pcard_num[] = intval($num);
  $cnt = $cnt + 1;
}
//カードtotal表示用
$pcard_num[1] = $pcard_num[0] + $pcard_num[1];
if($pcard_num[1] > 10){$pcard_num[1] = $pcard_num[1] -10;}

//3枚目あるか
if($cnt == 3){
	$pcard3_flg = 1;
	$pcard_num[2] = $pcard_num[1] + $pcard_num[2];
	if($pcard_num[2] > 10){
		$pcard_num[2] = $pcard_num[2] - 10;
	}
}else{
	$pcard_img[2] = 'card_pic/ura.gif';
}

$cnt = 0;
$bcard_img = array();
$bcard3_flg = 0;
$btotal = 0;
$bcard_num = array();
foreach($bcard as $card){
  $bcard_img[$cnt] = 'card_pic/' .$card . '.gif';
  $num = substr($card,1);
  if(intval($num) > 9){
  	$num = 0;
  }
  $btotal= $btotal + intval($num);
  $bcard_num[] = intval($num);
  $cnt = $cnt + 1;
}
//カードtotal表示用
$bcard_num[1] = $bcard_num[0] + $bcard_num[1];
if($bcard_num[1] > 10){$bcard_num[1] = $bcard_num[1] -10;}
if($cnt == 3){
	$bcard3_flg = 1;
	$bcard_num[2] = $bcard_num[1] + $bcard_num[2];
	if($bcard_num[2] > 10){
		$bcard_num[2] = $bcard_num[2] -10;
	}
}else{
	$bcard_img[2] = 'card_pic/ura.gif';
}
$sec = 62 - intval($sec);

$player_beted = 0;
$banker_beted = 0;
$tie_beted = 0;
$pp_beted = 0;
$pb_beted = 0;
//カード描画中のチップ表示
if($sec > 45){
	$sql = "SELECT SUM(Player) AS Player,SUM(Banker) AS Banker,SUM(Tie) AS Tie,SUM(PePlayer) AS PePlayer,SUM(PeBanker) AS PeBanker FROM Betting_TBL".$no." WHERE GameNo = '$TBL_match[GameNo]' AND NO = '$TBL_match[NO]' AND UserId = '$userid' AND BetResult != 'cancel'";
	$mysql->actQuery($sql);
	$Beted = $mysql->getResult();
	//ベッド存在するかの判定
	$player_beted = ($Beted[Player] == NULL) ? 0 : 1;
	$banker_beted = ($Beted[Banker] == NULL) ? 0 : 1;
	$tie_beted = ($Beted[Tie] == NULL) ? 0 : 1;
	$pp_beted = ($Beted[PePlayer] == NULL) ? 0 : 1;
	$pb_beted = ($Beted[PeBanker] == NULL) ? 0 : 1;
	//ベッドキャンセル時の判定
	$player_beted = ($Beted[Player] == 0) ? 0 : 1;
	$banker_beted = ($Beted[Banker] == 0) ? 0 : 1;
	$tie_beted = ($Beted[Tie] == 0) ? 0 : 1;
	$pp_beted = ($Beted[PePlayer] == 0) ? 0 : 1;
	$pb_beted = ($Beted[PeBanker] == 0) ? 0 : 1;
	
	//カード描画中は直前のbalanceを表示
	$sql = "SELECT * FROM Betting_TBL".$no." WHERE GameNo = '$TBL_match[GameNo]' AND NO = '$TBL_match[NO]' AND UserId = '$userid' AND BetResult != 'cancel' ORDER BY BetNO DESC LIMIT 1";
	$mysql->actQuery($sql);
	$befor_bal = $mysql->getResult();
	if($befor_bal){
		$UserBl[Balance] = $befor_bal[Balance];
	}
}else{
//ベッド中にテーブル移動した場合のチップ表示
	$sql = "SELECT SUM(Player) AS Player,SUM(Banker) AS Banker,SUM(Tie) AS Tie,SUM(PePlayer) AS PePlayer,SUM(PeBanker) AS PeBanker FROM Betting_TBL".$no." WHERE GameNo = '$TBL_match[GameNo]' AND NO = '$TBL_match[NO]'+ 1 AND UserId = '$userid' AND BetResult IS NULL";
	$mysql->actQuery($sql);
	$Beted = $mysql->getResult();
	//ベッド存在するかの判定
	$player_beted = ($Beted[Player] == NULL) ? 0 : 1;
	$banker_beted = ($Beted[Banker] == NULL) ? 0 : 1;
	$tie_beted = ($Beted[Tie] == NULL) ? 0 : 1;
	$pp_beted = ($Beted[PePlayer] == NULL) ? 0 : 1;
	$pb_beted = ($Beted[PeBanker] == NULL) ? 0 : 1;
	//ベッドキャンセル時の判定
	$player_beted = ($Beted[Player] == 0) ? 0 : 1;
	$banker_beted = ($Beted[Banker] == 0) ? 0 : 1;
	$tie_beted = ($Beted[Tie] == 0) ? 0 : 1;
	$pp_beted = ($Beted[PePlayer] == 0) ? 0 : 1;
	$pb_beted = ($Beted[PeBanker] == 0) ? 0 : 1;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Content-Style-Type" content="text/css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
         width:100%;
         height:200px;
         background-color:#cc6600;
        }
#logo
        {
         width:100%;
         height:50px;
         background-color:#cc6600;
         text-align: center;
         font-size: 100%;
        }
#player_card_logo
        {
         width:50%;
         height:80px;
         float:left;
         background-color:#ff9933;
         text-align: center;
         font-size: 100%;
         position: relative;
        }
#player_card
        {
         width:50%;
         height:180px;
         float:left;
         background-color:#ff9933;
         font-size: 100%;
         position: relative;
        }
#banker_card_logo
        {
         width:50%;
         height:80px;
         float:left;
         background-color:#ff9933;
         text-align: center;
         font-size: 100%;
        }
#banker_card
        {
         width:50%;
         height:180px;
         float:left;
         background-color:#ff9933;
         font-size: 100%;
         position: relative;
        }
#pcard1 {
	float:left;
    position: absolute;
    width:100px;
	height:150px;
    left: 200px;
	margin-left: 40px;
    display:none;
}
#bcard1 {
	float:left;
    position: absolute;
    width:100px;
	height:150px;
    left: 200px;
	margin-left: 40px;
    display:none;
}
#pcard2 {
	float:left;
    position: absolute;
    width:100px;
	height:150px;
    left: 200px;
    margin-left: 150px;
    display:none;
}
#bcard2 {
	float:left;
    position: absolute;
    width:100px;
	height:150px;
    left: 200px;
    margin-left: 150px;
    display:none;
}
#pcard3 {
	float:left;
    position: absolute;
    width:100px;
	height:150px;
    left: 200px;
    margin-left: 260px;
    display:none;
}
#bcard3 {
	float:left;
    position: absolute;
    width:100px;
	height:150px;
    left: 100px;
    margin-left: 260px;
    display:none;
}
#card1_ura{
	position:absolute;
	width:100px;
	height:150px;
	float:left;
	background-image: url("card_pic/ura.gif");
	margin-left: 50px;
	}
#card2_ura{
	position:absolute;
	width:100px;
	height:150px;
	float:left;
	background-image: url("card_pic/ura.gif");
	margin-left: 50px;
	}
#card3_ura{
	position:absolute;
	width:100px;
	height:150px;
	float:left;
	background-image: url("card_pic/ura.gif");
	margin-left: 160px;
	}
#card4_ura{
	position:absolute;
	width:100px;
	height:150px;
	float:left;
	background-image: url("card_pic/ura.gif");
	margin-left: 160px;
	}
#card5_ura{
	position:absolute;
	width:100px;
	height:150px;
	float:left;
	background-image: url("card_pic/ura.gif");
	margin-left: 270px;
	}
#card6_ura{
	position:absolute;
	width:100px;
	height:150px;
	float:left;
	background-image: url("card_pic/ura.gif");
	margin-left: 270px;
	}
#card1
		{
	    position:absolute;
	    width:100px;
		height:150px;
	    float:left;
  		}
#card2
		{
	    position:absolute;
	    width:100px;
		height:150px;
	    float:left;
  		}
#card3
		{
	    position:absolute;
	    width:100px;
		height:150px;
	    float:left;
	    margin-left: 160px;
  		}
#card4
		{
	    position:absolute;
	    width:100px;
		height:150px;
	    float:left;
	    margin-left: 160px;
  		}
#card5
		{
	    position:absolute;
	    width:100px;
		height:150px;
	    float:left;
	    margin-left: 270px;
  		}
#card6
		{
	    position:absolute;
	    width:100px;
		height:150px;
	    float:left;
	    margin-left: 270px;
  		}
#bet_player
        {
         width:40%;
         height:140px;
         float:left;
         background-color:#009933;
         text-align: center;
         font-size: 100%;
         cursor: pointer;
        }
#bet_tie
        {
         width:20%;
         height:140px;
         float:left;
         background-color:#009933;
         text-align: center;
         font-size: 100%;
         border-top-style: solid;
         border-right-style: solid;
         border-left-style: solid;
         cursor: pointer;
        }
#bet_banker
        {
         width:40%;
         height:140px;
         float:left;
         background-color:#009933;
         text-align: center;
         font-size: 100%;
         cursor: pointer;
        }
#pear_player
        {
         width:10%;
         height:140px;
         float:left;
         background-color:#009933;
         text-align: center;
         font-size: 100%;
         border-top-style: solid;
         border-right-style: solid;
         border-left-style: solid;
         cursor: pointer;
        }
#pear_banker
        {
         width:10%;
         height:140px;
         float:left;
         background-color:#009933;
         text-align: center;
         font-size: 100%;
         border-top-style: solid;
         border-right-style: solid;
         border-left-style: solid;
         cursor: pointer;
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
	width: 20px;
	height: 15px;
	font-size: 50%;
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
.container {
  width: 960px;
  margin: 0 auto;
  background-color:#ff9933;
  text-align: center;
}
#coin10{cursor: pointer;}
#coin50{cursor: pointer;}
#coin100{cursor: pointer;}
#coin500{cursor: pointer;}
#coin1000{cursor: pointer;}
#coin5000{cursor: pointer;}
#pcoin{display:none;}
#bcoin{display:none;}
#tcoin{display:none;}
#pptip{display:none;}
#bptip{display:none;}
#bet_cancel{cursor: pointer;}
#table_list{cursor: pointer;}
#plabel{font-size: 100%;}
#blabel{font-size: 100%;}
#tlabel{font-size: 100%;}
#ppear{font-size: 100%;}
#bpear{font-size: 100%;}
#player_money{font-size: 100%;}
 -->
</style>
<title>Baccarat</title>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script type="text/javascript">
$(function(){

   //変数の設定-----------------------------------

	var setSecond = <?php echo $sec ?>; //タイマーの秒数
	$("#ptotal").hide();
	$("#btotal").hide();
	document.getElementById("card1_ura").style.display="none";
	document.getElementById("card2_ura").style.display="none";
	document.getElementById("card3_ura").style.display="none";
	document.getElementById("card4_ura").style.display="none";
	document.getElementById("card5_ura").style.display="none";
	document.getElementById("card6_ura").style.display="none";
	//カード間隔設定
	var margin1 = 50;
	var margin2 = 160;
	var margin3 = 270;
	var width = 100;
	var height = 150;
	//初期（裏面に隠す）
	$("#card1").stop().css({width:'0px'});
	$("#card2").stop().css({width:'0px'});
	$("#card3").stop().css({width:'0px'});
	$("#card4").stop().css({width:'0px'});
	$("#card5").stop().css({width:'0px'});
	$("#card6").stop().css({width:'0px'});
	//ベット金額
	var betprice = 0;
	var coinprice =0;
	var tbetprice = 0;
	var ppearttl =0;
	var bpearttl =0;
	var bet_flg =0;
	var balance =<?php echo $UserBl['Balance'] ?>;
	
	//ベッドしたチップ表示の判定
	if(<?php echo $player_beted ?> == 1){
		$('#pcoin').show();
		$('#plabel').text(<?php echo $Beted['Player'] ?>);
	}
	if(<?php echo $banker_beted ?> == 1){
		$('#bcoin').show();
		$('#blabel').text(<?php echo $Beted['Banker'] ?>);
	}
	if(<?php echo $tie_beted ?> == 1){
		$('#tcoin').show();
		$('#tlabel').text(<?php echo $Beted['Tie'] ?>);
	}
	if(<?php echo $pp_beted ?> == 1){
		$('#pptip').show();
		$('#ppear').text(<?php echo $Beted['PePlayer'] ?>);
	}
	if(<?php echo $pb_beted ?> == 1){
		$('#bptip').show();
		$('#bpear').text(<?php echo $Beted['PeBanker'] ?>);
	}
	$('#player_money').text(balance);
	  //テーブル一覧へ
	  $('#table_list').hover(function() {
	  	$(this).css('background', '#c00');
	    }, function() {
	    $(this).css('background', '');
	  });
	  $('#table_list').click(function(){
		   window.location.href = "/table_list.php";
	  });
	  
	  $('#coin100').attr("src","card_pic/scoin100.gif");
	  coinprice = 100;
	  //コインクリック
	  $('#coin10').click(function(){
		 coinprice = 10;
	     $(this).attr("src","card_pic/scoin10.gif");
	     $('#coin50').attr("src","card_pic/coin50.gif");
	     $('#coin100').attr("src","card_pic/coin100.gif");
	     $('#coin500').attr("src","card_pic/coin500.gif");
	     $('#coin1000').attr("src","card_pic/coin1000.gif");
	     $('#coin5000').attr("src","card_pic/coin5000.gif");
	  });
	   $('#coin50').click(function(){
	     coinprice = 50;
	     $('#coin10').attr("src","card_pic/coin10.gif");
	     $(this).attr("src","card_pic/scoin50.gif");
	     $('#coin100').attr("src","card_pic/coin100.gif");
	     $('#coin500').attr("src","card_pic/coin500.gif");
	     $('#coin1000').attr("src","card_pic/coin1000.gif");
	     $('#coin5000').attr("src","card_pic/coin5000.gif");
	  });
	  $('#coin100').click(function(){
	  	 coinprice = 100;
	     $('#coin10').attr("src","card_pic/coin10.gif");
	     $('#coin50').attr("src","card_pic/coin50.gif");
	     $(this).attr("src","card_pic/scoin100.gif");
	     $('#coin500').attr("src","card_pic/coin500.gif");
	     $('#coin1000').attr("src","card_pic/coin1000.gif");
	     $('#coin5000').attr("src","card_pic/coin5000.gif");
	  });
	  $('#coin500').click(function(){
	     coinprice = 500;
	     $('#coin10').attr("src","card_pic/coin10.gif");
	     $('#coin50').attr("src","card_pic/coin50.gif");
	     $('#coin100').attr("src","card_pic/coin100.gif");
	     $(this).attr("src","card_pic/scoin500.gif");
	     $('#coin1000').attr("src","card_pic/coin1000.gif");
	     $('#coin5000').attr("src","card_pic/coin5000.gif");
	  });
	  $('#coin1000').click(function(){
	     coinprice = 1000;
	     $('#coin10').attr("src","card_pic/coin10.gif");
	     $('#coin50').attr("src","card_pic/coin50.gif");
	     $('#coin100').attr("src","card_pic/coin100.gif");
	     $('#coin500').attr("src","card_pic/coin500.gif");
	     $(this).attr("src","card_pic/scoin1000.gif");
	     $('#coin5000').attr("src","card_pic/coin5000.gif");
	  });
	    $('#coin5000').click(function(){
	     coinprice = 5000;
	     $('#coin10').attr("src","card_pic/coin10.gif");
	     $('#coin50').attr("src","card_pic/coin50.gif");
	     $('#coin100').attr("src","card_pic/coin100.gif");
	     $('#coin500').attr("src","card_pic/coin500.gif");
	     $('#coin1000').attr("src","card_pic/coin1000.gif");
	     $(this).attr("src","card_pic/scoin5000.gif");
	  });

 	(function($) {
		$.fn.timer = function(totalTime) {
		    // reset timer
		    clearTimeout(this.data('id_of_settimeout'));
		    this.empty();

		    // initialize elements
		    this.append('<h4>Betting Time <span></span> seconds.</h4>');
		    this.append('<div class="progress"></div>');
		    this.children('.progress').append('<div class="progress-bar progress-bar-info"></div>');
		    this.find('.progress-bar').css({
		        cssText: '-webkit-transition: none !important; transition: none !important;',
		        width: '100%'
    	});

	    var countdown = (function(timeLeft) {
      	var $progressBar = this.find('div.progress-bar');
      	var $header = this.children('h4');

      	if (timeLeft <= 0) {
	        $header.empty().text('Betting time is over!').addClass('text-danger');
	        window.location.href = "/trump.php?no=" + <?php echo $no ?>;
	        // return;
      	}

	    $header.children('span').text(timeLeft);

	    var width = (timeLeft - 1) * (100/totalTime); // unit in '%'
	    if (width < 20) { // less than 20 %
		    $progressBar.removeClass();
		    $progressBar.addClass('progress-bar progress-bar-danger');
	    } else if (width < 50) { // less than 50 % (and more than 20 %)
	        $progressBar.removeClass();
	        $progressBar.addClass('progress-bar progress-bar-warning');
	    }

	    $progressBar.animate({
	        width:  width + '%'
	    }, 1000, 'linear');

	    var id = setTimeout((function() {
	    	countdown(timeLeft - 1);
	    }), 1000);
	    	this.data("id_of_settimeout", id);
	    }).bind(this);

	    countdown(totalTime);
		};
	})(jQuery);

	if(setSecond < 45){
	
	  //カウントダウン実行
		$('#timer').timer(setSecond);

  		//ベット
		$('#bet_player').click(function(){
	  		if(bet_flg != 2){
		  		if(balance >= coinprice){
					balance = balance - coinprice;
					betprice = betprice + coinprice;

					bet_flg = 1;

					$.ajax({
				     	type: 'POST',
				     	dataType: 'json',
					    url: '/bet.php',
					    data: {
					    	bet:'player',
					    	amounts:coinprice,
					    	tblno:<?php echo $no ?>
					    	},
						    success: function(data) {
						    	$('#player_money').text(data);
								$('#pcoin').show();
								$('#plabel').text(betprice);
						    },
						    error:function(XMLHttpRequest, textStatus, errorThrown) {
						    }
				    });
		    	}else{
		    		alert("you are short of money");
				}
	  		}
  		});
		$('#bet_banker').click(function(){
			if(bet_flg != 1){
				if(balance >= coinprice){
					balance = balance - coinprice;
					betprice = betprice + coinprice;

					bet_flg = 2;
					$.ajax({
				     	type: 'POST',
				     	dataType: 'json',
					    url: '/bet.php',
					    data: {
					    	bet:'banker',
					    	amounts:coinprice,
					    	tblno:<?php echo $no ?>
					    	},
						    success: function(data) {
						    	$('#player_money').text(data);
								$('#bcoin').show();
								$('#blabel').text(betprice);
						    },
						    error:function(XMLHttpRequest, textStatus, errorThrown) {
						    }
			    	});
			    }else{
			    	alert("you are short of money");
			    }
			}
		});
		$('#bet_tie').click(function(){
		  		if(balance >= coinprice){
			  		balance = balance - coinprice;
					tbetprice = tbetprice + coinprice;

					$.ajax({
			     		type: 'POST',
				     	dataType: 'json',
					    url: '/bet.php',
					    data: {
					    	bet:'tie',
					    	amounts:coinprice,
					    	tblno:<?php echo $no ?>
				    	},
						    success: function(data) {
						    	$('#player_money').text(data);
								$('#tcoin').show();
								$('#tlabel').text(tbetprice);
					    },
					    	error:function(XMLHttpRequest, textStatus, errorThrown) {
					    }
			    	});
		    	}else{
		    		alert("you are short of money");
		    	}
		});
		$('#pear_player').click(function(){
		  		if(balance >= coinprice){
			  		balance = balance - coinprice;
					ppearttl = ppearttl + coinprice;

					$.ajax({
						type: 'POST',
						dataType: 'json',
						url: '/bet.php',
						data: {
							bet:'peplayer',
							amounts:coinprice,
							tblno:<?php echo $no ?>
						},
							success: function(data) {
								$('#player_money').text(data);
								$('#pptip').show();
								$('#ppear').text(ppearttl);
						},
							error:function(XMLHttpRequest, textStatus, errorThrown) {
						}
					});
				}
		});
		$('#pear_banker').click(function(){
		  		if(balance >= coinprice){
			  		balance = balance - coinprice;
					bpearttl = bpearttl + coinprice;

					$.ajax({
						type: 'POST',
						dataType: 'json',
						url: '/bet.php',
						data: {
							bet:'pebanker',
							amounts:coinprice,
							tblno:<?php echo $no ?>
						},
							success: function(data) {
								$('#player_money').text(data);
								$('#bptip').show();
								$('#bpear').text(bpearttl);
						},
							error:function(XMLHttpRequest, textStatus, errorThrown) {
						}
					});
				}
		});
		$('#bet_cancel').hover(function() {
		  	$(this).css('background', '#c00');
		    }, function() {
		    $(this).css('background', '');
		});
		$('#bet_cancel').click(function(){
			betprice = 0;
			tbetprice = 0;
			ppearttl =0;
			bpearttl =0;
			$('#plabel').text("");
			$('#blabel').text("");
			$('#tlabel').text("");
			$('#ppear').text("");
			$('#bpear').text("");
			$('#pcoin').hide();
			$('#bcoin').hide();
			$('#tcoin').hide();
			$('#pptip').hide();
			$('#bptip').hide();
			bet_flg = 0;
			$.ajax({
		 		type: 'POST',
		     	dataType: 'json',
			    url: '/bet.php',
			    data: {
			    	bet:'cancel',
			    	tblno:<?php echo $no ?>
		    	},
				    success: function(data) {
				    	$('#player_money').text(data);
			    },
			    	error:function(XMLHttpRequest, textStatus, errorThrown) {
			    }
			});
		});

	}else{

	    // プログレスバーの表示
	    $('#timer').append('<h4>Betting Time <span></span> seconds.</h4>');
	    $('#timer').append('<div class="progress"></div>');
	    $('#timer').children('.progress').append('<div class="progress-bar progress-bar-info"></div>');
	    $('#timer').find('.progress-bar').css({
	        cssText: '-webkit-transition: none !important; transition: none !important;',
	        width: '0%'
	    });
	    var $progressBar = $('#timer').find('div.progress-bar');
	    var $header = $('#timer').children('h4');
	    $header.empty().text('Betting time is over!').addClass('text-danger');

		// カードの表示
		$("#ptotal").show();
		$("#btotal").show();
		// カード配る
		setTimeout(function(){
			$('#pcard1').show();
			$('#pcard1').animate({'left': '10px'});

		},1000);
		setTimeout(function(){
			$('#bcard1').show();
			$('#bcard1').animate({'left': '10px'});

		},2000);
		setTimeout(function(){
			$('#pcard2').show();
			$('#pcard2').animate({'left': '10px'});

		},3000);
		setTimeout(function(){
			$('#bcard2').show();
			$('#bcard2').animate({'left': '10px'});

		},4000);
		setTimeout(function(){
		// カードめくる
			$('#pcard1').hide();
			$("#card1_ura").show();
			$("#card1_ura").stop().animate({width:'0px',height:''+height+'px',marginLeft:''+margin1+'px',opacity:'0.5'},{duration:200});
			window.setTimeout(function() {
				$("#card1").stop().animate({width:''+width+'px',height:''+height+'px',marginLeft:'50px',opacity:'1'},{duration:200});
			},200);
			document.getElementById('ptotal').innerHTML = "<?php echo "Total:".$pcard_num[0] ?>";
		}, 5000);
		setTimeout(function(){
			$('#bcard1').hide();
			$("#card2_ura").show();
			$("#card2_ura").stop().animate({width:'0px',height:''+height+'px',marginLeft:''+margin1+'px',opacity:'0.5'},{duration:200});
			window.setTimeout(function() {
				$("#card2").stop().animate({width:''+width+'px',height:''+height+'px',marginLeft:'50px',opacity:'1'},{duration:200});
			},200);
			document.getElementById('btotal').innerHTML = "<?php echo "Total:".$bcard_num[0] ?>";
		}, 6000);
		setTimeout(function(){
			$('#pcard2').hide();
			$("#card3_ura").show();
			$("#card3_ura").stop().animate({width:'0px',height:''+height+'px',marginLeft:''+margin2+'px',opacity:'0.5'},{duration:200});
			window.setTimeout(function() {
				$("#card3").stop().animate({width:''+width+'px',height:''+height+'px',marginLeft:'160px',opacity:'1'},{duration:200});
			},200);
			document.getElementById('ptotal').innerHTML = "<?php echo "Total:".$pcard_num[1] ?>";
		}, 7000);
		setTimeout(function(){
			$('#bcard2').hide();
			$("#card4_ura").show();
			$("#card4_ura").stop().animate({width:'0px',height:''+height+'px',marginLeft:''+margin2+'px',opacity:'0.5'},{duration:200});
			window.setTimeout(function() {
				$("#card4").stop().animate({width:''+width+'px',height:''+height+'px',marginLeft:'160px',opacity:'1'},{duration:200});
			},200);
			document.getElementById('btotal').innerHTML = "<?php echo "Total:".$bcard_num[1] ?>";
		}, 8000);
		//3枚目の処理
		if(<?php echo $pcard3_flg ?> == 1){
			setTimeout(function(){
				$('#pcard3').show();
				$('#pcard3').animate({'left': '10px'});
			},9000);
			setTimeout(function(){
				$('#pcard3').hide();
				$("#card5_ura").show();
				$("#card5_ura").stop().animate({width:'0px',height:''+height+'px',marginLeft:''+margin3+'px',opacity:'0.5'},{duration:200});
				window.setTimeout(function() {
					$("#card5").stop().animate({width:''+width+'px',height:''+height+'px',marginLeft:'270px',opacity:'1'},{duration:200});
				},200);
				document.getElementById('ptotal').innerHTML = "<?php echo "Total:".$pcard_num[2] ?>";
			  }, 10000);
		}
		if(<?php echo $bcard3_flg ?> == 1){
			setTimeout(function(){
				$('#bcard3').show();
				$('#bcard3').animate({'left': '10px'});
			},11000);
			setTimeout(function(){
				$('#bcard3').hide();
				$("#card6_ura").show();
				$("#card6_ura").stop().animate({width:'0px',height:''+height+'px',marginLeft:''+margin3+'px',opacity:'0.5'},{duration:200});
				window.setTimeout(function() {
					$("#card6").stop().animate({width:''+width+'px',height:''+height+'px',marginLeft:'270px',opacity:'1'},{duration:200});
				},200);
				document.getElementById('btotal').innerHTML = "<?php echo "Total:".$bcard_num[2] ?>";
			  }, 12000);
		}
		setTimeout(function(){
			var res_message = 
			"<?php 
			if($TBL_match[Result] == "P"){
				echo "Player Win  Your balance ";
			}else{
				if($TBL_match[Result] == "B"){
					echo "Banker Win  Your balance ";
				}
				if($TBL_match[Result] == "T"){
					echo "Banker Win  Your balance ";
				}
			}
			 ?>";
			// ダイアログを表示
			showDialog("Result", res_message);
		}, 13000);
		function showDialog(title, message) 
		{
			var html_dialog = '<div>' + message + '</div>';
			$(html_dialog).dialog({
				autoOpen: true,  // 自動でオープンしない
		        modal: true,      // モーダル表示する
		        resizable: false, // リサイズしない
		        draggable: false, // ドラッグしない
		        width: 800,
		        height: 600,
		        open:function(event, ui){ $(".ui-dialog-titlebar-close").hide();}
			});
		}
		setTimeout(function(){
			$(html_dialog).dialog( 'close' );
		}, 16000);
		setTimeout(function(){
			//チップ表示初期化
			$('#plabel').text("");
			$('#blabel').text("");
			$('#tlabel').text("");
			$('#ppear').text("");
			$('#bpear').text("");
			$('#pcoin').hide();
			$('#bcoin').hide();
			$('#tcoin').hide();
			$('#pptip').hide();
			$('#bptip').hide();
		}, 16000);
		setTimeout(function(){
			window.location.href = "/trump.php?no=" + <?php echo $no ?>;
		}, 17000);
		
	}
});

</script>

</head>

<div id="wrapper">
	<div id="log_space">
	<br>
		<table class="inner">
			<tbody>
				<?php
				for($i=0;$i<6;$i++){
					echo "<tr>";


						for($ck_count=0;$ck_count<35;$ck_count++){
							$pic = $edit_rst[$ck_count][$i];
							echo "<td><img src= 'card_pic/$pic.gif' ></td>";
							//$test .= mb_substr($TBL_game[GameResult],$hanteimoji,1);
						}

					echo "</tr>";
				}
				?>
			</tbody>
		</table>
	</div>

	<div id="logo">BACCARAT</br></div>
	<div class="container">
	    <div id="timer"></div>
	</div>
	<div id="player_card_logo">PLAYER
		<br />
		<br />
		<div id="ptotal">Total:</div>
		<br />
	</div>
	<div id="banker_card_logo">BANKER
		<br />
		<br />
		<div id="btotal">Total:</div>
	<br />
	</div>
	<div id="player_card">
			<div id="pcard1"><img src="card_pic/ura.gif"></div>
			<div id="pcard2"><img src="card_pic/ura.gif"></div>
			<div id="pcard3"><img src="card_pic/ura.gif"></div>

		    <img id="card1_ura" width="100" src="card_pic/ura.gif" />
		    <img id="card1" width="100" src="<?php echo $pcard_img[0]; ?>" />
		    <img id="card3_ura" width="100" src="card_pic/ura.gif" />
		    <img id="card3" width="100" src="<?php echo $pcard_img[1]; ?>" />
   		    <img id="card5_ura" width="100" src="card_pic/ura.gif" />
		    <img id="card5" width="100" src="<?php echo $pcard_img[2]; ?>" />
		<br>
	</div>
	<div id="banker_card">
			<div id="bcard1"><img src="card_pic/ura.gif"></div>
			<div id="bcard2"><img src="card_pic/ura.gif"></div>
			<div id="bcard3"><img src="card_pic/ura.gif"></div>
		    <img id="card2_ura" width="100" src="card_pic/ura.gif" />
		    <img id="card2" width="100" src="<?php echo $bcard_img[0]; ?>" />
		    <img id="card4_ura" width="100" src="card_pic/ura.gif" />
		    <img id="card4" width="100" src="<?php echo $bcard_img[1]; ?>" />
		    <img id="card6_ura" width="100" src="card_pic/ura.gif" />
		    <img id="card6" width="100" src="<?php echo $bcard_img[2]; ?>" />
		<br>
	</div>
	<div id="bet_player">PLAYER<br><br><br>
		<img id="pcoin" src= 'card_pic/coin.gif' >
	</div>
	<div id="bet_tie">TIE<br>
		<img id="tcoin" src= 'card_pic/coin.gif' ><br><br>
		<label id="tlabel"></label>
	</div>
	<div id="bet_banker">BANKER<br><br><br>
		<img id="bcoin" src= 'card_pic/coin.gif' >
	</div>
	<div id="bet_player">
		<label id="plabel"></label>
	</div>
	<div id="pear_player">PAIR</br>PLAYER</br>
		<img id="pptip" src= 'card_pic/pearcoin.gif' ></br>
		<label id="ppear"></label>
	</div>
	<div id="pear_banker">PAIR</br>BANKER</br>
		<img id="bptip" src= 'card_pic/pearcoin.gif' ></br>
		<label id="bpear"></label>
	</div>
	<div id="bet_banker">
		<label id="blabel"></label>
	</div>
	<td><img id="coin10" src= 'card_pic/coin10.gif' ></td>
	<td><img id="coin50" src= 'card_pic/coin50.gif' ></td>
	<td><img id="coin100" src= 'card_pic/coin100.gif' ></td>
	<td><img id="coin500" src= 'card_pic/coin500.gif' ></td>
	<td><img id="coin1000" src= 'card_pic/coin1000.gif' ></td>
	<td><img id="coin5000" src= 'card_pic/coin5000.gif' ></td>
	<td><img id= "bet_cancel" src= 'card_pic/cancel_bt.gif' ></td>
	<td><label id= "player_money"></label></td>
	<td><img id= "table_list" src= 'card_pic/tlist_bt.gif' ></td>
</div>
</div>
</body>
</html>