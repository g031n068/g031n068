<!-- survey3.php -->
<!DOCTYPE html>
<html lang="ja">
<head>
  <title>アンケート③</title>
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
    print"アンケート③";
    ?>
  </section></br>
  <section>
    <?php
    //answer1,2の値の取得
    if (isset($_POST['answer1']) && is_array($_POST['answer1'])) {
      $answer1 = $_POST["answer1"];
    }
    if (isset($_POST['answer2']) && is_array($_POST['answer2'])) {
      $answer2 = $_POST["answer2"];
    }
    ?>
  </section>
  <section>
    <p>Q3.好きな季節は？</p>
    <form  action="survey4.php" method="post">
      <input type="checkbox" name="answer3[]" value="春"/>春
      <input type="checkbox" name="answer3[]" value="夏"/>夏
      <input type="checkbox" name="answer3[]" value="秋"/>秋
      <input type="checkbox" name="answer3[]" value="冬"/>冬
      <input type="submit" />
      <?php
          //隠しデータ(hidden)でanswer1,2の値を送る
          for($i=0;$i<count($answer1);$i++){
            print "<input type=\"hidden\" name=\"answer1[]\" value=\"$answer1[$i]\">";
          }
          for($i=0;$i<count($answer2);$i++){
            print "<input type=\"hidden\" name=\"answer2[]\" value=\"$answer2[$i]\">";
          }
        ?>
    </form>
  </section>
