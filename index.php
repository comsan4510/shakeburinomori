<?php
if (!session_start()) {
	echo 'セッション開始失敗！';
}

if (isset($_SESSION['null_input'])) {
  echo $_SESSION['null_input'];
}

if (isset($_SESSION['id'])) {
  $member_id = $_SESSION['member_id'];
  echo $member_id;
  $user_name = $_SESSION['username'];
}
if (isset($_COOKIE['my_id']) && isset($_COOKIE['username'])) {
  $u_name = $_COOKIE['username'];
}else{
  $u_name = "";
}

 ?>
<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>鮭鰤の森</title>
  </head>
  <body>
    <h1>鮭鰤の森へようこそ</h1>
    <h1>新規会員登録</h1>
    <?php if (isset($_SESSION['id'])){
      echo "ここにログイン処理を記述";
    }else{
      ?>
      <form class="" action="touroku.php" method="post">
        <label>メールアドレス:<input type="email" name="mail_adress" value="" required></label>
        <label>ユーザー名：<input type="text" name="username" value="" required></label>
        <label>パスワード：<input type="password" name="password" value="" required></label>
        <label>パスワード再入力：<input type="password" name="re_password" required></label>
        <input type="submit" name="" value="登録">
      </form>

      <h1>ログイン</h1>
      <form class="" action="login.php" method="post">
        <label>ユーザー名：<input type="text" name="username" value="<?php echo $u_name; ?>" required>
        </label>
        <label>パスワード：<input type="password" name="login_password" value="" required></label>

        <input type="submit" name="" value="ログイン">
      </form>
    <?php } ?>
  </body>
</html>
