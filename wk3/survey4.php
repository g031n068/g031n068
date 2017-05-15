<!-- survey4.php -->
<!DOCTYPE html>
<html lang="ja">
<head>
  <title>アンケート④</title>
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
    print"アンケート④";
    ?>
  </section></br>
  <section>
    <?php
    //answer1,2,3の値の取得
    if (isset($_POST['answer1']) && is_array($_POST['answer1'])) {
      $answer1 = $_POST["answer1"];
    }
    if (isset($_POST['answer2']) && is_array($_POST['answer2'])) {
      $answer2 = $_POST["answer2"];
    }
    if (isset($_POST['answer3']) && is_array($_POST['answer3'])) {
      $answer3 = $_POST["answer3"];
    }

    ?>
  </section>
  <section>
    <p>Q4.学年は？</p>
    <form  action="result.php" method="post">
      <input type="checkbox" name="answer4[]" value="1年"/>1年
      <input type="checkbox" name="answer4[]" value="2年"/>2年
      <input type="checkbox" name="answer4[]" value="3年"/>3年
      <input type="checkbox" name="answer4[]" value="4年"/>4年
      <input type="submit" />
      <?php
      //隠しデータ(hidden)でanswer1,2,3の値を送る
          for($i=0;$i<count($answer1);$i++){
            print "<input type=\"hidden\" name=\"answer1[]\" value=\"$answer1[$i]\">";
          }
          for($i=0;$i<count($answer2);$i++){
            print "<input type=\"hidden\" name=\"answer2[]\" value=\"$answer2[$i]\">";
          }
          for($i=0;$i<count($answer3);$i++){
            print "<input type=\"hidden\" name=\"answer3[]\" value=\"$answer3[$i]\">";
          }
        ?>
    </form>
  </section>
