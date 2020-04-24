<?php
require_once '../common/mysql.php';
require_once '../common/const.php';
require_once '../common/function.php';

$DATABASE_SERVER = 'mysql:host=mysql1308.xserver.jp;dbname=smilebest_3900;charset=utf8';
$DATABASE_USER = 'smilebest_user1';
$DATABASE_PWD = 'Windows1';

/* VALUES */
$id=$_POST['id'];
$title=$_POST['title'];
$start=$_POST['start'];
$end=$_POST['end'];
$riyo=$_POST['riyo'];
// connexion à la base de données
try {
	$bdd = new PDO($DATABASE_SERVER, $DATABASE_USER, $DATABASE_PWD,array(PDO::ATTR_EMULATE_PREPARES => false));
}catch(PDOException $e){
	exit('data NG');
}

//RACE_DATA1のテーブル用のアップデートの前にデリート用に開始時間を取得
$sql = "SELECT start FROM evenement WHERE id= ".$id;
$mysql = new MySQL_cls();
$mysql->MySQL();
$res=$mysql->actQuery($sql);
$row = $mysql->getResult();
$old_start = $row["start"];//RACE_DATA1の削除日付用

$sql = "UPDATE evenement SET title=?, start=?, end=? WHERE id=?";
$q = $bdd->prepare($sql);
$q->execute(array($title,$start,$end,$id));


$old_time=date('c',strtotime($old_start));
$new_old_day= date('j',strtotime($old_time));

$time=date('c',strtotime($_POST["start"]));
$new_sejyutu_month= date('Y-m',strtotime($time));
$new_sejyutu_day= date('j',strtotime($time));


$new_start= htmlspecialchars($_POST["required_start"], ENT_QUOTES);
$new_start_race= date('Y-m-d H:i:s',strtotime($time));	//RACE1用

$sql = "SELECT evenement.member_id, ";
$sql .= "evenement.sejyutu_no, ";
$sql .= "evenement.kanjya_no, ";
$sql .= "evenement.from_chiryoin, ";
$sql .= "evenement.syoken, ";
$sql .= "RIYOUSHA.nick_name, ";
$sql .= "RIYOUSHA.from_chiryoin_kyori, ";
$sql .= "RIYOUSHA.kanjya_ido, ";
$sql .= "RIYOUSHA.kanjya_keido, ";
$sql .= "SEJYUTUSYA.address ";
$sql .= "FROM evenement ";
$sql .= "LEFT JOIN RIYOUSHA ON RIYOUSHA.NO = evenement.kanjya_no ";
$sql .= "LEFT JOIN SEJYUTUSYA ON SEJYUTUSYA.NO = evenement.sejyutu_no ";
$sql .= "WHERE evenement.id= '" . $id ."'";
$mysql = new MySQL_cls();
$mysql->MySQL();
$res=$mysql->actQuery($sql);
$row = $mysql->getResult();
//エラーチェック
if($row){
	$post_data['new_sejyutu_month']= $new_sejyutu_month;
	$post_data['new_sejyutu_day']= $new_sejyutu_day;

	$post_data['new_start']= $new_start;
	$post_data['new_start_race']= $new_start_race;	//RACE1用

	$post_data['new_member_id']= $row["member_id"];
	$post_data['new_sejyutu_no']= $row["sejyutu_no"];
	$post_data['new_riyo_no']= $row["kanjya_no"];
	$post_data['new_ka_nick_name']= $row["nick_name"];

	$post_data['new_end']= $end;
	$post_data['new_from_chiryoin']= $row["from_chiryoin_kyori"];
	$post_data['new_syoken']= $row["syoken"];
	$post_data['new_from_chiryoin_kyori']= $row["from_chiryoin_kyori"];
	$post_data['new_kanjya_ido']= $row["kanjya_ido"];
	$post_data['new_kanjya_keido']= $row["kanjya_keido"];
	$post_data['new_sejyutusya_add']= $row["address"];

	$after_riyosya = "";
	$post_data['sid']=$row["sejyutu_no"];
	$post_data['$old_day']=$old_day;


	//$regist = SchduleDataReg::schdule_data_reg($post_data);
	/*
	 $new_member_id= $row["member_id"];
	$new_sejyutu_no= $row["sejyutu_no"];
	$new_riyo_no= $row["kanjya_no"];
	$new_ka_nick_name= $row["nick_name"];
	$new_end= $end;
	$new_from_chiryoin=$row["from_chiryoin"];
	$new_syoken=$row["syoken"];
	$new_from_chiryoin_kyori= $row["from_chiryoin_kyori"];
	$new_kanjya_ido= $row["kanjya_ido"];
	$new_kanjya_keido= $row["kanjya_keido"];
	$new_sejyutusya_add= $row["address"];
	$sid=$row["sejyutu_no"];
	*/
}

$mysql = new MySQL_cls();
$mysql->MySQL();
//対象月に会員、施術者、患者が同じのデータがあるのか
$sql="SELECT * from RACE_DATA1 WHERE member_id =".$post_data['new_member_id']." AND sejyutu_no = ".$post_data['new_sejyutu_no']." AND kanjya_no = ".$post_data['new_riyo_no']. " AND sejyutu_month='".$post_data['new_sejyutu_month']."'";
$mysql->actQuery($sql);
$row = $mysql->getResult();


$data_ck="not_data";	//対象利用者が対象月の施術初めての場合
$data_riyosya_ck="not_data";
if($row){
	$data_ck="data";	//有る場合
}

$k_data_hokensyubetu =$row["hokensyubetu"];
$k_data_kouhiumu =$row["kouhiumu"];
$k_data_ouryouryo_ck =$row["ouryouryo_ck"];
$k_data_kanjya_jyusyo =$row["kanjya_jyusyo"];
$k_data_tiryoin_jyusyo =$row["address"];
$k_data_ido =$row["kanjya_ido"];
$k_data_keido =$row["kanjya_keido"];


$from_riyosya_time = $post_data['new_start'];				//利用者の時間を格納
$from_riyosya = "治療院";									//前患家を格納
$from_riyosya_add = $post_data['new_sejyutusya_add'];		//前患の住所を格納
$kyori = $post_data['new_from_chiryoin_kyori'];				//全患家からの距離
$jisseki = array();

//対象施術日の施術実績があるか選択患者も含む
$sql = "SELECT ";
$sql .= "RACE_DATA1.kanjya_no, ";
$sql .= "RACE_DATA1.kanjya_add,";
$sql .= "RACE_DATA1.ouryoryo_umu,";
$sql .= "RACE_DATA1.kanjya_ido, ";
$sql .= "RACE_DATA1.kanjya_keido, ";
$sql .= "RACE_DATA1.d".$post_data['new_sejyutu_day']." as day, ";
$sql .= "RACE_DATA1.k".$post_data['new_sejyutu_day']." as syoken,";
$sql .= "RACE_DATA1.z".$post_data['new_sejyutu_day']." as zenkanka,";
$sql .= "evenement.from_chiryoin,";
$sql .= "RIYOUSHA.kanjya_jyusyo, ";
$sql .= "RIYOUSHA.from_chiryoin_kyori, ";
$sql .= "RIYOUSHA.ouryouryo_ck ";
$sql .= "FROM RACE_DATA1 ";
$sql .= "LEFT JOIN RIYOUSHA ON RACE_DATA1.kanjya_no = RIYOUSHA.NO ";
$sql .= "LEFT JOIN evenement ON RACE_DATA1.d".$post_data['new_sejyutu_day']." = evenement.start ";
$sql .= "WHERE ";
$sql .= "RACE_DATA1.member_id = '".$post_data['new_member_id'];
$sql .= "' AND RACE_DATA1.sejyutu_no = '".$post_data['new_sejyutu_no'];
$sql .= "' AND RACE_DATA1.sejyutu_month= '".$post_data['new_sejyutu_month'];
$sql .= "' AND RACE_DATA1.k".$post_data['new_sejyutu_day']." IS NOT NULL";
$rtn = $mysql->actQuery_result($sql);
$row_cnt = $rtn->num_rows;

//前患家
//登録する日（施術日）に他施術データがあるかの判定
if($row_cnt !=0){
	//$data_riyosya_ck = "data";	//実績あり
	$count=0;
	$target_no = $count;
	$after_target_no = $count;
	$ck1=0;
	$ck2=0;
	while($jisseki= mysqli_fetch_array($rtn, MYSQLI_ASSOC)){			//結果を配列で取得
		$from["kanjya_no"][$count] = $jisseki["kanjya_no"];
		$from["kanjya_jyusyo"][$count] = $jisseki["kanjya_add"];
		$from["kanjya_ido"][$count] = $jisseki["kanjya_ido"];
		$from["kanjya_keido"][$count] = $jisseki["kanjya_keido"];

		$after["kanjya_no"][$count] = $jisseki["kanjya_no"];
		$after["kanjya_jyusyo"][$count] = $jisseki["kanjya_add"];
		$after["kanjya_ido"][$count] = $jisseki["kanjya_ido"];
		$after["kanjya_keido"][$count] = $jisseki["kanjya_keido"];
		$after["zenkanka"][$count] = $jisseki["zenkanka"];
		$after["from_chiryoin_kyori"][$count] = $jisseki["from_chiryoin_kyori"];
		$after["syoken"][$count] = $jisseki["syoken"];
		$after["ouryoryo_umu"][$count] = $jisseki["ouryoryo_umu"];

		//前患家チェック
		if(strtotime($post_data['new_start']) > strtotime($jisseki["day"])){
			//前患家あり
			$zenkan_ck="ari";
			//ループ内で前患データ1件目は比較判定できないので$after_riyosya_timeにデータ代入
			//$target_no = $countは対象データ1件しかない場合は$count初期値0
			if($ck1==0){

				$from_riyosya_time = $jisseki["day"];
				$target_no = $count;
				$ck1=1;
			}

			//複数前患家有る場合の為の判定
			if(strtotime($jisseki["day"])  > strtotime($from_riyosya_time)){

				$from_riyosya_time = $jisseki["day"];
				$target_no = $count;
			}
		}

		//後患家チェック
		if(strtotime($post_data['new_start']) < strtotime($jisseki["day"])){
			//後患家あり
			$koukan_ck="ari";
			//ループ内で前患データ1件目は比較判定できないので$after_riyosya_timeにデータ代入
			if($ck2==0){

				$after_riyosya_time = $jisseki["day"];
				$after_target_no = $count;
				$ck2=1;
			}

			if(strtotime($jisseki["day"]) < strtotime($after_riyosya_time)){

				$after_riyosya_time = $jisseki["day"];
				$after_target_no = $count;
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
	$after_from_ouryoryo_umu =$after["ouryoryo_umu"][$after_target_no];//後患家が治療院からの設定ONかの判定
}

//距離計算
$ka_ido=htmlspecialchars($post_data['new_kanjya_ido'], ENT_QUOTES);
$ka_keido=htmlspecialchars($post_data['new_kanjya_keido'], ENT_QUOTES);
if($zenkan_ck=="ari"){
	//前患家の距離
	$kyori=0;
	$kyori_rtn=location_distance($ka_ido, $ka_keido, $from_riyosya_ido, $from_riyosya_keido);
	$kyori=$kyori_rtn["distance_unit"];
	if($post_data['new_from_chiryoin_kyori'] < $kyori){
		$kyori=$post_data['new_from_chiryoin_kyori'];
		$from_riyosya="治療院";
		$from_riyosya_add=$k_data_tiryoin_jyusyo;
	}
}

//後患家
if($koukan_ck=="ari"){

	//後患家の距離
	$after_kyori = 0;
	$after_kyori_rtn = location_distance($ka_ido,$ka_keido, $after_riyosya_ido, $after_riyosya_keido);
	$after_kyori = $after_kyori_rtn["distance_unit"];

	if($after_from_chiryoin_kyori < $after_kyori){

		$after_kyori = $after_from_chiryoin_kyori;
		$after_riyosya = "治療院";
		$after_riyosya_add = $k_data_tiryoin_jyusyo;
	}else{
		$after_riyosya_no = $post_data['new_riyo_no'];
		$after_riyosya_add = $k_data_kanjya_jyusyo;
		//$after_riyosya_add = $riyo_jyusyo;
	}

}

if($new_from_chiryoin==1){
	$from_riyosya="治療院";
	$from_riyosya_add=$post_data['new_sejyutusya_add'];
}

if($row_cnt == 1){
	//RACE1テーブルアップデート
	$sql = "UPDATE RACE_DATA1 SET ";
	$sql .= "k".$post_data['new_sejyutu_month']."=".$post_data['new_syoken'].",";
	$sql .= "z".$post_data['new_sejyutu_month']."='$from_riyosya',";
	$sql .= "zk".$post_data['new_sejyutu_month']."='$kyori',";
	$sql .= "d".$post_data['new_sejyutu_month']."=".$post_data['new_start_race'].",";
	$sql .= "zj".$post_data['new_sejyutu_month']."='$from_riyosya_add', ";
	$sql .= "k".$post_data['$old_day']."= NULL,";
	$sql .= "z".$post_data['$old_day']."= NULL,";
	$sql .= "zk".$post_data['$old_day']."= NULL,";
	$sql .= "d".$post_data['$old_day']."= NULL,";
	$sql .= "zj".$post_data['$old_day']."= NULL ";
	$sql .= "WHERE member_id = ".$post_data['new_member_id'];
	$sql .= " AND sejyutu_no = ".$post_data['new_sejyutu_no'];
	$sql .= " AND kanjya_no = ".$post_data['new_riyo_no'];
	$sql .= " AND sejyutu_month=".$post_data['new_sejyutu_month'];
	$mysql->actQuery($sql);

	//後患家
	$syoken=$after["syoken"][$after_target_no];
	if($after["from_chiryoin"][$after_target_no] == 0){
		$sql = "UPDATE RACE_DATA1 SET ";
		$sql .= "k".$post_data['new_sejyutu_day']."='".$after_riyosya_syoken."',";
		$sql .= "z".$post_data['new_sejyutu_day']."='".$after_riyosya_no."',";
		$sql .= "zk".$post_data['new_sejyutu_day']."='".$after_kyori."',";
		$sql .= "zj".$post_data['new_sejyutu_day']."='".$after_riyosya_add."'";
		$sql .= " WHERE ";
		$sql .= "member_id = '".$post_data['new_member_id']."'";
		$sql .= " AND sejyutu_no = '".$post_data['new_sejyutu_no']."'";
		$sql .= " AND kanjya_no = '".$after_riyosya."'";
		$sql .= " AND sejyutu_month='".$post_data['new_sejyutu_month']."'";
		$mysql->actQuery($sql);
	}
}
var_dump($sql);
?>