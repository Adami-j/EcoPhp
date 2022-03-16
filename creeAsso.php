<?php
include "connexion.php";

header("Content-Type:application/json");
$host = 'eu-cdbr-west-02.cleardb.net';
$dbname = 'heroku_495fd814c1f433b';
$username = 'b56a58b253f64f';
$password = '37327fda';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

} catch (PDOException $e) {

    die("Impossible de se connecter à la base de données $dbname :" . $e->getMessage());

}



$http_method = $_SERVER['REQUEST_METHOD'];
switch ($http_method) {
    /// Cas de la méthode GET
    case "GET" :
        /// Récupération des critères de recherche envoyés par le Client
        if (!empty($_GET['mon_critere'])) {
            /// Traitement
        }

        $req = "select * from user;";
        $reqE = $conn->exec($req);
        $reqA = $reqE->fetch();
        deliver_response($reqA);
        break;
}




function deliver_response($data){
    /// Paramétrage de l'entête HTTP, suite
    header("HTTP/1.1");

    /// Paramétrage de la réponse retournée
    $response['id']= 3;

    /// Mapping de la réponse au format JSON
    $json_response = json_encode($response);
    echo $json_response;
}


?>