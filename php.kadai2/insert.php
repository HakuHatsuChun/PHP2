<?php
ini_set('display_errors',1);
$name = $_POST['name'];
$source = $_POST['source'];
$comment = $_POST['comment'];

try {
  $pdo = new PDO('mysql:dbname=PHP_kadai2;charset=utf8;host=localhost','root','');

} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}

$stmt = $pdo->prepare("INSERT INTO
                        gs_bm_table(id,name,source,comment,date)
                        VALUES(NULL,:name,:source,:comment,sysdate())
");

$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':source', $source, PDO::PARAM_STR);
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);

$status = $stmt->execute();

if($status === false){
  $error = $stmt->errorInfo();
  exit('ErrorMessage:'.$error[2]);
}else{
  header('Location: index.php');

}
?>
