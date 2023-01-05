<?php
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}
try {
  $pdo = new PDO('mysql:dbname=PHP_kadai2;charset=utf8;host=localhost','root','');

} catch (PDOException $e) {
  exit('DBConnectError'.$e->getMessage());
}

$stmt = $pdo->prepare("SELECT * FROM gs_bm_table;");
$status = $stmt->execute();

$view="";
if ($status==false) {
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $view .= '<p>';
    $view .= '<a href="detail.php?id='. $result["id"].'">'; $view .= $result["date"] .":". $result["name"] ; $view .= '</a>';
    $view .= ' ';
    $view .= '<a href="delete.php?id='.$result["id"].'">'; $view .= '[削除]';
    $view .= '</a>';
    $view .= '</p>'; }

}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>フリーアンケート表示</title>
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">

<header>
  <div class="navbar-header">
      <a class="navbar-brand" href="index.php">データ登録</a>
  </div>
</header>

<div>
    <div class="container jumbotron"><?= $view ?></div>
</div>

</body>
</html>
