<!-- dbbs.php -->
<html lang="ja">
<head>
  <title>データベース利用</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h1><a href="index.php">PHP Test Page</a><h1>
    <nav>
      <ul>
        <li><a href="index.php">トップ</a><li>
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
          $query = "SELECT password FROM messages WHERE id = {$_POST['id']}";
          $dbbs_pw = $mysqli->query($query)->fetch_row();
          if (strcmp($dbbs_pw[0], $_POST['pass']) !== 0) {
            print '<script>
                    alert("パスワードが違います");
                    location.href = "dbbs.php";
                  </script>';
            exit();
          }
        }

        if (isset($_POST['del'])) {    //削除時
          $del = $mysqli->query("DELETE FROM messages WHERE id = {$_POST['id']}");
          if (!$del) {   //エラーの表示
            printf("Query failed: %s\n", $mysqli->error);
            exit();
          } else {    //削除後、dbbs.phpへ
            print '<script>
                    alert("削除しました．");
                    location.href = "dbbs.php";
                  </script>';
            exit();
          }
        }

        if (isset($_POST['upd'])) {   //更新時
          $upd = $mysqli->query("UPDATE messages SET `body`='{$_POST['body']}' WHERE id= '{$_POST['id']}'");
          if (!$upd) {   //エラーを表示する
            printf("Query failed: %s\n", $mysqli->error);
            exit();
          } else {   //更新後、dbbs.phpへ
            print '<script>
                    alert("更新しました．");
                    location.href = "dbbs.php";
                  </script>';
          }
        }
    // データベースへの接続を閉じる
      $mysqli->close();
      ?>
  </section>
  <article>
    <p>投稿内容の編集</p>
    <form method="post" action="">
        コメント</br><textarea name="body" rows="4" cols="50" placeholder="body"><?php echo $_POST['body']?></textarea>
        <input type="hidden" name="id" value="<?php echo $_POST['id']?>" />
        <input type="submit" name="upd" value="更新" />
        <input type="submit" name="del" value="削除">
    </form></br>
  </article>
</body>
</html>
