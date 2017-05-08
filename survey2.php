<!-- survey2.php -->
<!DOCTYPE html>
<html lang="ja">
<head>
  <title>アンケート②</title>
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
    print"アンケート②";
    ?>
  </section></br>

  <section>
    <?php
    //answer1の値の取得
    if (isset($_POST['answer1']) && is_array($_POST['answer1'])) {
      $answer1 = $_POST["answer1"];
    }
    ?>
  </section>

  <section>
    <p>Q2.あなたの通学方法は？</p>
    <form  action="survey3.php" method="post">
      <input type="checkbox" name="answer2[]" value="電車"/>電車
      <input type="checkbox" name="answer2[]" value="バス"/>バス
      <input type="checkbox" name="answer2[]" value="車"/>車
      <input type="checkbox" name="answer2[]" value="自転車"/>自転車
      <input type="submit" />
      <?php
          //隠しデータ(hidden)でanswer1の値を送る
          for($i=0;$i<count($answer1);$i++){
            print "<input type=\"hidden\" name=\"answer1[]\" value=\"$answer1[$i]\">";    
          }
      ?>
    </form>
  </section>


</body>
</html>
