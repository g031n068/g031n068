<!-- survey1.php -->
<!DOCTYPE html>
<html lang="ja">
<head>
  <title>アンケート①</title>
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
    print"アンケート①";
    ?>
  </section></br>
  <section>
    <p>Q1.興味のある研究分野は？</p>
    <form  action="survey2.php" method="post">
      <input type="checkbox" name="answer1[]" value="教育"/>教育
      <input type="checkbox" name="answer1[]" value="観光"/>観光
      <input type="checkbox" name="answer1[]" value="農業"/>農業
      <input type="checkbox" name="answer1[]" value="医療"/>医療
      <input type="submit" />
    </form>
  </section>


</body>
</html>
