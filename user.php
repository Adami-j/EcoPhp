<?php
include 'connexion.php';
$userId =1;
$host = 'eu-cdbr-west-02.cleardb.net';
$dbname = 'heroku_495fd814c1f433b';
$username = 'b56a58b253f64f';
$password = '37327fda';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    echo "Connecté à $dbname sur $host avec succès.";

} catch (PDOException $e) {

    die("Impossible de se connecter à la base de données $dbname :" . $e->getMessage());

}

throwUser(1);

function throwUser($userId){
    $host = 'eu-cdbr-west-02.cleardb.net';
    $dbname = 'heroku_495fd814c1f433b';
    $username = 'b56a58b253f64f';
    $password = '37327fda';
    $sql = 'SELECT idUser, nom, prenom, montantBK FROM user WHERE idUser='+".$userId.";'';
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $response = $conn->query($sql);
    $output = $response->fetch();
    echo $output;
    echo(json_encode($output));
}
