<!-- result.php -->
<!DOCTYPE html>
<html lang="ja">
<head>
  <title>アンケート結果</title>
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
    print"アンケート回答結果";
    ?>
  </section></br>
  <section>
    <?php
    //answer1~4の値が渡された場合，それぞれ受け取り、値の結合を行う
    if (isset($_POST['answer1']) && is_array($_POST['answer1'])) {
      $answer1 = implode(', ', $_POST["answer1"]);
    }
    if (isset($_POST['answer2']) && is_array($_POST['answer2'])) {
      $answer2 = implode(', ', $_POST["answer2"]);
    }
    if (isset($_POST['answer3']) && is_array($_POST['answer3'])) {
      $answer3 = implode(', ', $_POST["answer3"]);
    }
    if (isset($_POST['answer4']) && is_array($_POST['answer4'])) {
      $answer4 = implode(', ', $_POST["answer4"]);
    }
?>
  </section>
  <section>
    <ul>
      <li>Q1.興味のある研究分野は？→<?php echo $answer1;?></li>
      <li>Q2.あなたの通学方法は？→<?php echo $answer2;?></li>
      <li>Q3.好きな季節は？→<?php echo $answer3;?></li>
      <li>Q4.学年は？→<?php echo $answer4;?></li>
    </ul>
  </section>
