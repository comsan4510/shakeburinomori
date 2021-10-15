<?php
  Include "ConnectDB.php";

  session_start();
  $_SESSION['null_input'] = null;

  //メールアドレスとパスワードの入力チェック
  if (!(isset($_POST['mail_adress']) || isset($_POST['password']))) {
    setcookie('my_id','');
    $_SESSION['null_input'] = "入力項目に漏れがあります";//nullセッションを発行
    header("Location: http://localhost");
  }

  $username = $_POST['username'];
  $mail_adress = $_POST['mail_adress'];
  $password = $_POST['password'];

  $password_hash = password_hash($password,PASSWORD_BCRYPT);

  //SQL文を作成※インジェクション未対策
  //INSERT INTO テーブル名 (列名1, 列名2,...) VALUES (値1, 値2,...);
  $command = sprintf('INSERT INTO member_table (user_name,password,mail_adress) VALUES (
    "%s","%s","%s");',
      $username,
      $password_hash,
      $mail_adress
    );

  //SQLの実行
  //使用方法：sendSQL(SQL文);
  if (sendSQL($command)) {
    //メンバー情報を取得
    $member_read = sprintf('SELECT * FROM member_table WHERE user_name="%s";',
        $username
      );
    $result = sendSQL($member_read);
    $row = $result->fetch_array(MYSQLI_ASSOC);

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
    $_SESSION['null_input'] = "登録に失敗しました";
    header("Location: http://localhost");
  }

 ?>
