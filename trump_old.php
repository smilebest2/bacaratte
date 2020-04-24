<?php
session_start();

require_once 'baccrat_common/mysql.php';

require_once 'baccrat_common/const.php';

if(isset($_GET["no"]))
{
	$no = $_GET["no"];
}

$pcard = array();     //プレイヤーの手札
$bcard = array();     //バンカーの手札

$date = date("Y-m-d H:i:s");

$mysql = new MySQL_cls();
$mysql->MySQL();
$mysql->actQuery("SELECT * FROM  MATCH_RESULT_TBL".$no." ORDER BY TStamp DESC LIMIT 1");
$TBL_match = $mysql->getResult();

$second = date("s", strtotime($TBL_match[TStamp]));

$pcard= explode("/",$TBL_match[Pcard]);
$bcard= explode("/",$TBL_match[Bcard]);

$mysql->actQuery("SELECT * FROM  GAME_RESULT_TBL".$no." WHERE GameNo = '$TBL_match[GameNo]'");
$TBL_game = $mysql->getResult();


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
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Content-Style-Type" content="text/css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
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
         height:220px;
         float:left;
         background-color:#ff9933;
         font-size: 100%;
         position: relative;
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
	margin-left: 140px;
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
         height:220px;
         float:left;
         background-color:#ff9933;
         font-size: 100%;
        }
#bet_player
        {
         width:40%;
         height:150px;
         float:left;
         background-color:#009933;
         text-align: center;
         font-size: 100%;
        }
#bet_tie
        {
         width:20%;
         height:150px;
         float:left;
         background-color:#009933;
         text-align: center;
         font-size: 100%;
        }
#bet_banker
        {
         width:40%;
         height:150px;
         float:left;
         background-color:#009933;
         text-align: center;
         font-size: 100%;
        }
#pear_player
        {
         width:10%;
         height:150px;
         float:left;
         background-color:#009933;
         text-align: center;
         font-size: 100%;
        }
#pear_banker
        {
         width:10%;
         height:150px;
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

 -->
</style>
<title>Baccarat</title>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script type="text/javascript">
$(function(){

   //変数の設定-----------------------------------
//画像データ取得
var margin1 = 50;
var margin2 = 160;
var margin3 = 270;
var width = 100;
var height = 150;

   var setSecond = 30; //タイマーの秒数
document.getElementById("card5_ura").style.display="none";
document.getElementById("card6_ura").style.display="none";
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
	        $header.empty().text('Over the time limit!').addClass('text-danger');
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

  //カウントダウン実行
  //$('#timer').timer(setSecond);
  
 
  //初期（裏面に隠す）
$("#card1").stop().css({width:'0px'});
$("#card2").stop().css({width:'0px'});
$("#card3").stop().css({width:'0px'});
$("#card4").stop().css({width:'0px'});
$("#card5").stop().css({width:'0px'});
$("#card6").stop().css({width:'0px'});
setTimeout(function(){
	$("#card1_ura").stop().animate({width:'0px',height:''+height+'px',marginLeft:''+margin1+'px',opacity:'0.5'},{duration:200});
	window.setTimeout(function() {
		$("#card1").stop().animate({width:''+width+'px',height:''+height+'px',marginLeft:'50px',opacity:'1'},{duration:200});
	},200);
	document.getElementById('ptotal').innerHTML = "<?php echo "Total:".$pcard_num[0] ?>";
  }, 2000);
setTimeout(function(){
	$("#card2_ura").stop().animate({width:'0px',height:''+height+'px',marginLeft:''+margin1+'px',opacity:'0.5'},{duration:200});
	window.setTimeout(function() {
		$("#card2").stop().animate({width:''+width+'px',height:''+height+'px',marginLeft:'50px',opacity:'1'},{duration:200});
	},200);
	document.getElementById('btotal').innerHTML = "<?php echo "Total:".$bcard_num[0] ?>";
  }, 3000);
setTimeout(function(){
	$("#card3_ura").stop().animate({width:'0px',height:''+height+'px',marginLeft:''+margin2+'px',opacity:'0.5'},{duration:200});
	window.setTimeout(function() {
		$("#card3").stop().animate({width:''+width+'px',height:''+height+'px',marginLeft:'160px',opacity:'1'},{duration:200});
	},200);
	document.getElementById('ptotal').innerHTML = "<?php echo "Total:".$pcard_num[1] ?>";
  }, 4000);
setTimeout(function(){
	$("#card4_ura").stop().animate({width:'0px',height:''+height+'px',marginLeft:''+margin2+'px',opacity:'0.5'},{duration:200});
	window.setTimeout(function() {
		$("#card4").stop().animate({width:''+width+'px',height:''+height+'px',marginLeft:'160px',opacity:'1'},{duration:200});
	},200);
	document.getElementById('btotal').innerHTML = "<?php echo "Total:".$bcard_num[1] ?>";
  }, 5000);
if(<?php echo $pcard3_flg ?> == 1){
	setTimeout(function(){
		$("#card5_ura").stop().animate({width:'0px',height:''+height+'px',marginLeft:''+margin3+'px',opacity:'0.5'},{duration:200});
		window.setTimeout(function() {
			$("#card5").stop().animate({width:''+width+'px',height:''+height+'px',marginLeft:'270px',opacity:'1'},{duration:200});
		},200);
		document.getElementById('ptotal').innerHTML = "<?php echo "Total:".$pcard_num[2] ?>";
	  }, 6000);
}
if(<?php echo $bcard3_flg ?> == 1){
	setTimeout(function(){
		$("#card6_ura").stop().animate({width:'0px',height:''+height+'px',marginLeft:''+margin3+'px',opacity:'0.5'},{duration:200});
		window.setTimeout(function() {
			$("#card6").stop().animate({width:''+width+'px',height:''+height+'px',marginLeft:'270px',opacity:'1'},{duration:200});
		},200);
		document.getElementById('btotal').innerHTML = "<?php echo "Total:".$bcard_num[2] ?>";
	  }, 7000);
}

});

</script>

</head>

<div id="wrapper">
	<div id="log_space">
	<br>
		<table>
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
		<div id="slide">
		    <img id="card1_ura" width="100" src="card_pic/ura.gif" />
		    <img id="card1" width="100" src="<?php echo $pcard_img[0]; ?>" />
		    <img id="card3_ura" width="100" src="card_pic/ura.gif" />
		    <img id="card3" width="100" src="<?php echo $pcard_img[1]; ?>" />
   		    <img id="card5_ura" width="100" src="card_pic/ura.gif" />
		    <img id="card5" width="100" src="<?php echo $pcard_img[2]; ?>" />
		</div>
		<br>
	</div>
	<div id="banker_card">
		<div id="slide">
		    <img id="card2_ura" width="100" src="card_pic/ura.gif" />
		    <img id="card2" width="100" src="<?php echo $bcard_img[0]; ?>" />
		    <img id="card4_ura" width="100" src="card_pic/ura.gif" />
		    <img id="card4" width="100" src="<?php echo $bcard_img[1]; ?>" />
		    <img id="card6_ura" width="100" src="card_pic/ura.gif" />
		    <img id="card7" width="100" src="<?php echo $bcard_img[2]; ?>" />
		</div>
		<br>
	</div>

	<div id="bet_player">PLAYER</div>
	<div id="bet_tie">TIE</div>
	<div id="bet_banker">BANKER</div>
	<div id="bet_player"></div>
	<div id="pear_player">PAIR</br>PLAYER</div>
	<div id="pear_banker">PAIR</br>BANKER</div>
	<div id="bet_banker"></div>
	<td><img src= 'card_pic/coin10.gif' ></td>
	<td><img src= 'card_pic/coin50.gif' ></td>
	<td><img src= 'card_pic/coin100.gif' ></td>
	<td><img src= 'card_pic/coin500.gif' ></td>
	<td><img src= 'card_pic/coin1000.gif' ></td>
	<td><img src= 'card_pic/coin5000.gif' ></td>
	<div id= "bet_cancel"></div>
	<div id= "player_money">\</div>
<ul>
  <li><?php echo "<a href='?no=$no'>Next</a>"; ?></li><br>
  <li><?php echo "<a href='table_list.php'>Table List</a>"; ?></li>
</ul>
</div>
</div>
</body>
</html>