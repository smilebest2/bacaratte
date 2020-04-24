<?php

$DATABASE_SERVER = 'mysql:host=mysql1308.xserver.jp;dbname=smilebest_3900;charset=utf8';
$DATABASE_USER = 'smilebest_user1';
$DATABASE_PWD = 'Windows1';

$title=$_POST['title'];
$start=$_POST['start'];
$end=$_POST['end'];
 
// connexion à la base de données
 try {
 $bdd = new PDO($DATABASE_SERVER, $DATABASE_USER, $DATABASE_PWD,array(PDO::ATTR_EMULATE_PREPARES => false));
}catch(PDOException $e){
  exit('data NG');
 }
 
$sql = "INSERT INTO evenement (title, start, end) VALUES (:title, :start, :end)";
$q = $bdd->prepare($sql);
$q->execute(array(':title'=>$title, ':start'=>$start, ':end'=>$end));

?>