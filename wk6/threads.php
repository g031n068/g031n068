<!-- threads.php -->
<html lang="ja">
<head>
  <title>スレッド一覧</title>
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

            $thname = htmlspecialchars($_POST['th_name']);
            $thpass = htmlspecialchars($_POST['pass']);

            if ( $thname !== '' && $pass !== '' ) {

                //INSERT文の設定
                $query = " INSERT INTO threads ( "
                       . " thread_name,password "
                       . " ) VALUES ( "
                       . "'" . mysqli_real_escape_string( $link, $thname ) ."',"
                       . "'" . mysqli_real_escape_string( $link, $thpass ) ."'"
                       ." ) ";

                $res   = mysqli_query( $link, $query );

                if ( $res !== false ) {
                    $msg = '作成に成功しました';
                } else {
                    $err_msg = '作成に失敗しました';
                }
            } else {
                $err_msg = 'スレッド名,パスワードを記入してください';
            }
        }

        //SELECT文の設定
        $query  = "SELECT * FROM threads ORDER BY thread_id DESC";
        $res    = mysqli_query( $link,$query );

    } else {
        echo "データベースの接続に失敗しました";
    }

    // データベースへの接続を閉じる
    mysqli_close( $link );
    ?>
  </section>
  <article>
    <h1>スレッド一覧</h1>
    <form method="post" action="">
        スレッド名</br><input type="text" name="th_name" value="" placeholder="thread_name" size="35"/></br>
        パスワード</br><input type="password" name="pass" value="" placeholder="password" size="35"><br/>
        <input type="submit" name="send" value="スレッド作成" />
    </form></br>
      <!-- ここに、書き込まれたデータを表示する -->
    <?php
    //書き込みの成功・失敗の表示
    if ( $msg     !== '' ) {echo '<p>' . $msg . '</p>';}
    if ( $err_msg !== '' ) {echo '<p style="color:#f00;">' . $err_msg . '</p>';}
    ?>
    <table class="orange" border="1">
    <tr><th>スレッド名</th><th>作成日時</th><th></th></tr>

    <!--データベースのデータを表示-->
    <?php foreach( $res as $row ): ?>
              <tr><td width="100" align="center">
                <a href="messages.php?id=<?php echo htmlspecialchars($row['thread_id'])?>&n=<?php echo htmlspecialchars($row['thread_name'])?>">
                  <?php echo htmlspecialchars($row['thread_name'])?></a></td>
                  <td width="200" align="center"><?php echo htmlspecialchars($row['th_timestamp'])?></td>
                  <td>
                      <form action="threads_ed.php" method="post">
                      <input type="password" name="pass" value="" placeholder="password">
                      <input type="hidden" name="thid" value="<?php echo htmlspecialchars($row['thread_id'])?>">
                      <input type="hidden" name="thname" value="<?php echo htmlspecialchars($row['thread_name'])?>">
                      <input type="submit" name="edit" value="編集">
                    </form>
                  </td>
              </tr>
    <?php endforeach; ?>
    </table>
  </article>

</body>
</html>
