<?php
include "connexion.php";

header("Content-Type:application/json");

$http_method = $_SERVER['REQUEST_METHOD'];
switch ($http_method) {
    /// Cas de la méthode GET
    case "GET" :
        /// Récupération des critères de recherche envoyés par le Client
        if (!empty($_GET['mon_critere'])) {
            /// Traitement
            $req = "select * from user;";
            $reqE = $conn->exec($req);
            $reqA = $reqE->fetch();
            echo json_encode($reqA);

        }

        /// Envoi de la réponse au Client
        deliver_response(200, "Votre message", $matchingData);
        break;
}




function deliver_response($status, $status_message, $data){
    /// Paramétrage de l'entête HTTP, suite
    header("HTTP/1.1 $status $status_message");

    /// Paramétrage de la réponse retournée
    $response['status'] = $status;
    $response['status_message'] = $status_message;
    $response['data'] = $data;

    /// Mapping de la réponse au format JSON
    $json_response = json_encode($response);
    echo $json_response;
}


?>