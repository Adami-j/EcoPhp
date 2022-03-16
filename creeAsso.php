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
            $matchingData = $_GET['idUser'];
        }


        $reqSql = "select idUser, nom, montantBk, prenom from user where "."$matchingData =1;";
        $execution =$conn->query($reqSql);
        $fetching = $execution->fetch();
        /// Envoi de la réponse au Client
        deliver_responseGet($fetching);

        break;

    case "POST":


        $reqSql = "select idUser, nom, montantBk, prenom from user where idUser=1;";
        $execution =$conn->query($reqSql);
        $fetching = $execution->fetch();

        if(-10000<0){
            $valueFinal = $fetching['montantBk']-10000;
        }else{
            $valueFinal = $fetching['montantBk']+10000;
        }

        $reqSql = "UPDATE user SET montantBk ="."$valueFinal"."WHERE idUser =1;";
        $execution =$conn->exec($reqSql);
       deliver_responsePost(200,"bien modifié");

}




function deliver_responseGet( $data){
    /// Paramétrage de l'entête HTTP, suite
    header("HTTP/1.1 ");

    /// Paramétrage de la réponse retournée
    $res['idUser']= $data['idUser'];
    $res['nom']= $data['nom'];
    $res['prenom']= $data['prenom'];
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