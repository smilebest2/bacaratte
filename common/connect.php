<?php

require_once 'const.php';

class connect {
  //定数の宣言
  const DB_NAME = MYSQL_DB_NAME;
  const HOST = HOST_NAME;
  const UTF  = 'utf8';
  const USER = MYSQL_USER_NAME;
  const PASS = MYSQL_PASSWORD;
  //データベースに接続する関数
  function pdo(){
    /*phpのバージョンが5.3.6よりも古い場合はcharset=".self::UTFが必要無くなり、array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES '.SELF::UTF')が必要になり、5.3.6以上の場合は必要ないがcharset=".self::UTFは必要になる。*/
    $dsn="mysql:dbname=".self::DB_NAME.";host=".self::HOST.";charset=".self::UTF;
    $user=self::USER;
    $pass=self::PASS;
    try{
      $pdo=new PDO($dsn,$user,$pass,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES '.SELF::UTF));
    }catch(Exception $e){
      echo 'error' .$e->getMesseage;
      die();
    }
    //エラーを表示してくれる。
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    return $pdo;
  }
  //SELECT文のときに使用する関数。
  function select($sql){
    $hoge=$this->pdo();
    $stmt=$hoge->query($sql);
    $items=$stmt->fetchAll(PDO::FETCH_ASSOC);
    return $items;
  }
  //SELECT,INSERT,UPDATE,DELETE文の時に使用する関数。
  function login($sql,$user_id){
    $hoge=$this->pdo();
    $stmt=$hoge->prepare($sql);
    $stmt->execute(array(':user_id'=>$user_id));//sql文のVALUES等の値が?の場合は$itemでもいい。
    return $stmt;
  }
  function update_login($sql,$login_data){
  	$hoge=$this->pdo();
  	$stmt=$hoge->prepare($sql);
  	$stmt->bindParam(':last_login', date('Y-m-d H:i:s', strtotime($login_data['data'])), PDO::PARAM_STR);
	$stmt->bindValue(':user_id', $login_data['user_id'], PDO::PARAM_INT);
	$stmt->execute();
	return $stmt;
  }
  function select_user_id($sql,$user_id){
  	$hoge=$this->pdo();
  	$stmt=$hoge->prepare($sql);
  	$stmt->execute(array(':user_id'=>$user_id));
  	return $stmt;
  }
  function select_chiryoin($sql,$ID){
  	$hoge=$this->pdo();
  	$stmt=$hoge->prepare($sql);
  	$stmt->execute(array(':ID'=>$ID));
  	return $stmt;
  }
  function count_chiryoin($sql,$ID){
  	$hoge=$this->pdo();
  	$stmt=$hoge->prepare($sql);
  	$stmt->execute(array(':ID'=>$ID));
  	$count = $stmt -> fetchColumn();
  	return $count;
  }
  function update_chiryoin($sql,$chiryoin_data){
  	//トランザクション処理を開始
  	$pdo = $this->pdo();
  	$pdo->beginTransaction();
  	try{
	  	$hoge=$this->pdo();
	  	$stmt=$hoge->prepare($sql);
	  	$stmt->bindParam(':denwabango', $chiryoin_data['denwabango'], PDO::PARAM_STR);
	  	$stmt->bindParam(':siharaikubun', $chiryoin_data['siharaikubun'], PDO::PARAM_STR);
	  	$stmt->bindParam(':ginkomei', $chiryoin_data['ginkomei'], PDO::PARAM_STR);
	  	$stmt->bindParam(':sitenmei', $chiryoin_data['sitenmei'], PDO::PARAM_STR);
	  	$stmt->bindParam(':kouza', $chiryoin_data['kouza'], PDO::PARAM_STR);
	  	$stmt->bindParam(':kouzameigi', $chiryoin_data['kouzameigi'], PDO::PARAM_STR);
	  	$stmt->bindParam(':kouzabango', $chiryoin_data['kouzabango'], PDO::PARAM_STR);
	  	$stmt->bindParam(':dairinin', $chiryoin_data['dairinin'], PDO::PARAM_STR);
	  	$stmt->bindParam(':dairinin_add', $chiryoin_data['dairinin_add'], PDO::PARAM_STR);
	    $stmt->bindValue(':ID', $chiryoin_data['ID'], PDO::PARAM_INT);
	  	$stmt->execute();
	  	//コミット
	  	$pdo->commit();
	  	return $stmt;
	}catch(PDOException $e){
  		//ロールバック
  		$pdo->rollback();
 		throw $e;
 		echo 'error' .$e->getMesseage;
  	}
  }
  function insert_chiryoin($sql,$chiryoin_data){
  	$pdo = $this->pdo();
  	$pdo->beginTransaction();
  	try{
	  	$hoge=$this->pdo();
	  	$stmt=$hoge->prepare($sql);
	  	$stmt->bindParam(':ID', $chiryoin_data['ID'], PDO::PARAM_STR);
	  	$stmt->bindParam(':denwabango', $chiryoin_data['denwabango'], PDO::PARAM_STR);
	  	$stmt->bindParam(':siharaikubun', $chiryoin_data['siharaikubun'], PDO::PARAM_STR);
	  	$stmt->bindParam(':ginkomei', $chiryoin_data['ginkomei'], PDO::PARAM_STR);
	  	$stmt->bindParam(':sitenmei', $chiryoin_data['sitenmei'], PDO::PARAM_STR);
	  	$stmt->bindParam(':kouza', $chiryoin_data['kouza'], PDO::PARAM_STR);
	  	$stmt->bindParam(':kouzameigi', $chiryoin_data['kouzameigi'], PDO::PARAM_STR);
	  	$stmt->bindParam(':kouzabango', $chiryoin_data['kouzabango'], PDO::PARAM_STR);
	  	$stmt->bindParam(':dairinin', $chiryoin_data['dairinin'], PDO::PARAM_STR);
	  	$stmt->bindParam(':dairinin_add', $chiryoin_data['dairinin_add'], PDO::PARAM_STR);
	  	$stmt->bindValue(':ID', $chiryoin_data['ID'], PDO::PARAM_INT);
	  	$stmt->execute();
	  	//コミット
	  	$pdo->commit();
  		return $stmt;
  	}catch(PDOException $e){
  		//ロールバック
  		$pdo->rollback();
  		throw $e;
  		echo 'error' .$e->getMesseage;
  	}
  }
  function select_sejyutusya($sql,$serch_data,$serch_no){
  	$hoge=$this->pdo();
  	$stmt=$hoge->prepare($sql);

  	if($serch_no=="1"){
	  	$stmt->execute(array(':member_id'=>$serch_data['member_id'],':ID'=>$serch_data['kensaku']));
  	}
  	if($serch_no=="2"){
  		$stmt->execute(array(':member_id'=>$serch_data['member_id'],':ID'=>$serch_data['kensaku']));
  	}
  	if($serch_no=="3"){
  		$stmt->execute(array(':member_id'=>$serch_data['member_id'],':ID'=>$serch_data['kensaku']));
  	}
  	if($serch_no=="4"){
  		$stmt->execute(array(':member_id'=>$serch_data['member_id']));
  	}
  	return $stmt;
  }
  function delete_sejyutusya($sql,$NO){
  	$hoge=$this->pdo();
  	$stmt=$hoge->prepare($sql);
  	$stmt->execute(array(':NO'=>$NO));
  	return $stmt;
  }
  function select_kanjya($sql,$serch_data,$serch_no){
  	$hoge=$this->pdo();
  	$stmt=$hoge->prepare($sql);
	$kenasku="%".$serch_data['kensaku']."%";
  	if($serch_no=="1"){
  //		$stmt->execute(array(':member_id'=>$serch_data['member_id'],':ID'=>'%'.$serch_data['kensaku'].'%'));
  		$stmt->bindValue(':member_id',$serch_data['member_id'], PDO::PARAM_INT);
  		$stmt->bindValue(':ID',$kenasku, PDO::PARAM_INT);
  		$stmt->execute();
  	}
  	if($serch_no=="2"){
  		$stmt->execute(array(':member_id'=>$serch_data['member_id'],':ID'=>$serch_data['kensaku']));
  	}
  	if($serch_no=="3"){
  		$stmt->execute(array(':member_id'=>$serch_data['member_id'],':ID'=>$serch_data['kensaku']));
  	}
  	if($serch_no=="4"){
  		$stmt->execute(array(':member_id'=>$serch_data['member_id']));
  	}
  	return $stmt;
  }
}