<?php
session_start();

if(isset($_GET["no"])){
	$sNo= $_GET["no"];
}
$mId =$_SESSION["mid"];

$DATABASE_SERVER = 'mysql:host=mysql1308.xserver.jp;dbname=smilebest_4000;charset=utf8';
$DATABASE_USER = 'smilebest_user1';
$DATABASE_PWD = 'Windows1';
//$sNo = $_POST["no"];
try{
 $pdo = new PDO($DATABASE_SERVER, $DATABASE_USER, $DATABASE_PWD,array(PDO::ATTR_EMULATE_PREPARES => false));
}catch(PDOException $e){
  exit('data NG');
}

/* PDOオブジェクト自体に指定。レスポンスは常に連想配列形式で取得するようになる */
$pdo -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$query = "SELECT * FROM evenement where member_id = '$mId' and sejyutu_no = '$sNo'";

$stmt = $pdo->prepare($query);
$stmt->execute();

$resultat = $pdo->query($query) or die(print_r($pdo->errorInfo()));

echo json_encode($resultat->fetchAll(PDO::FETCH_ASSOC));


?>