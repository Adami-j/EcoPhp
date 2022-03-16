<?php
/// Librairies éventuelles (pour la connexion à la BDD, etc.)
$host = 'eu-cdbr-west-02.cleardb.net';
$dbname = 'heroku_495fd814c1f433b';
$username = 'b56a58b253f64f';
$password = '37327fda';
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

} catch (PDOException $e) {

    die("Impossible de se connecter à la base de données $dbname :" . $e->getMessage());

}

/// Paramétrage de l'entête HTTP (pour la réponse au Client)
header("Content-Type:application/json");

/// Identification du type de méthode HTTP envoyée par le client
$http_method = $_SERVER['REQUEST_METHOD'];
switch ($http_method){
    /// Cas de la méthode GET
    case "GET" :
        /// Récupération des critères de recherche envoyés par le Client
        if (!empty($_GET['mon_critere'])){
            /// Traitement
             $req = "SELECT * from assos";
             $reqE= $conn->exec($req);
             $fet = $reqE->fetch();
             deliver_response($fet['id'],$fet['montantBk'],$fet['nom'],$fet['description'],$fet['latitude'],$fet['longitude']);



        }

        /// Envoi de la réponse au Client
        $matchingData ="coucou";
        deliver_response(200, "Votre message", "$matchingData");
        break;
    /// Cas de la méthode POST
    case "POST" :
        /// Récupération des données envoyées par le Client
        $postedData = file_get_contents('php://input');

        /// Traitement

        /// Envoi de la réponse au Client
        deliver_response(201, "Votre message", NULL);
        break;
    /// Cas de la méthode PUT
    case "PUT" :
        /// Récupération des données envoyées par le Client
        $postedData = file_get_contents('php://input');

        /// Traitement

        /// Envoi de la réponse au Client
        deliver_response(200, "Votre message", NULL);
        break;
    /// Cas de la méthode DELETE
    default :
        /// Récupération de l'identifiant de la ressource envoyé par le Client
        if (!empty($_GET['mon_id'])){
            /// Traitement
        }

        /// Envoi de la réponse au Client
        deliver_response(200, "Votre message", NULL);
        break;
}

/// Envoi de la réponse au Client
function deliver_response($id, $montantBk, $nom,$desc,$lat,$long){
    /// Paramétrage de l'entête HTTP, suite
    header("HTTP/1.1 $id $montantBk $nom $desc $lat ");

    /// Paramétrage de la réponse retournée
    $response['id'] = $id;
    $response['montantBk'] = $montantBk;
    $response['nom'] = $nom;
    $response['desc'] = $desc;
    $response['lat'] = $lat;
    $response['long'] = $long;


    /// Mapping de la réponse au format JSON
    $json_response = json_encode($response);
    echo $json_response;
}
?>

