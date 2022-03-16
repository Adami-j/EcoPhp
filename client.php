<?php

////////////////// Cas des méthodes GET et DELETE //////////////////
$result = file_get_contents('https://ecobackk.herokuapp.com/assos.php',
    false,
    stream_context_create(array('http' => array('method' => 'GET')))
// ou DELETE

);


////////////////// Cas des méthodes POST et PUT //////////////////
/// Déclaration des données à envoyer au Serveur
/// Dans tous les cas, affichage des résultats
echo '<pre>' . htmlspecialchars($result) . '</pre>';

?>
