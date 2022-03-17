
<?php
/// Librairies éventuelles (pour la connexion à la BDD, etc.)
$server = "localhost" ;
$login = "root";
$mdp = "root";
$db = "xavier";
///Connexion au serveur MySQL
try {
    $linkpdo = new PDO("mysql:host=$server;dbname=$db", $login, $mdp);
}
    ///Capture des erreurs éventuelles
catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

/// Paramétrage de l'entête HTTP (pour la réponse au Client)
header("Content-Type:application/json");

/// Identification du type de méthode HTTP envoyée par le client
$http_method = $_SERVER['REQUEST_METHOD'];
switch ($http_method){
    /// Cas de la méthode GET
    case "GET" :
        /// Récupération des critères de recherche envoyés par le Client
        if (!empty($_GET['nom'])){
            /// Traitement
            $critere = $_GET['nom'];
            $reqE=$linkpdo -> query("Select *
				from contact
				where nom = $critere");

            $matchingData = $reqE->fetch();
        }
        if($res == false)
            deliver_response(400,"Ressource non récupérée",NULL);


        /// Envoi de la réponse au Client
        deliver_response(200, "Votre message", $matchingData[]);
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
