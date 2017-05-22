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
    $link = mysqli_connect( 'localhost', $db_user, $db_pass, $db_name );
    if ( $link !== false ) {

        $msg     = '';
        $err_msg = '';

        if ( isset( $_POST['send'] ) === true ) {

            $name = $_POST['name'];
            $body = $_POST['body'];
            $pass = $_POST['pass'];

            if ( $name !== '' && $body !== '' ) {

                //INSERT文の設定
                $query = " INSERT INTO messages ( "
                       . " name,password,body "
                       . " ) VALUES ( "
                       . "'" . mysqli_real_escape_string( $link, $name ) ."',"
                       . "'" . mysqli_real_escape_string( $link, $pass ) ."',"
                       . "'" . mysqli_real_escape_string( $link, $body ) ."'"
                       ." ) ";

                $res   = mysqli_query( $link, $query );

                if ( $res !== false ) {
                    $msg = '書き込みに成功しました';
                } else {
                    $err_msg = '書き込みに失敗しました';
                }
            } else {
                $err_msg = '名前とコメントを記入してください';
            }
        }

        //SELECT文の設定
        $query  = "SELECT * FROM messages ORDER BY id DESC";
        $res    = mysqli_query( $link,$query );

    } else {
        echo "データベースの接続に失敗しました";
    }

    // データベースへの接続を閉じる
    mysqli_close( $link );
    ?>
  </section>
  <article>
    <p>掲示板データベース</p>
    <form method="post" action="">
        名前</br><input type="text" name="name" value="" placeholder="name" size="35"/></br>
        パスワード</br><input type="password" name="pass" value="" placeholder="password" size="35"><br/>
        コメント</br><textarea name="body" rows="4" cols="50" placeholder="body"></textarea>
        <input type="submit" name="send" value="書き込む" />
    </form></br>
      <!-- ここに、書き込まれたデータを表示する -->
    <?php
    //書き込みの成功・失敗の表示
    if ( $msg     !== '' ) {echo '<p>' . $msg . '</p>';}
    if ( $err_msg !== '' ) {echo '<p style="color:#f00;">' . $err_msg . '</p>';}
    ?>
    <table class="bordered" border="1">
    <tr><th>Name</th><th>Body</th><th>Timestamp</th><th></th></tr>

    <!--データベースのデータを表示-->
    <?php foreach( $res as $row ): ?>
              <tr><td width="100" align="center"><?php echo $row['name']?></td>
                  <td width="200" align="center"><?php echo $row['body']?></td>
                  <td width="200" align="center"><?php echo $row['timestamp']?></td>
                  <td>
                      <form action="dbbs_ed.php" method="post">
                      <input type="password" name="pass" value="" placeholder="password">
                      <input type="hidden" name="id" value="<?php echo $row['id']?>" />
                      <input type="hidden" name="body" value="<?php echo $row['body']?>" />
                      <input type="submit" name="edit" value="編集">
                    </form>
                  </td>
              </tr>
    <?php endforeach; ?>
    </table>
  </article>

</body>
</html>
