<?php
//connexion à la db
$host = 'eu-cdbr-west-02.cleardb.net';
$dbname = 'heroku_495fd814c1f433b';
$username = 'b56a58b253f64f';
$password = '37327fda';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

} catch (PDOException $e) {

    die("Impossible de se connecter à la base de données $dbname :" . $e->getMessage());

}

//header
header("Content-Type:application/json");

/// Identification du type de méthode HTTP envoyée par le client
$http_method = $_SERVER['REQUEST_METHOD'];
switch ($http_method){
    /// Cas de la méthode GET
    case "GET" :
        /// Récupération des critères de recherche envoyés par le Client
        if (!empty($_GET['mon_critere'])){
            /// Traitement
            $critere = $_GET['mon_critere'];
            $donnees=$conn->query("SELECT * FROM user WHERE id=$critere or nom = $critere or prenom = $critere or montantBK = $critere");
            while($exec = $donnees->fetch() ) {
                $result[] = $exec;
            }
            header('Content-Type: application/json');
            echo json_encode($result, JSON_PRETTY_PRINT);
        }

        /// Envoi de la réponse au Client
        $matchingData = "reponse";
        deliver_response(200, "Traitement effectué", $matchingData);
        break;


    /// Cas de la méthode POST
    case "POST" :
        /// Récupération des données envoyées par le Client
        $postedData = file_get_contents('php://input');
        $contact = json_decode($postedData,true);

        /// Traitement
        if (!empty($contact)){
            $insertion=$conn->query("INSERT INTO contact(nom,prenom,numtel) VALUES($contact["nom"],$contact["prenom"],$contact["numtel"])");
		    }

        /// Envoi de la réponse au Client
        deliver_response(201, "Ressource créée", NULL);
        break;


    /// Cas de la méthode PUT
    case "PUT" :
        /// Récupération des données envoyées par le Client
        $postedData = file_get_contents('php://input');

        /// Traitement

        /// Envoi de la réponse au Client
        deliver_response(200, "Traitement effectué", NULL);
        break;


    /// Cas de la méthode DELETE
    default :
        /// Récupération de l'identifiant de la ressource envoyé par le Client
        if (!empty($_GET['mon_id'])){
            /// Traitement
            $id = $_GET['mon_id'];
            $sql="SELECT COUNT(*) as q FROM user WHERE id='$id';";
            $res=$conn->query($sql);
            $resu=$res->fetch();
            if($resu['q']==1){
                $req = "DELETE FROM user WHERE id ='$id'";
                $conn->exec($req);
            }
        }

        /// Envoi de la réponse au Client
        deliver_response(200, "Traitement effectué", NULL);
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


?>