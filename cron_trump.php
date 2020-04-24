<?php
session_start();

require_once 'baccrat_common/mysql.php';

require_once 'baccrat_common/const.php';

$date    = date("Y-m-d H:i:s");
$mysql = new MySQL_cls();
$cards_rem_mark = "";
$cards_rem_num = "";
$mysql->MySQL();
for($rp = 1; $rp < 5; $rp++){
	$end_game = false;		//終了フラグ
	$cards   = array();     //山札
	$player  = array();     //プレイヤーの手札
	$opp     = array();     //対戦相手の手札

	$sql = "SELECT * FROM TBL_STATUS_TBL" . strval($rp);

	$mysql->actQuery($sql);
	$TBL_status=$mysql->getResult();

	//newゲームかの判定
	if($TBL_status[Status] == "end"){

		$cards = init_cards();
		$cards_ini = NULL;
		foreach($cards as $key => $val){
			$cards_ini .= $val[mark] . $val[num];
		}
		foreach($cards as $key => $val){
			$cards_rem_mark .= $val[mark] . "/";
			$cards_rem_num .= $val[num] . "/";
		}
		$cards_rem_mark = mb_substr($cards_rem_mark,0,-1);
		$cards_rem_num = mb_substr($cards_rem_num,0,-1);
		$sta_word = "continue";
		$sql = "UPDATE TBL_STATUS_TBL".strval($rp)." SET Status = '$sta_word', TStamp = '$date', RemainingCardMark = '$cards_rem_mark', RemaningCardNum = '$cards_rem_num'";

		$mysql->actQuery($sql);

		$sql = "INSERT INTO GAME_RESULT_TBL".strval($rp)."(GameNo,ShuffleResult,GameResult,TStamp) values('$TBL_status[GameNo]', '$cards_ini','','$date')";
		$mysql->actQuery($sql);

	}else{

		$arr_num = array();
		$cards = array();
		$arr_num= explode("/",$TBL_status[RemaningCardNum]);
		$arr_mark= explode("/",$TBL_status[RemainingCardMark]);
		//残りカードを配列化
		for($i = 0; $i< count($arr_num); $i++){
			$cards[] = array(
		        'num' => $arr_num[$i],
		        'mark' => $arr_mark[$i]
		    );
		}
	}

	$cardsd = count($cards);

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
	$cards_rem_mark = "";
	$cards_rem_num = "";
	foreach($cards as $key => $val){
			$cards_rem_mark .= $val[mark] . "/";
			$cards_rem_num .= $val[num] . "/";
	}
	$cards_rem_mark = mb_substr($cards_rem_mark,0,-1);
	$cards_rem_num = mb_substr($cards_rem_num,0,-1);


	if(!isset($cards[6])){
		$newGameNo = $TBL_status[GameNo] + 1;
		$sta_word="end";
		$sql = "UPDATE TBL_STATUS_TBL".strval($rp)." SET GameNo = '$newGameNo', Status = '$sta_word' , TStamp = '$date',RemainingCardMark = '', RemaningCardNum = ''";
		$mysql->actQuery($sql);

	}else{
		//残りカードをDB格納
		$sql = "UPDATE TBL_STATUS_TBL".strval($rp)." SET TStamp = '$date',RemainingCardMark = '$cards_rem_mark', RemaningCardNum = '$cards_rem_num'";
		$mysql->actQuery($sql);
	}

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

	//勝敗履歴用
	$mysql->actQuery("SELECT * FROM GAME_RESULT_TBL".strval($rp)." WHERE GameNo = '$TBL_status[GameNo]'");
	$GAME_result=$mysql->getResult();
	//newゲームかの判定
	if($GAME_result == NULL){
		$rst = NULL;
	}else{
		$rst = $GAME_result[GameResult];
	}

	//勝敗結果

	echo $rst ."</br>";
	if($player_total == $opp_total){
		if(mb_substr($GAME_result[GameResult],-1) == "P"){$rst .= "Q";}
		if(mb_substr($GAME_result[GameResult],-1) == "Q"){$rst .= "R";}
		if(mb_substr($GAME_result[GameResult],-1) == "R"){$rst .= "S";}
		if(mb_substr($GAME_result[GameResult],-1) == "S"){$rst .= "T";}
		if(mb_substr($GAME_result[GameResult],-1) == "T"){$rst .= "U";}
		if(mb_substr($GAME_result[GameResult],-1) == "B"){$rst .= "C";}
		if(mb_substr($GAME_result[GameResult],-1) == "C"){$rst .= "D";}
		if(mb_substr($GAME_result[GameResult],-1) == "D"){$rst .= "E";}
		if(mb_substr($GAME_result[GameResult],-1) == "E"){$rst .= "F";}
		if(mb_substr($GAME_result[GameResult],-1) == "F"){$rst .= "G";}
	}
	if($player_total > $opp_total){
		$rst .= "P";
	}
	if($player_total < $opp_total){
		$rst .= "B";
	}

	$sql = "UPDATE GAME_RESULT_TBL".strval($rp)." SET GameResult = '$rst', TStamp = '$date' WHERE GameNo = '$TBL_status[GameNo]'";
	$mysql->actQuery($sql);

$pcard_result = "";
$bcard_result = "";
	foreach($player as $card){

	  if(intval($card['num']) < 10){
	  	$number = '0' . strval($card['num']);
	  }else{
	  	$number = strval($card['num']);
	  }
	  $pcard_result .= $card['mark'] . $number . "/";
	}
	$pcard_result = mb_substr($pcard_result,0,-1);

	$game_result = "T";
	if($player_total > $opp_total){
		$game_result = "P";
	}

	$card_result = "BANKER";

	foreach($opp as $card){

	  if(intval($card['num']) < 10){
	  	$number = '0' . strval($card['num']);
	  }else{
	  	$number = strval($card['num']);
	  }
	  $bcard_result .= $card['mark'] . $number . "/";;
	}
	$bcard_result = mb_substr($bcard_result,0,-1);

	if($player_total < $opp_total){

		$game_result = "B";
	}

	$sql = "INSERT INTO MATCH_RESULT_TBL".strval($rp)."(GameNO,Result,Pcard,Bcard,TStamp) values($TBL_status[GameNo], '$game_result','$pcard_result','$bcard_result','$date')";
	$mysql->actQuery($sql);
	//ベッド判定処理
	$sql = "SELECT * FROM MATCH_RESULT_TBL".strval($rp)." ORDER BY NO DESC LIMIT 1";
	
	$mysql->actQuery($sql);
	$Match_TBL = $mysql->getResult();
	
	$sql = "SELECT 
				SUM(Player) AS Player,
				SUM(Banker) AS Banker,
				SUM(Tie) AS Tie,
				SUM(PePlayer) AS PePlayer,
				SUM(PeBanker) AS PeBanker 
				FROM Betting_TBL".strval($rp).
				" WHERE 
				GameNo = '$TBL_status[GameNo]' 
				AND NO = '$Match_TBL[NO]' 
				AND BetResult IS NULL";
	$mysql->actQuery($sql);
	$Beted=$mysql->getResult();
	if(substr($rst,-1) == "P"){
		$sql = "UPDATE 
				  Betting_TBL".strval($rp)." a " 
				."LEFT JOIN User_Balance b "
				."ON a.UserId = b.UserId "
				."SET 
				  a.BetResult = a.Player * 2, 
				  a.TStamp = '$date',
				  b.Balance = b.Balance + $Beted[Player] * 2
				WHERE 
				  a.GameNo = '$TBL_status[GameNo]'
				  AND a.NO = '$Match_TBL[NO]'
				  AND a.Player != 0 
				  AND a.BetResult IS NULL ";
		$mysql->actQuery($sql);
		$sql = "UPDATE 
				  Betting_TBL".strval($rp)
				." SET 
				  BetResult = 0
				WHERE 
				  GameNo = '$TBL_status[GameNo]'
				  AND NO = '$Match_TBL[NO]'
				  AND Player != 0 
				  AND BetResult IS NULL ";
		$mysql->actQuery($sql);
		$sql = "UPDATE 
				  Betting_TBL".strval($rp)
				." SET 
				  BetResult = 0
				WHERE 
				  GameNo = '$TBL_status[GameNo]'
				  AND NO = '$Match_TBL[NO]'
				  AND Tie != 0 
				  AND BetResult IS NULL ";
		$mysql->actQuery($sql);
	}else if(substr($rst,-1) == "B"){
		$sql = "UPDATE 
				  Betting_TBL".strval($rp)." a " 
				."LEFT JOIN User_Balance b "
				."ON a.UserId = b.UserId "
				."SET 
				  a.BetResult = a.Banker * 1.95, 
				  a.TStamp = '$date',
				  b.Balance = b.Balance + $Beted[Banker] * 1.95
				WHERE 
				  a.GameNo = '$TBL_status[GameNo]'
				  AND a.NO = '$Match_TBL[NO]'
				  AND a.Banker != 0 
				  AND a.BetResult IS NULL ";
		$mysql->actQuery($sql);
		$sql = "UPDATE 
				  Betting_TBL".strval($rp)
				." SET 
				  BetResult = 0
				WHERE 
				  GameNo = '$TBL_status[GameNo]'
				  AND NO = '$Match_TBL[NO]'
				  AND Player != 0 
				  AND BetResult IS NULL ";
		$mysql->actQuery($sql);
		$sql = "UPDATE 
				  Betting_TBL".strval($rp)
				." SET 
				  BetResult = 0
				WHERE 
				  GameNo = '$TBL_status[GameNo]'
				  AND NO = '$Match_TBL[NO]'
				  AND Tie != 0 
				  AND BetResult IS NULL ";
		$mysql->actQuery($sql);
	}else{
		$sql = "UPDATE 
				  Betting_TBL".strval($rp)." a " 
				."LEFT JOIN User_Balance b "
				."ON a.UserId = b.UserId "
				."SET 
				  a.BetResult = a.Tie * 8, 
				  a.TStamp = '$date',
				  b.Balance = b.Balance + $Beted[Tie] * 8 + $Beted[Player] + $Beted[Banker]
				WHERE 
				  a.GameNo = '$TBL_status[GameNo]'
				  AND a.NO = '$Match_TBL[NO]'
				  AND a.Tie != 0 
				  AND a.BetResult IS NULL ";
		$mysql->actQuery($sql);
		$sql = "UPDATE 
				  Betting_TBL".strval($rp)." a " 
				."LEFT JOIN User_Balance b "
				."ON a.UserId = b.UserId "
				."SET 
				  a.BetResult = a.Player, 
				  a.TStamp = '$date',
				  b.Balance = b.Balance + $Beted[Player]
				WHERE 
				  a.GameNo = '$TBL_status[GameNo]'
				  AND a.NO = '$Match_TBL[NO]'
				  AND a.Player != 0 
				  AND a.BetResult IS NULL ";
		$mysql->actQuery($sql);
		$sql = "UPDATE 
				  Betting_TBL".strval($rp)." a " 
				."LEFT JOIN User_Balance b "
				."ON a.UserId = b.UserId "
				."SET 
				  a.BetResult = a.Banker, 
				  a.TStamp = '$date',
				  b.Balance = b.Balance + $Beted[Banker]
				WHERE 
				  a.GameNo = '$TBL_status[GameNo]'
				  AND a.NO = '$Match_TBL[NO]'
				  AND a.Banker != 0 
				  AND a.BetResult IS NULL ";
		$mysql->actQuery($sql);
	}
	
	//error_log($sql,"3","log/debug.log");
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
function init_cards(){
    //山札を用意する
    $cards = array();
    $marks = array('s', 'h', 'd', 'c');
	 for($cnt=1;$cnt<=8;$cnt++){
	    foreach($marks as $mark){
	        for($i=1;$i<=13;$i++){
	            $cards[] = array(
	                'num' => $i,
	                'mark' => $mark
	            );
	        }
	    }
	 }
    shuffle($cards);
    return $cards;
}