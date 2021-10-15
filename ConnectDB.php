<?php
function sendSQL($sqlcommand){
  $host = 'localhost';
  $username = 'root';
  $passwd = '';
  $dbname = 'shakeburinomori';

  //データベースに接続
  $db = mysqli_connect($host, $username, $passwd, $dbname);

  if (!$db) {
    die('データベースの接続に失敗しました。');
  }

  //SQLの利用
  if($result = mysqli_query($db, $sqlcommand)){
    return $result;
  }else{
    echo "SQLの実行に失敗しました";
  }
}


 ?>
