<!-- onequiz.php -->
<!DOCTYPE html>
<html lang="ja">
<head>
  <title>一問一答クイズ</title>
  <link rel="stylesheet" href="style.css">

  <!--ポップアップ表示-->
  <script type="text/javascript">
  function chValie() {
    txt = document.qform.elements["answer"].value;
    if(txt == "") {
        alert("未入力です。答えを入力してください。");
        return false;
      }
    return true;
  }

  </script>
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
    print"一問一答式クイズ";
    ?>
  </section></br>
  <?php
// 問題の正誤を判別
if ($_GET['answer'] === '山田') {
  echo "正解です";
}elseif ($_GET['answer'] === '敬三') {
  echo "正解です";
}elseif ($_GET['answer'] === '山田敬三') {
  echo "正解です";
}elseif ($_GET['answer'] === 'やまだ') {
  echo "正解です";
}elseif ($_GET['answer'] === 'けいぞう') {
  echo "正解です";
}elseif ($_GET['answer'] === 'やまだけいぞう') {
  echo "正解です";
}elseif ($_GET['answer'] === 'Yamada') {
  echo "正解です";
}elseif ($_GET['answer'] === 'Keizou') {
  echo "正解です";
}elseif ($_GET['answer'] === 'YamadaKeizou') {
  echo "正解です";
}elseif ($_GET['answer'] === NULL) {
  yesno;
}else {
  echo "不正解です";
}
?>
  <section>
    <p>この授業の担当教員の名前は？</p>
    <form name="qform" action="onequiz.php" method="get" onSubmit="return chValie()">
      <input type="text"     name="answer" placeholder="名前は？"/>
      <input type="submit" />
    </form>
  </section>

</body>
</html>
