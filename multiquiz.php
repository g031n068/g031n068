<!-- multiquiz.php -->
<!DOCTYPE html>
<html lang="ja">
<head>
  <title>多肢選択式クイズ</title>
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
    print"多肢選択式クイズ";
    ?>
  </section></br>
  <?php
// 問題の正誤を判別
if ($_GET['answer'] === 'まさき') {
  echo "正解です";
} elseif ($_GET['answer'] === 'きむら') {
  echo "不正解です";
} elseif ($_GET['answer'] === 'すどう') {
  echo "不正解です";
} elseif ($_GET['answer'] === 'つかもと') {
  echo "不正解です";
}
?>
  <section>
    <p>学生研の室長は誰でしょう？</p>
    <form  action="multiquiz.php" method="get">
      <input type="radio" name="answer" value="まさき"/>まさき
      <input type="radio" name="answer" value="きむら"/>きむら
      <input type="radio" name="answer" value="すどう"/>すどう
      <input type="radio" name="answer" value="つかもと"/>つかもと
      <input type="submit" />
    </form>
  </section>


</body>
</html>
