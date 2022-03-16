<?php

////////////////// Cas des méthodes GET et DELETE //////////////////
$result = file_get_contents('https://ecobackk.herokuapp.com/assos.php',
    false,
    stream_context_create(array('http' => array('method' => 'GET')))

// ou DELETE

);

print_r($result);


////////////////// Cas des méthodes POST et PUT //////////////////
/// Déclaration des données à envoyer au Serveur
/// Dans tous les cas, affichage des résultats
echo '<pre>' . htmlspecialchars($result) . '</pre>';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>

    <form>
        <input method="GET" id="cc" value="Bonjour" type="btn">
    </form>
</head>
<body>

</body>
</html>