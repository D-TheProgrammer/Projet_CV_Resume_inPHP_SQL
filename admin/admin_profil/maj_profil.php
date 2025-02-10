<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connexion à la base de données
    $servername = "localhost";
    $username = "root";  
    $password = "";  
    $dbname = "site_cv"; 

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connexion échouée : " . $conn->connect_error);
    }
    
    //On récupère les informations du formulaire
    $id = $_POST['id'];  
    $nom = mysqli_real_escape_string($conn, $_POST['nom']);
    $prenom = mysqli_real_escape_string($conn, $_POST['prenom']);
    $nationalite = mysqli_real_escape_string($conn, $_POST['nationalite']);
    $numero = mysqli_real_escape_string($conn, $_POST['numero']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $linkedin = mysqli_real_escape_string($conn, $_POST['linkedin']);
    $adresse = mysqli_real_escape_string($conn, $_POST['adresse']);
    $github = mysqli_real_escape_string($conn, $_POST['github']);
    $profil = mysqli_real_escape_string($conn, $_POST['profil']);
    $date_naissance = mysqli_real_escape_string($conn, $_POST['date_naissance']);
    $couleur_cv = mysqli_real_escape_string($conn, $_POST['couleur_cv']);
    $diplome_profil = mysqli_real_escape_string($conn, $_POST['diplome_profil']);

    
    //Gestion du logo
    if (isset($_FILES['logo_site']) && $_FILES['logo_site']['error'] === UPLOAD_ERR_OK) {
        $logo_site = $_FILES['logo_site']['name'];
        $logo_site = str_replace(' ', '_', $logo_site);  // Remplace les espaces par des underscores
        $logo_site = strtolower($logo_site);  // Convertit en minuscules
    
        // Remplace les caractères spéciaux
        $logo_site = str_replace(
            ['é', 'è', 'ê', 'ë', 'ô', 'ç', 'à', 'â', 'ù', "'"], 
            ['e', 'e', 'e', 'e', 'o', 'c', 'a', 'a', 'u', "_"], 
            $logo_site
        );
    
        // Chemin de destination pour le fichier
        $chemin = "../../gestion_image/" . basename($logo_site); 
    
        if (copy($_FILES['logo_site']['tmp_name'], $chemin)) {
            $chemin_logo_bd = "gestion_image/" . mysqli_real_escape_string($conn, basename($logo_site));
    
            // Mise à jour avec le logo
            $sql = "UPDATE personne_info SET 
                        nom='$nom', 
                        prenom='$prenom', 
                        nationalite='$nationalite', 
                        numero='$numero', 
                        email='$email', 
                        linkedin='$linkedin', 
                        adresse='$adresse', 
                        github='$github', 
                        profil='$profil', 
                        date_naissance='$date_naissance',
                        couleur_cv='$couleur_cv',
                        diplome_profil='$diplome_profil',
                        logo_site='$chemin_logo_bd'
                    WHERE id=$id";
    
            //Execution de la requête SQL
            if ($conn->query($sql) === TRUE) {
                echo "<div class='alert alert-success'>Mise à jour réussie avec logo.</div>";
            } else {
                echo "<div class='alert alert-danger'>Erreur de mise à jour du logo : " . $conn->error . "</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Échec de la copie du logo.</div>";
        }
    } 
    else {
        // Mise à jour sans changer le logo
        $sql = "UPDATE personne_info SET 
                    nom='$nom', 
                    prenom='$prenom', 
                    nationalite='$nationalite', 
                    numero='$numero', 
                    email='$email', 
                    linkedin='$linkedin', 
                    adresse='$adresse', 
                    github='$github', 
                    profil='$profil', 
                    date_naissance='$date_naissance',
                    diplome_profil='$diplome_profil',
                    couleur_cv='$couleur_cv'
                WHERE id=$id";
    }

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Mise à jour réussie pour l'utilisateur</div>";
        // Redirection après 2 secondes
        echo "<script>
                    setTimeout(function(){
                        window.location.href = '../admin_index.php';
                    }, 2000);
            </script>";
    } else {
        echo "<div class='alert alert-danger'>Échec de la modification des informations Personnelles : " . $conn->error . "</div>";
    }

    $conn->close();
}

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mise à jour des informations personnelles</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
