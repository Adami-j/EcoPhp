<?php
$host = 'eu-cdbr-west-02.cleardb.net';
$dbname = 'heroku_495fd814c1f433b';
$username = 'b56a58b253f64f';
$password = '37327fda';
$Montant = $_GET['montant'];

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $sql ='UPDATE user SET montantBk ='."$Montant".' WHERE idUser = 1';
    $response = $conn->exec($sql);
} catch (PDOException $e) {

    die("Impossible de se connecter à la base de données $dbname :" . $e->getMessage());

}
echo "ok";

?>

