<?php

function h($s){
  return htmlspecialchars($s, ENT_QUOTES, 'utf-8');
}

session_start();
//ログイン済みの場合
if (isset($_SESSION['USER'])) {
  echo 'ようこそ' .  h($_SESSION['USER']) . "さん<br>";
  echo "<a href='/logout.php'>ログアウトはこちら。</a>";
  exit;
}

 ?>

<!DOCTYPE html>
<html lang="ja">
 <head>
   <meta charset="utf-8">
   <title>Login</title>
 </head>
 <body>
   <h1>ようこそ、ログインしてください。</h1>
   <form  action="login.php" method="post">
     <label>ユーザ名</label>
     <input type="text" name="user">
     <label>パスワード</label>
     <input type="password" name="password">
     <button type="submit">ログイン</button>
   </form>
   <a href="リンク先のＵＲＬ">はじめての方はこちら</a>
<!--
	 <p>※パスワードは半角英数字をそれぞれ１文字以上含んだ、８文字以上で設定してください。</p>
-->
 </body>
</html>