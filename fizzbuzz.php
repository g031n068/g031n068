<!DOCTYPE html>
<html lang="ja">
<head>
  <title>Bulletin board</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h1><a href="index.html">Bulletin board</a><h1>
    <nav>
      <ul>
        <li><a href="index.html">トップ</a><li>
        <li><a href="index.html">更新情報</a></li>
        <li><a href="index.html">Bulletin boardについて</a><li>
        <li><a href="index.html">お問い合わせ</a></li>
      </ul>
    </nav>
  </header>
  <section>
    <p>Hello World <?php echo " from PHP";?></p>
    <?php
    print"PHP Test Page";
    ?>
  </section>
  <section>
    <?php
  for ($i=1; $i<=50; $i++) {
    if (($i % 15) == 0) {
      echo "FizzBuzz<br>\n";
    } else if (($i % 3) == 0) {
      echo "Fizz<br>\n";
    } else if (($i % 5) == 0) {
      echo "Buzz<br>\n";
    } else {
      echo $i . "<br>\n";
    }
  }
?>
  </section>


</body>
</html>
