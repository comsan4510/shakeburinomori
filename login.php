<?php
  Include "ConnectDB.php";
  session_start();
  $_SESSION['null_input'] = null;
//メールアドレスとパスワードの入力チェック
if (!(isset($_POST['username']) || isset($_POST['login_password']))) {
  //$_SESSION['null_input'] = "ユーザー名又はパスワードが入力されていません";//nullセッションを発行
  setcookie('my_id','');
  //header("Location: index.php");
}else{
  $user_name = $_POST['username'];
  $password = $_POST['login_password'];

  //メンバー情報を取得
  $command = sprintf('SELECT * FROM member_table WHERE user_name="%s";',
      $user_name
    );
  $result = sendSQL($command);
  $row = $result->fetch_array(MYSQLI_ASSOC);

  //パスワードを認証
  if (password_verify($password,$row['password'])) {

    //セッションを発行
    $_SESSION['id'] = session_id($user_name);
    $_SESSION['username'] = $row['user_name'];
    $_SESSION['member_id'] = $row['member_id'];

    //cookieを設定
    setcookie('my_id',$_SESSION['id'],time()+60*60*24*7);
    setcookie('username',$_SESSION['username'],time()+60*60*24*7);
    setcookie('member_id',$_SESSION['member_id'],time()+60*60*24*7);

    header("Location: http://localhost");

  }else{
    setcookie('my_id','');
    //$_SESSION['null_input'] = "ユーザー名又はパスワードが違います";//nullセッションを発行
    header("Location: http://localhost");
  }

}


 ?>
