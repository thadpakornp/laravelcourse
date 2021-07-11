<?php

$LINEData = file_get_contents('php://input');
$jsonData = json_decode($LINEData, true);


$userID = $jsonData["events"][0]["source"]["userId"];
$text = $jsonData["events"][0]["message"]["text"];
$recivedtime = date('Y-m-d H:i:s', $jsonData["events"][0]["timestamp"]);
// $jsonData = json_encode($jsonData);

$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "laravel";

$mysql = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($mysql, "utf8");
if ($mysql->connect_error) {
    $errorcode = $mysql->connect_error;
    print("MySQL(Connection)> " . $errorcode);
}

$sql = "INSERT INTO LogginLine(userID,text,recivedtime) VALUES ('$userID','$text','$recivedtime')";
if ($mysql->query($sql) === TRUE) {
    echo 'Ok';
} else {
    echo $mysql->error;
}
