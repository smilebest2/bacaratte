<?php
session_start();

require_once '../common/mysql.php';

require_once '../common/const.php';

require_once '../common/function.php';

/**

 * キャンセル

 */

	if (isset($_POST['cancel'])) {
	$sid=$_POST["required_sejyutu_no"];
	header("Location:".url_schedule_no.$sid);

	exit();

	}

//登録
if (isset($_POST['entry'])) {

//前患者家の距離計算


$new_member_id= "";
$new_sejyutu_no= "";
$new_riyo_no= "";
$new_id= "";
$new_ka_nick_name= "";
$new_start= "";
$new_end= "";
$new_from_chiryoin= "";
$new_syoken= "";

$time=date('c',strtotime($_POST["required_start"]));
$new_sejyutu_month= date('Y-m',strtotime($time));
$new_sejyutu_day= date('j',strtotime($time));

$new_start= htmlspecialchars($_POST["required_start"], ENT_QUOTES);
$new_start_race= date('Y-m-d H:i:s',strtotime($time));	//RACE1用

$new_member_id= htmlspecialchars($_POST["required_member_no"], ENT_QUOTES);
$new_sejyutu_no= htmlspecialchars($_POST["required_sejyutu_no"], ENT_QUOTES);
$new_riyo_no= htmlspecialchars($_POST["required_riyo_no"], ENT_QUOTES);
$new_ka_nick_name= htmlspecialchars($_POST["required_ka_nick_name"], ENT_QUOTES);

$new_end= htmlspecialchars($_POST["required_end"], ENT_QUOTES);
$new_from_chiryoin= htmlspecialchars($_POST["required_from_chiryoin"], ENT_QUOTES);
$new_syoken= htmlspecialchars($_POST["required_syoken"], ENT_QUOTES);
$new_from_chiryoin_kyori= $_POST["required_from_chiryoin_kyori"];
$new_kanjya_ido= $_POST["required_kanjya_ido"];
$new_kanjya_keido= $_POST["required_kanjya_keido"];
$new_sejyutusya_add= htmlspecialchars($_POST["required_sejyutusya_add"], ENT_QUOTES);

$after_riyosya = "";
$sid=$_POST["required_sejyutu_no"];

	$mysql = new MySQL_cls();
	$mysql->MySQL();
	//対象月に会員、施術者、患者が同じのデータがあるのか
	$mysql->actQuery("SELECT * from RACE_DATA1 WHERE member_id = '$new_member_id' AND sejyutu_no = '$new_sejyutu_no' AND kanjya_no = '$new_riyo_no' AND sejyutu_month='$new_sejyutu_month'");
	$row = $mysql->getResult();


	$data_ck="not_data";	//対象利用者が対象月の施術初めての場合
	$data_riyosya_ck="not_data";
	if($row){
		$data_ck="data";	//有る場合
	}

	$from_riyosya_time = $new_start;							//利用者の時間を格納
	$from_riyosya ="治療院";									//前患家を格納
	$from_riyosya_add =$new_sejyutusya_add;						//前患の住所を格納
	$kyori=$new_from_chiryoin_kyori;							//全患家からの距離
	$jisseki=array();

	//対象施術日の施術実績があるか選択患者も含む
	$sql = "SELECT ";
	$sql .= "RACE_DATA1.d$new_sejyutu_day as day, ";
	$sql .= "RACE_DATA1.kanjya_no, ";
	$sql .= "RACE_DATA1.k$new_sejyutu_day as syoken,";
	$sql .= "RACE_DATA1.z$new_sejyutu_day as zenkanka,";
	$sql .= "evenement.from_chiryoin,";
	$sql .= "RIYOUSHA.kanjya_jyusyo, ";
	$sql .= "RIYOUSHA.kanjya_ido, ";
	$sql .= "RIYOUSHA.kanjya_keido, ";
	$sql .= "RIYOUSHA.from_chiryoin_kyori ";
	$sql .= "FROM RACE_DATA1 ";
	$sql .= "LEFT JOIN RIYOUSHA ON RACE_DATA1.kanjya_no = RIYOUSHA.NO ";
	$sql .= "LEFT JOIN evenement ON RACE_DATA1.d$new_sejyutu_day = evenement.start ";
	$sql .= "WHERE ";
	$sql .= "RACE_DATA1.member_id = '$new_member_id' ";
	$sql .= "AND RACE_DATA1.sejyutu_no = '$new_sejyutu_no' ";
	$sql .= "AND RACE_DATA1.sejyutu_month='$new_sejyutu_month' ";
	$sql .= "AND RACE_DATA1.k$new_sejyutu_day IS NOT NULL";
	$rtn = $mysql->actQuery_result($sql);
	$row_cnt = $rtn->num_rows;

	//前患家
	if($row_cnt !=0){
		$data_riyosya_ck="data";	//実績あり
		$from_riyosya_time=$new_start;
		$after_riyosya_time=$new_start;
		$first="";
		$after=array();
		$count=0;
		while($jisseki= mysqli_fetch_array($rtn, MYSQLI_ASSOC)){			//結果を配列で取得
var_dump($jisseki);
			$from["kanjya_no"][$count] = $jisseki["kanjya_no"];
			$from["kanjya_jyusyo"][$count] = $jisseki["kanjya_jyusyo"];
			$from["kanjya_ido"][$count] = $jisseki["kanjya_ido"];
			$from["kanjya_keido"][$count] = $jisseki["kanjya_keido"];

			$after["kanjya_no"][$count] = $jisseki["kanjya_no"];
			$after["kanjya_jyusyo"][$count] = $jisseki["kanjya_jyusyo"];
			$after["kanjya_ido"][$count] = $jisseki["kanjya_ido"];
			$after["kanjya_keido"][$count] = $jisseki["kanjya_keido"];
			$after["zenkanka"][$count] = $jisseki["zenkanka"];
			$after["from_chiryoin_kyori"][$count] = $jisseki["from_chiryoin_kyori"];
			$after["syoken"][$count] = $jisseki["syoken"];
			$after["from_chiryoin"][$count] = $jisseki["from_chiryoin"];

			//前患家チェック
			if(strtotime($new_start) > strtotime($jisseki["day"])){

				$from_riyosya_time_ck = $jisseki["day"];

				if(strtotime($from_riyosya_time) < strtotime($from_riyosya_time_ck)){
					$from_riyosya_time = $from_riyosya_time_ck;
					$target_no = $count;
				}
				if($first==""){
					$from_riyosya_time = $jisseki["day"];
					$target_no = $count;
					$first="first";
				}
			}

			//後患家チェック
			if(strtotime($new_start) < strtotime($jisseki["day"])){

				$after_riyosya_time_ck = $jisseki["day"];

				if(strtotime($after_riyosya_time) < strtotime($after_riyosya_time_ck)){
					$after_riyosya_time = $after_riyosya_time_ck;
					$after_target_no = $count;
				}
				if($after==""){
					$after_riyosya_time = $jisseki["day"];
					$after_target_no = $count;
					$after="after";
				}
			}
			$count++;
		}
		$from_riyosya =$from["kanjya_no"][$target_no];
		$from_riyosya_add =$from["kanjya_jyusyo"][$target_no];
		$from_riyosya_ido =$from["kanjya_ido"][$target_no];
		$from_riyosya_keido =$from["kanjya_keido"][$target_no];

		$after_riyosya =$after["kanjya_no"][$after_target_no];
		$after_riyosya_add =$after["kanjya_jyusyo"][$after_target_no];
		$after_riyosya_ido =$after["kanjya_ido"][$after_target_no];
		$after_riyosya_keido =$after["kanjya_keido"][$after_target_no];
		$after_riyosya_from =$after["zenkanka"][$after_target_no];
		$after_from_chiryoin_kyori =$after["from_chiryoin_kyori"][$after_target_no];
		$after_riyosya_syoken = $after["syoken"][$after_target_no];
		$after_from_chiryoin =$after["from_chiryoin"][$after_target_no];//後患家が治療院からの設定ONかの判定
	}
$_SESSION[sejyutu_month]=$after_riyosya;
	//前患家の距離
	if($new_from_chiryoin!=1 && $row_cnt !=0){
		//距離計算
		$mysql = new MySQL_cls();
		$mysql->MySQL();
		$sql = "select NO,kanjya_jyusyo, kanjya_ido, kanjya_keido from RIYOUSHA where NO = '$new_riyo_no'";
		$mysql->actQuery($sql);
		while (($row_riyo = $mysql->getResult())){
			$riyo_ido= $row_riyo["kanjya_ido"];		//登録患者の緯度
			$riyo_keido= $row_riyo["kanjya_keido"];	//登録患者の経度
			$riyo_no= $row_riyo["NO"];	//登録患者の住所
			$riyo_jyusyo= $row_riyo["kanjya_jyusyo"];	//登録患者の住所
		}
		$ka_ido=htmlspecialchars($_POST["required_kanjya_ido"], ENT_QUOTES);
		$ka_keido=htmlspecialchars($_POST["required_kanjya_keido"], ENT_QUOTES);

	//前患家の距離
		$kyori=0;
		$kyori_rtn=location_distance($riyo_ido, $riyo_keido, $from_riyosya_ido, $from_riyosya_keido);
		$kyori=$kyori_rtn["distance_unit"];
//$_SESSION[sejyutu_month]="riyo".$riyo_ido."riyo".$riyo_keido."riyo".$from_riyosya_ido."riyo".$from_riyosya_keido;
		if($new_from_chiryoin_kyori < $kyori){
			$kyori=$new_from_chiryoin_kyori;
			$from_riyosya="治療院";
			$from_riyosya_add=$new_sejyutusya_add;
		}
		if($from_riyosya==$new_riyo_no){
			$kyori=$new_from_chiryoin;
		}

		//後患家
		if($after_from_chiryoin == 0){
$_SESSION[sejyutu_month]="riyo".$riyo_ido."riyo".$riyo_keido."riyo".$after_riyosya_ido."riyo".$after_riyosya_keido;

		//後患家の距離
			$after_kyori = 0;
			$after_kyori_rtn = location_distance($from_riyosya_ido, $from_riyosya_keido, $after_riyosya_ido, $after_riyosya_keido);
			$after_kyori = $after_kyori_rtn["distance_unit"];

			if($after_from_chiryoin_kyori < $after_kyori){
//$_SESSION[sejyutu_month]="aaa";
				$after_kyori = $after_from_chiryoin_kyori;
				$after_riyosya = "治療院";
				$after_riyosya_add = $new_sejyutusya_add;
			}else{
//$_SESSION[sejyutu_month]="bbb";
//				$after_kyori = $after_kyori;
//				$after_riyosya = $riyo_no;
				$after_riyosya_add = $riyo_jyusyo;
			}
//			if($from_riyosya==$after_riyosya){
//				$after_kyori=$new_from_chiryoin_kyori;
//			}
		}
	}
	if($new_from_chiryoin==1){
		$from_riyosya="治療院";
		$from_riyosya_add=$new_sejyutusya_add;
	}


	//対象施術日の施術実績があるか選択患者も含む
	$sql = "SELECT ";
	$sql .= "RACE_DATA1.d$new_sejyutu_day as day, ";
	$sql .= "RACE_DATA1.kanjya_no, ";
	$sql .= "RIYOUSHA.kanjya_jyusyo, ";
	$sql .= "RIYOUSHA.kanjya_ido, ";
	$sql .= "RIYOUSHA.kanjya_keido ";
	$sql .= "FROM RACE_DATA1 ";
	$sql .= "LEFT JOIN RIYOUSHA ON RACE_DATA1.kanjya_no = RIYOUSHA.NO ";
	$sql .= "WHERE RACE_DATA1.member_id = '$new_member_id' ";
	$sql .= "AND RACE_DATA1.sejyutu_no = '$new_sejyutu_no' ";
	$sql .= "AND RACE_DATA1.sejyutu_month='$new_sejyutu_month' ";
//	$sql .= "AND RACE_DATA1.k$new_sejyutu_day "=;
	$sql .= "AND RACE_DATA1.kanjya_no='$new_riyo_no'";
	$rtn = $mysql->actQuery_result($sql);
	$row_cnt = $rtn->num_rows;

	//evenementテーブル更新
    $sql = "INSERT INTO  evenement (member_id,sejyutu_no,kanjya_no,title,start,end,from_chiryoin,syoken)
            values ('$new_member_id','$new_sejyutu_no','$new_riyo_no','$new_ka_nick_name','$new_start','$new_end','$new_from_chiryoin','$new_syoken')";
	$mysql->actQuery($sql);

	if($row_cnt ==0 && $data_ck=="not_data"){
		//RACE1テーブル更新
		$sql = "INSERT INTO  RACE_DATA1 (member_id,kanjya_no,sejyutu_no,sejyutu_month,k$new_sejyutu_day,z$new_sejyutu_day,zk$new_sejyutu_day,d$new_sejyutu_day,zj$new_sejyutu_day)
	            values ('$new_member_id','$new_riyo_no','$new_sejyutu_no','$new_sejyutu_month','$new_syoken','$from_riyosya','$kyori','$new_start_race','$from_riyosya_add')";
		$mysql->actQuery($sql);

		//後患家
		if($after_from_chiryoin == 0){
			$sql = "UPDATE RACE_DATA1 SET ";
			$sql .= "k$new_sejyutu_day='$after_riyosya_syoken',";
			$sql .= "z$new_sejyutu_day='$after_riyosya',";
			$sql .= "zk$new_sejyutu_day='$after_kyori',";
//			$sql .= "d$new_sejyutu_day='$new_start_race',";
			$sql .= "zj$new_sejyutu_day='$after_riyosya_add' ";
			$sql .= "WHERE ";
			$sql .= "member_id = '$new_member_id' ";
			$sql .= "AND sejyutu_no = '$new_sejyutu_no' ";
			$sql .= "AND kanjya_no = '$after_riyosya' ";
			$sql .= "AND sejyutu_month='$new_sejyutu_month'";
			$mysql->actQuery($sql);
		}
	}else{

		//RACE1テーブルアップデート
		$sql = "UPDATE RACE_DATA1 SET ";
		$sql .= "k$new_sejyutu_day='$new_syoken',";
		$sql .= "z$new_sejyutu_day='$from_riyosya',";
		$sql .= "zk$new_sejyutu_day='$kyori',";
		$sql .= "d$new_sejyutu_day='$new_start_race',";
		$sql .= "zj$new_sejyutu_day='$from_riyosya_add' ";
		$sql .= "WHERE ";
		$sql .= "member_id = '$new_member_id' ";
		$sql .= "AND sejyutu_no = '$new_sejyutu_no' ";
		$sql .= "AND kanjya_no = '$new_riyo_no' ";
		$sql .= "AND sejyutu_month='$new_sejyutu_month'";
		$mysql->actQuery($sql);

		//後患家
		if($after_from_chiryoin == 0){
			$sql = "UPDATE RACE_DATA1 SET ";
			$sql .= "k$new_sejyutu_day='$after_riyosya_syoken',";
			$sql .= "z$new_sejyutu_day='$after_riyosya',";
			$sql .= "zk$new_sejyutu_day='$after_kyori',";
//			$sql .= "d$new_sejyutu_day='$new_start_race',";
			$sql .= "zj$new_sejyutu_day='$after_riyosya_add' ";
			$sql .= "WHERE ";
			$sql .= "member_id = '$new_member_id' ";
			$sql .= " AND sejyutu_no = '$new_sejyutu_no' ";
			$sql .= " AND kanjya_no = '$after_riyosya' ";
			$sql .= " AND sejyutu_month='$new_sejyutu_month'";
			$mysql->actQuery($sql);

		}
	}



	header("Location:".url_schedule_no.$sid);

	exit();
}
?>