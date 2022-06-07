<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
    <link rel="stylesheet" href="index.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <?php
    session_start();
    $connection = new mysqli("localhost", "site", "password", "site");
    if($connection -> connect_error){
        die("Error: " . $connection -> connect_error);
    }
    $sql = "call getGameToBuy(" . $_SESSION['game_id'] . ");";
    $data = $connection->query($sql)->fetch_all(MYSQLI_ASSOC);
    $json = json_encode($data, JSON_UNESCAPED_UNICODE);
    session_abort();
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
<div id="assortment"">
    <script>showAssortment($('div.hidden').data('json'))</script>
</div>
</body>
</html>
<?php
while($connection->next_result()) $connection->store_result();
if(isset($_POST["customer_name"]) && isset($_POST["address"]) && isset($_POST["telephone"])){
    if($_POST["customer_name"] != "" && $_POST["address"] != "" && $_POST["telephone"] != 0){
        $json = json_decode($json, JSON_UNESCAPED_UNICODE);
        try{
            $count = intval($json[0]["count"] - 1);
            $id = intval($json[0]["id"]);
            $customer_name = $_POST["customer_name"];
            $customer_id = $_POST["telephone"] % 1000000;
            $connection->query("update in_stock set count = " . $count . " where id = " . $id . ";");
            $connection -> query("insert into orders(id) value (" . $id . ");");
            try{
                $connection->query("insert into customers(id, customer_name) values(" . $customer_id  . ", '" .
                    $customer_name . "');");
            }
            catch (mysqli_sql_exception $e){}
            echo('<script>
                    alert("Поздравляем с приобретением! Заказ будет доставлен по указанному адресу в ближайшее время.");
                    location = "../mySite/index.php";
                </script>');
        }
        catch (mysqli_sql_exception $e){
            echo('<script>
                    alert("К сожалению, товар закончился(");
                  </script>');
        }
    }
    else{
        echo('<script>
                   alert("Пожалуйста, заполните все поля");
              </script>');
    }
}
