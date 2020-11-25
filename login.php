<?php
try {
  $pdo = new pdo("mysql:host=localhost;dbname=webapp","root","");
  $stmt = $pdo->prepare('select * from userdata where user = ?');
  $stmt->execute([$_POST['user']]);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (\Exception $e) {
  echo $e->getMessage() . PHP_EOL;
}
//userがDB内に存在しているか確認
if (!isset($row['user'])) {
  echo 'ユーザー名又はパスワードが間違っています';
  return false;
}
//パスワード確認後sessionにメールアドレスを渡す
if (password_verify($_POST['password'], $row['password'])) {
  session_regenerate_id(true); //session_idを新しく生成し、置き換える
  $_SESSION['USER'] = $row['user'];
  echo 'ログインしました';
  header( "Location: ./index.html" ) ;
} else {
  echo 'メールアドレス又はパスワードが間違っています。';
  return false;
}