<?php
session_start();

require_once 'baccrat_common/mysql.php';
require_once 'baccrat_common/const.php';


$pcard = array();     //プレイヤーの手札
$bcard = array();     //バンカーの手札

$date    = date("Y-m-d H:i:s");
$sec = date("s");
$sec = 62 - intval($sec);
$last_result = "";
	$edit_rst = array();
for($rp = 1; $rp < 5; $rp++) {
	for($i = 0; $i < 70; $i++) {
		for($ii = 0; $ii < 6; $ii++) {
			$edit_rst[$rp][$i][$ii] = "K";
		}
	}
}

$mysql = new MySQL_cls();
for($rp = 1; $rp < 5; $rp++) {
	$mysql->MySQL();
	$mysql->actQuery("SELECT * FROM  MATCH_RESULT_TBL".strval($rp)." ORDER BY TStamp DESC LIMIT 1");
	$TBL_match = $mysql->getResult();

	$pcard= explode("/",$TBL_match[Pcard]);
	$bcard= explode("/",$TBL_match[Bcard]);

	$mysql->actQuery("SELECT * FROM  GAME_RESULT_TBL".strval($rp)." WHERE GameNo = '$TBL_match[GameNo]'");
	$TBL_game = $mysql->getResult();
	//echo $TBL_game[GameResult];

	//ゲーム結果をhtmlテーブル表用に文字列編集
	$gyo = 0;
	$retu = 0;
	$ren_flg = false;
	$sp_gyo = 0;
	for($i = 0; $i < strlen($TBL_game[GameResult]); $i++) {

	  if($i == 0){
	  	$edit_rst[$rp][0][0] = mb_substr($TBL_game[GameResult],$i,1);
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
	  			if ($edit_rst[$rp][$retu + ($gyo -5)][5] == "K") {
	  				if($sp_gyo == 0){
	  					$edit_rst[$rp][$retu + ($gyo -5)][5]=$last_rst;
	  				}else{
	  					$edit_rst[$rp][$retu + ($gyo -5)][5 - $sp_gyo]=$last_rst;
	  				}
	  			}else{
	  				$sp_gyo = $sp_gyo + 1;
	  				$edit_rst[$rp][$retu + ($gyo -5)][5 - $sp_gyo]=$last_rst;
	  			}
	  		}else{
	  			if($tie_flg){
	  				$gyo = $gyo -1;
	  				$edit_rst[$rp][$retu][$gyo]=$last_rst;
	  			}else{
					if ($edit_rst[$rp][$retu][$gyo] == "K") {
						if (!$ren_flg) {
							$edit_rst[$rp][$retu][$gyo]=$last_rst;
						}else{
							$edit_rst[$rp][$retu + 1][$gyo -1]=$last_rst;
						}

					}else{
						$edit_rst[$rp][$retu + 1][$gyo -1]=$last_rst;
						$ren_flg = true;
					}
	  			}

	  		}
	  	}else{
			$gyo = 0;
			$sp_gyo = 0;
			$ren_flg = false;
	  		$retu = $retu + 1;
	  		$edit_rst[$rp][$retu][0]=$last_rst;

	  	}
	  }

	}
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
#logo
        {
         width:100%;
         height:50px;
         background-color:#cc6600;
         text-align: center;
         font-size: 100%;
        }
#tbl_space
        {
         width:100%;
         height:200px;
         background-color:#cc6600;
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


 -->
</style>
<title>Baccarat</title>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript">
 //変数の設定-----------------------------------

   var setSecond = <?php echo $sec ?>; //タイマーの秒数
   var setPause = setSecond; //ストップ時の秒数を保存する変数　初期値はsetSecondと同じ数値
   var time = setSecond;   //残り秒数を保存する変数　初期値はsetSecondと同じ数値
   var timerID;    //setInterval用の変数


   //関数の設定-----------------------------------


   //カウントを1減らす関数（setIntervalで毎秒実行される関数）
	function countDown(){
      time--;  //残り秒数を1減らす
      setPause = time;  //setPauseに残り秒数を代入（ストップ時に使用するため）
	}

   //タイマー（setInterval）の停止用関数
	function countStop(){
      clearInterval(timerID); //（setInterval）をクリアー
	}

   //タイマースタートの関数
	function timerStart(){
      countStop();   //カウントダウンの重複を防ぐために今動いているタイマーをクリアーする ※1
		timerID = setInterval(function(){
         if(time <= 0) {
            //残り秒数が0以下になったらタイマー（setInterval）をクリアー
            clearInterval(timerID);
            window.location.href = "/table_list.php";
         } else {
            //残り秒数が1以上あれば1減らす
			   countDown();
         }

		}, 1000);   //1000ミリ秒（1秒）毎にsetInterval内の処理を繰り返す
	};

	 //実行処理-----------------------------------
   timerStart();
</script>

</head>
<body>
<form action="<?php echo $_SERVER["SCRIPT_NAME"]; ?>" method="post">
<div id="wrapper">
<div id="logo">Table list</div></br>
	<div id="tbl_space">Table NO.1
		<a href="trump.php?no=1">
		<table>
			<tbody>
				<?php
				for($i=0;$i<6;$i++){
					echo "<tr>";


						for($ck_count=0;$ck_count<35;$ck_count++){
							$pic = $edit_rst[1][$ck_count][$i];
							echo "<td><img src= 'card_pic/$pic.gif' ></td>";
						}

					echo "</tr>";
				}
				?>
			</tbody>
		</table>
		</a>
	</div>
	</br></br>
	<div id="tbl_space">Table NO.2
	<a href="trump.php?no=2">
	<table>
		<tbody>
			<?php
			for($i=0;$i<6;$i++){
				echo "<tr>";


					for($ck_count=0;$ck_count<35;$ck_count++){
						$pic = $edit_rst[2][$ck_count][$i];
						echo "<td><img src= 'card_pic/$pic.gif' ></td>";
					}

				echo "</tr>";
			}
			?>
		</tbody>
	</table>
	</a>
	</div>
	</br></br>
	<div id="tbl_space">Table NO.3
	<a href="trump.php?no=3">
	<table>
		<tbody>
			<?php
			for($i=0;$i<6;$i++){
				echo "<tr>";
					for($ck_count=0;$ck_count<35;$ck_count++){
						$pic = $edit_rst[3][$ck_count][$i];
						echo "<td><img src= 'card_pic/$pic.gif' ></td>";
					}

				echo "</tr>";
			}
			?>
		</tbody>
	</table>
	</a>
	</div>
	</br></br>
	<div id="tbl_space">Table NO.4
	<a href="trump.php?no=4">
	<table>
		<tbody>
			<?php
			for($i=0;$i<6;$i++){
				echo "<tr>";
					for($ck_count=0;$ck_count<35;$ck_count++){
						$pic = $edit_rst[4][$ck_count][$i];
						echo "<td><img src= 'card_pic/$pic.gif' ></td>";
					}

				echo "</tr>";
			}
			?>
		</tbody>
	</table>
	</a>
	</br></br>
	</div>
</div>

</form>
</body>
</html>