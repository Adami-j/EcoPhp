<?php
try {
    // connection to the database.
    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
    $bdd = new PDO('mysql:host=eu-cbr-west-02.cleardb.net;dbname=heroku_495fd814c1f433b', 'b56a58b253f64f', '37327fda', $pdo_options);

    } catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>