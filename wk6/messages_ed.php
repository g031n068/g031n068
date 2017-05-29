<!-- messages_ed.php -->
<html lang="ja">
<head>
  <title>データベース利用</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h1><a href="../index.php">PHP Test Page</a><h1>
    <nav>
      <ul>
        <li><a href="../index.php">トップ</a><li>
      </ul>
    </nav>
  </header>
  <section>
    <?php
    $db_user = 'g031n068';     // ユーザー名
    $db_pass = 'l_o6dmz2Q8'; // パスワード
    $db_name = 'bbs';     // データベース名

    // データベースへ接続
    $mysqli = new mysqli('localhost', $db_user, $db_pass, $db_name);
      //接続エラー処理
      if ($mysqli->connect_errno) {
        printf("Connect failed: %s\n", $mysqli->connect_errno);
        exit();
      }

        if (isset($_POST['edit'])) {    //編集時
          //パスワードの認証を行う
          $id = htmlspecialchars($_POST['id']);
          $pass = htmlspecialchars($_POST['pass']);
          $query = "SELECT password FROM messages WHERE message_id = "
                  . "'" . mysqli_real_escape_string( $mysqli, $id ) ."'";
          $dbbs_pw = $mysqli->query($query)->fetch_row();
          if (strcmp($dbbs_pw[0], $pass) !== 0) {
            print '<script>
                    alert("パスワードが違います");
                    location.href = "javascript:history.back();";
                  </script>';
            exit();
          }
        }

        if (isset($_POST['del'])) {    //削除時
          $id = htmlspecialchars($_POST['id']);
          $del = $mysqli->query("DELETE FROM messages WHERE message_id = "
                . "'" . mysqli_real_escape_string( $mysqli, $id ) ."'");
          if (!$del) {   //エラーの表示
            printf("Query failed: %s\n", $mysqli->error);
            exit();
          } else {    //削除後、messages.phpへ
            $id = htmlspecialchars($_POST['thnum']);
            $n = htmlspecialchars($_POST['thname']);
            header("location: messages.php?id=$id&n=$n");
            exit();
          }
        }

        if (isset($_POST['upd'])) {   //更新時
          if($_POST['body'] !== ''){
            $id = htmlspecialchars($_POST['id']);
            $body = htmlspecialchars($_POST['body']);
            $upd = $mysqli->query("UPDATE messages SET `body`="
            . "'" . mysqli_real_escape_string( $mysqli, $body ) ."'"
            . " WHERE message_id = "
            . "'" . mysqli_real_escape_string( $mysqli, $id ) ."'");


            if (!$upd) {   //エラーを表示する
              printf("Query failed: %s\n", $mysqli->error);
              exit();
            } else {   //更新後、messages.phpへ
              $id = htmlspecialchars($_POST['thnum']);
              $n = htmlspecialchars($_POST['thname']);
              header("location: messages.php?id=$id&n=$n");
            }
          } else {
            $err_msg = 'コメントを入力してください';
          }
        }
    // データベースへの接続を閉じる
      $mysqli->close();
      ?>
  </section>
  <article>
    <p>投稿内容の編集</p>
    <?php
    //書き込みの成功・失敗の表示
    if ( $err_msg !== '' ) {echo '<p style="color:#f00;">' . $err_msg . '</p>';}
    ?>
    <!-- 更新・削除用フォーム -->
    <form method="post" action="">
        コメント</br><textarea name="body" rows="4" cols="50" placeholder="body"><?php echo htmlspecialchars($_POST['body'])?></textarea>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($_POST['id'])?>" />
        <input type="hidden" name="thnum" value="<?php echo htmlspecialchars($_POST['thnum'])?>" />
        <input type="hidden" name="thname" value="<?php echo htmlspecialchars($_POST['thname'])?>" />
        <input type="submit" name="upd" value="更新" />
        <input type="submit" name="del" value="削除">
    </form></br>
    &lt;&lt;<a href="messages.php?id=<?php echo htmlspecialchars($_POST['thnum'])?>&n=<?php echo htmlspecialchars($_POST['thname'])?>">スレッド一覧へ</a>
  </article>
</body>
</html>
