<?php


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
        if (!empty($_GET['id'])) {
            /// Traitement
            $matchingData = $_GET['id'];
        }
        $reqSql = "select id, nom, montantBk, description from assos where "."$matchingData =id;";
        $execution =$conn->query($reqSql);
        $fetching = $execution->fetch();
        /// Envoi de la réponse au Client
        deliver_responseGet($fetching);

        break;
    case "PUT":
        if (!empty($_GET['id']) and !empty($_GET['money'])) {
            /// Traitement
            $matchingData = $_GET['id'];
            $matchingMoney = $_GET['money'];
            $reqSql = "Update assos set montantBk = $matchingMoney WHERE id = $matchingData";
            $execution=$conn->exec($reqSql);
            deliver_responsePost(200, "ça marche!!!!!!");
        }
}




function deliver_responseGet( $data){
    /// Paramétrage de l'entête HTTP, suite
    header("HTTP/1.1 ");

    /// Paramétrage de la réponse retournée
    $res['id']= $data['id'];
    $res['nom']= $data['nom'];
    $res['description']= $data['description'];
    $res['montantBk']= $data['montantBk'];


    /// Mapping de la réponse au format JSON
    $json_response = json_encode($res);
    echo $json_response;

}

function deliver_responsePost($code, $message){
    /// Paramétrage de l'entête HTTP, suite
    header("HTTP/1.1 ");

    /// Paramétrage de la réponse retournée
    $res['code']= $code;
    $res['message']=$message;


    /// Mapping de la réponse au format JSON
    $json_response = json_encode($res);
    echo $json_response;

}
?>