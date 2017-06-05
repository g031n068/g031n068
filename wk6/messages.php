<!-- messages.php -->
<html lang="ja">
<head>
  <title><?php echo htmlspecialchars($_POST['name'])?></title>
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
    $link = mysqli_connect( 'localhost', $db_user, $db_pass, $db_name );
    if ( $link !== false ) {

        $msg     = '';
        $err_msg = '';

        if ( isset( $_POST['send'] ) === true ) {

            $name = htmlspecialchars($_POST['name']);
            $body = htmlspecialchars($_POST['body']);
            $pass = htmlspecialchars($_POST['pass']);
            $id = htmlspecialchars($_POST['id']);

            if ( $name !== '' && $body !== '' && $pass !== '' ) {

                //INSERT文の設定
                $query = " INSERT INTO messages ( "
                       . " name,password,body,thread_id "
                       . " ) VALUES ( "
                       . "'" . mysqli_real_escape_string( $link, $name ) ."',"
                       . "'" . mysqli_real_escape_string( $link, $pass ) ."',"
                       . "'" . mysqli_real_escape_string( $link, $body ) ."',"
                       . "'" . mysqli_real_escape_string( $link, $id ) ."'"
                       ." ) ";

                $res   = mysqli_query( $link, $query );

                if ( $res !== false ) {
                    $msg = '書き込みに成功しました';
                } else {
                    $err_msg = '書き込みに失敗しました';
                }
            } else {
                $err_msg = '名前,コメント,パスワードを記入してください';
            }
        }

        //SELECT文の設定
        $id = htmlspecialchars($_GET['id']);
        $query  = "SELECT * FROM threads INNER JOIN messages ON threads.id = messages.thread_id WHERE thread_id = $id ORDER BY message_id DESC;";
        $res    = mysqli_query( $link,$query );

    } else {
        echo "データベースの接続に失敗しました";
    }

    // データベースへの接続を閉じる
    mysqli_close( $link );
    ?>
  </section>
  <table>
    <tr>
    <?php foreach( $res as $row ): ?>
    <th><h1><?php echo htmlspecialchars($row['thread_name'])?></h1></th>
    <?php break;
          endforeach;
    ?>
    <tr>
  </table>

  <article>
    <form method="post" action="">
        名前</br><input type="text" name="name" value="" placeholder="name" size="35"/></br>
        パスワード</br><input type="password" name="pass" value="" placeholder="password" size="35"><br/>
        コメント</br><textarea name="body" rows="4" cols="50" placeholder="body"></textarea>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($_GET['id'])?>" />
        <input type="hidden" name="name" value="<?php echo htmlspecialchars($_POST['name'])?>" />
        <input type="submit" name="send" value="書き込む" />
    </form></br>
      <!-- ここに、書き込まれたデータを表示する -->
    <?php
    //書き込みの成功・失敗の表示
    if ( $msg     !== '' ) {echo '<p>' . $msg . '</p>';}
    if ( $err_msg !== '' ) {echo '<p style="color:#f00;">' . $err_msg . '</p>';}
    ?>
    <table class="orange" border="1">
    <tr><th>ユーザ名</th><th>コメント</th><th>投稿日時</th><th></th></tr>

    <!--データベースのデータを表示-->
    <?php foreach( $res as $row ): ?>
              <tr><td width="100" align="center"><?php echo htmlspecialchars($row['name'])?></td>
                  <td width="200" align="center"><?php echo htmlspecialchars($row['body'])?></td>
                  <td width="200" align="center"><?php echo htmlspecialchars($row['me_timestamp'])?></td>
                  <td>
                      <!-- 編集用フォーム -->
                      <form action="messages_ed.php" method="post">
                        <input type="password" name="pass" value="" placeholder="password">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['message_id'])?>" />
                        <input type="hidden" name="body" value="<?php echo htmlspecialchars($row['body'])?>" />
                        <input type="hidden" name="thnum" value="<?php echo htmlspecialchars($_GET['id'])?>">
                        <input type="hidden" name="thname" value="<?php echo htmlspecialchars($_POST['name'])?>">
                        <input type="submit" name="edit" value="編集">
                      </form>
                  </td>
              </tr>
    <?php endforeach; ?>
    </table>
    &lt;&lt;<a href="threads.php">スレッド一覧へ</a>
  </article>

</body>
</html>
