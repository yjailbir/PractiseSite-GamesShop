<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ассортимент</title>
  <link rel="stylesheet" href="index.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <?php
    $connection = new mysqli("localhost", "site", "password", "site");
    if($connection -> connect_error){
        die("Error: " . $connection -> connect_error);
    }
    $sql = "select id, title, description from assortment;";
    $data = $connection->query($sql)->fetch_all(MYSQLI_ASSOC);
    $json = json_encode($data, JSON_UNESCAPED_UNICODE);
    session_start();
    ?>
    <div
            class="hidden"
            data-json = '<?= $json ?>'>
    </div>
    <script src="scripts/assortmentScripts.js"></script>
</head>
<body bgcolor="#a5baa1">
    <a href="index.php" id="home">
        <div class="logo"></div>
    </a>
    <div id="assortment">
        <script>showAssortment($('div.hidden').data('json'))</script>
    </div>
    <hr color="black">
  <div align="right">
    <button id = "toUp">Наверх</button>
  </div>
  <script src="scripts/upScript.js"></script>
</body>
</html>
<?php
$arr = [1,2,3,4,5,6,7,8,9];
if(isset($_POST) && in_array(implode("", $_POST), $arr)){
    $id = implode("", $_POST);
    $_SESSION['game_id'] = $id;
    echo "<script>location = '../mySite/buy.php';</script>";
}