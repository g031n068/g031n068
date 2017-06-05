<!-- threads_ed.php -->
<html lang="ja">
<head>
  <title>スレッドの編集</title>
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
          $thid = htmlspecialchars($_POST['thid']);
          $pass = htmlspecialchars($_POST['pass']);
          $query = "SELECT password FROM threads WHERE id = "
                  . "'" . mysqli_real_escape_string( $mysqli, $thid ) ."'";
          $dbbs_pw = $mysqli->query($query)->fetch_row();
          if (strcmp($dbbs_pw[0], $pass) !== 0) {
            print '<script>
                    alert("パスワードが違います");
                    location.href = "threads.php";
                  </script>';
            exit();
          }
        }

        if (isset($_POST['delete'])) {    //削除時
          $thid = htmlspecialchars($_POST['thid']);
          $delth = $mysqli->query("DELETE FROM threads WHERE id = "
                . "'" . mysqli_real_escape_string( $mysqli, $thid ) ."'");
          $delms = $mysqli->query("DELETE FROM messages WHERE thread_id = "
                . "'" . mysqli_real_escape_string( $mysqli, $thid ) ."'");
          if (!$delth && !$delms) {   //エラーの表示
            printf("Query failed: %s\n", $mysqli->error);
            exit();
          } else {    //削除後、threads.phpへ
            print '<script>
                    alert("削除しました．");
                    location.href = "threads.php";
                  </script>';
            exit();
          }
        }

        if (isset($_POST['update'])) {   //更新時
          if($_POST['thname'] !== ''){
            $thname = htmlspecialchars($_POST['thname']);
            $thid = htmlspecialchars($_POST['thid']);
            $upd = $mysqli->query("UPDATE threads SET `thread_name`="
            . "'" . mysqli_real_escape_string( $mysqli, $thname ) ."'"
            . " WHERE id = "
            . "'" . mysqli_real_escape_string( $mysqli, $thid ) ."'");
            if (!$upd) {   //エラーを表示する
              printf("Query failed: %s\n", $mysqli->error);
              exit();
            } else {   //更新後、threads.phpへ
              print '<script>
                      alert("更新しました．");
                      location.href = "threads.php";
                      </script>';
                    }
          } else {
            $err_msg = 'スレッド名を入力してください';
          }
        }
    // データベースへの接続を閉じる
      $mysqli->close();
      ?>
  </section>
  <article>
    <h1>スレッドの編集</h1>
    <?php
    //書き込みの成功・失敗の表示
    if ( $err_msg !== '' ) {echo '<p style="color:#f00;">' . $err_msg . '</p>';}
    ?>
    <!-- 更新・削除用フォーム -->
    <form method="post" action="">
        スレッド名</br><textarea name="thname" rows="4" cols="50" placeholder="body"><?php echo htmlspecialchars($_POST['thname'])?></textarea>
        <input type="hidden" name="thid" value="<?php echo htmlspecialchars($_POST['thid'])?>" />
        <input type="submit" name="update" value="更新" />
        <input type="submit" name="delete" value="削除">
    </form></br>
    &lt;&lt;<a href="threads.php">スレッド一覧へ</a>
  </article>
</body>
</html>
