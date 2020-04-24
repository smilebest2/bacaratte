<?php
session_start();

require_once 'baccrat_common/mysql.php';

require_once 'baccrat_common/const.php';

$userid =1;

$mysql = new MySQL_cls();
$mysql->MySQL();
$mysql->actQuery("SELECT * FROM  User_Balance WHERE UserId = ".$userid);
$UserBl = $mysql->getResult();

if(isset($_POST['tblno']) && $_POST['bet'] != 'cancel'){
	//ベット金額が残高超えていないか
	if(intval($UserBl['Balance']) >= intval($_POST['amounts'])){
		//ベット処理
		$date   = date("Y-m-d H:i:s");

		$sql = "SELECT * FROM TBL_STATUS_TBL" . $_POST['tblno'];
		$mysql->actQuery($sql);
		$TBL_status=$mysql->getResult();

		if($TBL_status[Status] == "end"){
			$gameno = $TBL_status[GameNo] + 1;
		}else{
			$gameno = $TBL_status[GameNo];
		}

		$mysql->actQuery("SELECT * FROM  MATCH_RESULT_TBL".$_POST['tblno']." ORDER BY TStamp DESC LIMIT 1");
		$TBL_match = $mysql->getResult();
		$no = $TBL_match[NO] + 1;

		switch($_POST['bet']){
			case 'player':
				$pl = $_POST['amounts'];
				break;
			case 'banker':
				$ba = $_POST['amounts'];
				break;
			case 'tie':
				$ti = $_POST['amounts'];
				break;
			case 'peplayer':
				$pp = $_POST['amounts'];
				break;
			case 'pebanker':
				$pb = $_POST['amounts'];
				break;
		}
		$mysql->TrsBegin();
		$balance = $UserBl['Balance'] - intval($_POST['amounts']);
		$sql = "INSERT INTO Betting_TBL".$_POST['tblno']." VALUES('','$gameno', '$no','$userid','$pl','$ba','$ti','$pp','$pb','$date',NULL,$balance)";
		$result = $mysql->actQuery($sql);
		if($result){
			
			$sql = "UPDATE User_Balance SET Balance = '$balance', TStamp = '$date' WHERE UserId = '$userid'";
			$rtn = $mysql->actQuery($sql);
			if($rtn){
				$mysql->TrsCmt();
				$html = $balance;
			}else{
				$mysql->TrsRbk();
				$html = "Transmission error";
			}
		}else{
			$mysql->TrsRbk();
			$html = "Transmission error";
		}
	}else{
		$html = "you are short of money";
	}
}else{
	//キャンセル処理
	$sql = "SELECT * FROM TBL_STATUS_TBL" . $_POST['tblno'];
	$mysql->actQuery($sql);
	$TBL_status=$mysql->getResult();

	if($TBL_status[Status] == "end"){
		$gameno = $TBL_status[GameNo] + 1;
	}else{
		$gameno = $TBL_status[GameNo];
	}

	$mysql->actQuery("SELECT * FROM  MATCH_RESULT_TBL".$_POST['tblno']." ORDER BY TStamp DESC LIMIT 1");
	$TBL_match = $mysql->getResult();
	$no = $TBL_match[NO] + 1;


	$sql = "SELECT SUM(Player + Banker + Tie + PePlayer + PeBanker) AS GOUKEI FROM Betting_TBL".$_POST['tblno']." WHERE GameNo = '$gameno' AND NO = '$no' AND UserId = '$userid' AND BetResult IS NULL";

	$rtn = $mysql->actQuery($sql);
	if($rtn){
		$Beted=$mysql->getResult();
		$mysql->TrsBegin();
		$sql = "UPDATE Betting_TBL".$_POST['tblno']." SET BetResult = 'cancel' WHERE  GameNo = '$gameno' AND NO = '$no' AND UserId = '$userid' AND BetResult IS NULL";

		$result = $mysql->actQuery($sql);
		if($result){
			$balance = $UserBl['Balance'] + $Beted[GOUKEI];
			$sql = "UPDATE User_Balance SET Balance = '$balance', TStamp = '$date' WHERE UserId = '$userid'";
			$html =$Beted;
			$res = $mysql->actQuery($sql);
			if($res){
				$mysql->TrsCmt();
				$html = $balance;
			}else{
			  	$mysql->TrsRbk();
				$html = "Transmission error";
			}
	  	}else{
		  	$mysql->TrsRbk();
			$html = "Transmission error";
	  	}

	}else{
		$html = $UserBl['Balance'];

	}
}

header('Content-type: application/json');//指定されたデータタイプに応じたヘッダーを出力する
echo json_encode( $html );

?>