<?php


$host = 'eu-cdbr-west-02.cleardb.net';
$dbname = 'heroku_495fd814c1f433b';
$username = 'b56a58b253f64f';
$password = '37327fda';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $critere = "Jean";
    $sql = 'SELECT * FROM user WHERE idUser="$critere" or nom = "$critere" or prenom = "$critere" or montantBK = "$critere"';
    $response = $conn->query($sql);
    $output = $response->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {

    die("Impossible de se connecter à la base de données $dbname :" . $e->getMessage());

}
echo $output;


?>