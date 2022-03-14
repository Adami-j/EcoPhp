<?php
$host = 'eu-cdbr-west-02.cleardb.net';
$dbname = 'heroku_495fd814c1f433b';
$username = 'b56a58b253f64f';
$password = '37327fda';
$userId = $_GET['userId'];

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $sql = 'SELECT count(*) FROM user WHERE idUser = '+".$userId."+';';
    $response = $conn->exec($sql);
} catch (PDOException $e) {

    die("Impossible de se connecter à la base de données $dbname :" . $e->getMessage());

}
echo $response;

?>

