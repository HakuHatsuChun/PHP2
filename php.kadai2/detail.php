
 <?php

$id = $_GET['id'];

try {
    $db_name = 'PHP_kadai2'; 
    $db_id   = 'root'; 
    $db_pw   = ''; 
    $db_host = 'localhost';
    $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
} catch (PDOException $e) {
    exit('DB Connection Error:' . $e->getMessage());
}

$stmt = $pdo->prepare('SELECT * FROM gs_bm_table WHERE id = :id;');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();
if ($status === false) {

    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    $result = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>ブックマーク</title>
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>

    <!-- Head[Start] -->
    <header>
        <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <form method="post" action="update.php">
        <div class="jumbotron">
            <fieldset>
                <legend>書籍登録</legend>
                <label>書籍名：<input type="text" name="name" value="<?= $result['name']?>"></label><br>
                <label>URL：<textArea name="source" rows="4" cols="40" value="<?= $result['source']?>"></textArea></label><br>
                <label>コメント：<textArea name="comment" rows="4" cols="40" value="<?= $result['comment']?>"></textArea></label><br>
                <input type="hidden" name="id" value="<?= $result['id']?>">
                <input type="submit" value="修正">
            </fieldset>
        </div>
    </form>
    <!-- Main[End] -->


</body>