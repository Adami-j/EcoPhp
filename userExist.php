<?php
$host = 'eu-cdbr-west-02.cleardb.net';
$dbname = 'heroku_495fd814c1f433b';
$username = 'b56a58b253f64f';
$password = '37327fda';
$userId = $_GET['userId'];

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $sql ='UPDATE user SET montantBk = 10 WHERE idUser = 1';
    $response = $conn->exec($sql);
} catch (PDOException $e) {

    die("Impossible de se connecter à la base de données $dbname :" . $e->getMessage());

}
echo $response;
$sql = 'SELECT idUser, nom, prenom, montantBk FROM user;';
$response = $conn->query($sql);
$output = $response->fetchAll(PDO::FETCH_ASSOC);
echo(json_encode($output));

?>

