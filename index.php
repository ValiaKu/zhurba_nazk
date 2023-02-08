<?
require __DIR__ . '/db.php';

$db = new Db();

$countBasa = $db->query("SELECT COUNT(*) as count FROM articles WHERE countBasa = 1");
$countZhurba = $db->query("SELECT COUNT(*) as count FROM articles WHERE countZhurba = 1");

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ЗАДОВБАЛО ТЕСТ</title>
    <script   src="https://code.jquery.com/jquery-3.6.3.min.js"   integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="   crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="" />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700&amp;display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="style.css" />
  </head>
  <div>
    <div class="top-box">
      <h1>#ЗАДОВБАЛО_ТЕСТ</h1>
      <h2>Пройдіть тест на знання хто ви з цих героїв?</h2>
    </div>

    <div class="main-wrapper">
      <div class="quiz-container" id="quiz-container"></div>

    </div>
    <script src="questions.js"></script>
    <script src="script.js"></script>

    <!-- Загальні результати, тягнуться з бази -->
    <div class="score-box">
      <div class="base-score" id="baseScore"><? echo $countBasa->row['count'] ?></div>
      <div class="zhurba-score" id="zhurbaScore"><? echo $countZhurba->row['count'] ?></div>
    </div>

      <?
      require __DIR__ . '/map.php';
      ?>

    <!-- соц мережі-->
    <div class="social-box">
      <div>
        <span>Розкажи про тест </span>
        <a href=""><img src="./images/fb.svg"></a>
        <a href=""><img src="./images/insta.svg"></a>
        <a href=""><img src="./images/twitter.svg"></a>
      </div>
    </div>
  </body>
</html>

