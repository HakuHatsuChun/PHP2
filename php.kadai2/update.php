<?php

$name   = $_POST['name'];
$source    = $_POST['source'];
$comment = $_POST['comment'];
$id = $_POST['id'];

try {
    $db_name = 'PHP_kadai2'; 
    $db_id   = 'root'; 
    $db_pw   = ''; 
    $db_host = 'localhost';
    $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
} catch (PDOException $e) {
    exit('DB Connection Error:' . $e->getMessage());
}

$stmt = $pdo->prepare('UPDATE gs_bm_table SET name = :name, source = :source, comment = :comment, date = sysdate() WHERE id = :id;');

$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':source', $source, PDO::PARAM_STR); 
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT); 

$status = $stmt->execute();

if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    header('Location: index.php');
    exit();
}