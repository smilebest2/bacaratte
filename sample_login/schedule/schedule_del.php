<?php
session_start();

require_once '../common/mysql.php';

require_once '../common/const.php';

require_once '../common/function.php';


/**

 * 削除

 */

if ($_POST['delete_ck']) {

$new_start= htmlspecialchars($_POST["starttime"], ENT_QUOTES);

	$mysql = new MySQL_cls();
	$mysql->MySQL();
	//削除対象レコード存在チェック
	$sql = "SELECT ";
	$sql .= "RACE_DATA1.d".$_POST["sejyutu_day"]." as day, ";
	$sql .= "RACE_DATA1.kanjya_no, ";
	$sql .= "RACE_DATA1.k".$_POST["sejyutu_day"]." as syoken,";
	$sql .= "RACE_DATA1.z".$_POST["sejyutu_day"]." as zenkanka,";
	$sql .= "evenement.sejyutu_no,";
	$sql .= "evenement.from_chiryoin,";
	$sql .= "RIYOUSHA.kanjya_jyusyo, ";
	$sql .= "RIYOUSHA.kanjya_ido, ";
	$sql .= "RIYOUSHA.kanjya_keido, ";
	$sql .= "RIYOUSHA.from_chiryoin_kyori ";
	$sql .= "FROM RACE_DATA1 ";
	$sql .= "LEFT JOIN RIYOUSHA ON RACE_DATA1.kanjya_no = RIYOUSHA.NO ";
	$sql .= "LEFT JOIN evenement ON RACE_DATA1.d".$_POST["sejyutu_day"]." = evenement.start ";
	$sql .= "WHERE ";
	$sql .= "RACE_DATA1.member_id = ".$_POST["mId"];
	$sql .= " AND RACE_DATA1.sejyutu_month= '".$_POST["sejyutu_month"]."'";
	$sql .= " AND RACE_DATA1.zj".$_POST["sejyutu_day"]." IS NOT NULL";
	$rtn = $mysql->actQuery_result($sql);
	$row_cnt = $rtn->num_rows;

	if($row_cnt !=0){
		$data_riyosya_ck = "data";	//実績あり
		$from_riyosya_time = $_POST["starttime"];
		$after_riyosya_time = $_POST["starttime"];
		$first="";
		$after=array();
		$count=0;
		while($jisseki= mysqli_fetch_array($rtn, MYSQLI_ASSOC)){			//結果を配列で取得

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
			$after["sejyutu_no"][$count] = $jisseki["sejyutu_no"];
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
	}

		//後患家
		if($after["from_chiryoin"][$after_target_no] == 0){
			$sql = "SELECT NO,kanjya_jyusyo, kanjya_ido, kanjya_keido FROM RIYOUSHA WHERE NO = '".$_POST["riyousya_no"]."'";
			$mysql->actQuery($sql);
			while (($row_riyo = $mysql->getResult())){
				$riyo_ido= $row_riyo["kanjya_ido"];		//登録患者の緯度
				$riyo_keido= $row_riyo["kanjya_keido"];	//登録患者の経度
				$riyo_no= $row_riyo["NO"];//登録患者の住所
				$riyo_jyusyo= $row_riyo["kanjya_jyusyo"];	//登録患者の住所
			}

			//後患家の距離
			$after_kyori = 0;
			$after_kyori_rtn = location_distance($from["kanjya_ido"][$target_no], $from["kanjya_keido"][$target_no], $after["kanjya_ido"][$after_target_no], $after["kanjya_keido"][$after_target_no]);
			$after_kyori = $after_kyori_rtn["distance_unit"];

			if($after["from_chiryoin_kyori"][$after_target_no] < $after_kyori){
				$after_kyori = $after["from_chiryoin_kyori"][$after_target_no];
				$after_riyosya = "治療院";
				$after_riyosya_add = $after["kanjya_jyusyo"][$after_target_no];
			}else{
				$after_riyosya =$after["kanjya_no"][$after_target_no];
				$after_riyosya_add = $riyo_jyusyo;
			}
//			if($from_riyosya==$after["kanjya_no"][$after_target_no]){
//				$after_kyori=$new_from_chiryoin_kyori;
//			}
		}

	$mysql->TrsBegin();
	$result=$mysql->actQuery("DELETE FROM evenement WHERE id = '" . $_POST["id"] . "'");
	if($result){
		//対象レコードを削除
		$sql ="UPDATE RACE_DATA1 SET k";
		$sql .= $_POST["sejyutu_day"]." =NULL, z";
		$sql .= $_POST["sejyutu_day"]." =NULL, zk";
		$sql .= $_POST["sejyutu_day"]." =NULL, d";
		$sql .= $_POST["sejyutu_day"]."=NULL, zj";
		$sql .= $_POST["sejyutu_day"]."=NULL ";
		$sql .= "WHERE ";
		$sql .= "member_id = '".$_POST["mId"];
		$sql .= "' and kanjya_no = '".$_POST["riyousya_no"];
		$sql .= "' and sejyutu_month = '".$_POST["sejyutu_month"]."'";
		$rtn=$mysql->actQuery($sql);

		if($rtn){
			//後患家
			$syoken=$after["syoken"][$after_target_no];
			if($after["from_chiryoin"][$after_target_no] == 0){
				$sql = "UPDATE RACE_DATA1 SET ";
				$sql .= "k".$_POST["sejyutu_day"]."='$syoken',";
				$sql .= "z".$_POST["sejyutu_day"]."='$after_riyosya',";
				$sql .= "zk".$_POST["sejyutu_day"]."='$after_kyori',";
	//			$sql .= "d".$_POST["sejyutu_day"]."='$new_start_race',";
				$sql .= "zj".$_POST["sejyutu_day"]."='$after_riyosya_add' ";
				$sql .= "WHERE ";
				$sql .= "member_id = ".$_POST["mId"];
				$sql .= " AND sejyutu_no = ".$after["sejyutu_no"][$after_target_no];
				$sql .= " AND kanjya_no = ".$after["kanjya_no"][$after_target_no];
				$sql .= " AND sejyutu_month= '".$_POST["sejyutu_month"]."'";
$_SESSION["sejyutu_month"]=$sql;
				$rtn_ck=$mysql->actQuery($sql);
				if(!$rtn_ck){
					$mysql->TrsRbk();
				}else{
					$mysql->TrsCmt();
				}
			}else{
				$mysql->TrsCmt();
			}
		}else{
			$mysql->TrsRbk();
		}
	}else{
		$mysql->TrsRbk();
	}
	header('Content-Type: application/json; charset=utf-8');

	$_POST['delete_ck']=false;
	$data="OK";

	echo json_encode($data);

}
