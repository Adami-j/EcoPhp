<?php
try {
    // connection to the database.
    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
    $bdd = new PDO('mysql:host=eu-cdbr-west-02.cleardb.net;dbname=heroku_495fd814c1f433b', 'b56a58b253f64f', '37327fda', $pdo_options);
    // Execute SQL request on the database.
    $sql = 'SELECT idUser, nom, prenom, montantBk FROM user;';
    $response = $bdd->query($sql);

    $output = $response->fetchAll(PDO::FETCH_ASSOC);
    echo $output;
    } catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>