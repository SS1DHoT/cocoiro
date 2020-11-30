<?php
    // データーベースへpdoで接続
    $pdo = new pdo("mysql:host=localhost;dbname=webapp","root","");
    
    // 接続に失敗すれば強制終了
    if(mysqli_connect_error()){
        die("Failed Connect DB.");
    }

	$sql = "SELECT * FROM userdata WHERE user = :user";
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(':user', $_POST['user']);
	$stmt->execute();
	$member = $stmt->fetch();
	
    if($_POST['user'] == ''){
        echo "ユーザー名を入力してください";
    }elseif($_POST['password']==''){
        echo "Passwordを入力してください";
    }elseif ($member['user'] === $_POST['user']){
		echo "同じユーザー名が存在します";
	}else{
		$user = $_POST['user'];
		//パスワードのハッシュ化
		$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        try {
			$stmt = $pdo->prepare("insert into userdata(user, password) value(?, ?)");
			$stmt->execute([$user, $password]);
			echo '登録完了';
		} catch (\Exception $e) {
			echo '登録済みのユーザー名です。';
		}    
    }
?>
<!--
//パスワードの正規表現
if (preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,100}+\z/i', $_POST['password'])) {
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
} else {
  echo 'パスワードは半角英数字をそれぞれ1文字以上含んだ8文字以上で設定してください。';
  return false;
}-->
<!DOCTYPE html>
<html lang="ja">
 <head>
   <meta charset="utf-8">
 </head>
 <body>
	 <input type="button" onclick="location.href='./pin.php'" value="ログイン画面へ">
 </body>