<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Подобрать игру</title>
  <link rel="stylesheet" href="index.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <?php
    $connection = new mysqli("localhost", "site", "password", "site");
    if($connection -> connect_error){
        die("Error: " . $connection -> connect_error);
    }
    $sql = "select title, genre, min_gamers, max_gamers, price from assortment left join prices on prices.id = assortment.id;";
    $data = $connection->query($sql)->fetch_all(MYSQLI_ASSOC);
    $json = json_encode($data, JSON_UNESCAPED_UNICODE);
    ?>
    <div
            class="hidden"
            data-json = '<?= $json ?>'>
    </div>
    <script src="scripts/searchScript.js"></script>
</head>
<body bgcolor="#a5baa1">
  <a href="index.php">
    <div class="logo">
    </div>
  </a>
  <div class="content flex">
    <div class="menu">
      <div class="link">
        <a href="about.php">О нас</a>
      </div>
      <div class="link">
        <a href="assortment.php">Ассортимент</a>
      </div>
      <div class="link">
        <a href="search.php">Подбор товаров</a>
      </div>
      <div class="link">
        <a href="map.php">Наши магазины</a>
      </div>
    </div>
    <div class="frame flex-c">
      <div class="inner">
        <h1>
          Подобрать настольную игру
        </h1>
        <div>
          <h3>Выберите жанр:</h3>
          <select id="genre">
            <option></option>
            <option value="Приключения">Приключения</option>
            <option value="Стратегия">Стратегия</option>
            <option value="Just for fun">Just for fun</option>
          </select>
          <h3>Сколько человек планирует играть:</h3>
          <input id="count_gamers">
          <h3>Цена не выше:</h3>
          <input id="max_price">
        </div>
        <br>
        <div><button id="searchButton">Подобрать игру!</button></div>
          <script>
              document.getElementById("searchButton").onclick = chooseGames
          </script>
        <h3 id="result"></h3>
        <div><button id="button" class="btn">Купить</button></div>
        <script>document.getElementById("button").hidden = true;</script>
        <script>
          document.getElementById("button").onclick = function (){
            document.location.href = "assortment.php";
          }
        </script>
      </div>
    </div>
  </div>
</body>
</html>