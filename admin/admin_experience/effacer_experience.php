<?php
//Connexion a la base de donen
$nom_serv = "localhost";
$username = "root";
$mdp = "";
$nom_bdd = "site_cv";

$conn = new mysqli($nom_serv, $username, $mdp, $nom_bdd);

//Reccupere l'Id de l'experience depuis l'URL
$id_experience = $_GET['effacer_id_experience'];

$sql = "DELETE from experience_info WHERE id_experience=$id_experience";

if ($conn->query($sql) === TRUE) {
    echo "<div class='alert alert-danger'>L'experience a bien été supprimé.</div>";
    // Redirection après 2 secondes
    echo "<script>
    setTimeout(function(){
        window.location.href = '../admin_index.php';
    }, 2000);
    </script>";
} else {
    echo "<div class='alert alert-danger'>Échec de la supression de la experience : " . $conn->error . "</div>";
}

// Fermeture de la connexion
$conn->close();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppression de l'Experience</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
</body>