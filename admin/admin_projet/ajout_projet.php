<?php
// Connexion à la base de données
$nom_serv = "localhost";
$username = "root";
$mdp = "";
$nom_bdd = "site_cv";

$conn = new mysqli($nom_serv, $username, $mdp, $nom_bdd);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

if (isset($_POST['ajouter'])) {
    $nom_projet = mysqli_real_escape_string($conn, $_POST['nom_projet']);
    $description_projet = mysqli_real_escape_string($conn, $_POST['description_projet']);
    $lien_projet = mysqli_real_escape_string($conn, $_POST['lien_projet']);
    $couleur_projet = mysqli_real_escape_string($conn, $_POST['couleur_projet']);

    // Gestion de l'image téléchargée
    $image_projet = $_FILES['image_projet']['name'];
    $image_projet = str_replace(' ', '_', $image_projet); // Remplacer les espaces par des underscores
    $image_projet = strtolower($image_projet); // Mettre le nom en minuscule

    // Remplacer les caractères spéciaux
    $image_projet = str_replace(
        ['é', 'è', 'ê', 'ë', 'ô', 'ç', 'à', 'â', 'ù', "'"],
        ['e', 'e', 'e', 'e', 'o', 'c', 'a', 'a', 'u', "_"],
        $image_projet
    );

    // Chemin de destination
    $chemin = "../../gestion_image/" . basename($image_projet); 

    // Pour copier l'image
    if (copy($_FILES['image_projet']['tmp_name'], $chemin)) {
        // Échapper le chemin de l'image pour la base de données
        $chemin_image_bd = "gestion_image/" . mysqli_real_escape_string($conn, basename($image_projet));

        // Insertion dans la base de données
        $sql = "INSERT projet_info SET 
                nom_projet='$nom_projet', 
                image_projet='$chemin_image_bd', 
                description_projet='$description_projet',
                lien_projet='$lien_projet',
                couleur_projet='$couleur_projet'
            ";

        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success'>Le projet a été ajouté avec succès.</div>";
            echo "<script>
                setTimeout(function(){
                    window.location.href = '../admin_index.php';
                }, 2000);
            </script>";
        } else {
            echo "<div class='alert alert-danger'>Échec de l'ajout du projet : " . $conn->error . "</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Échec de la copie de l'image.</div>";
    }
}

if (isset($_POST['quitter'])) {
    echo "<div class='alert alert-danger'>Aucune modification n'a été effectuée.</div>";
    echo "<script>
        setTimeout(function(){
            window.location.href = '../admin_index.php';
        }, 2000);
    </script>";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout d'un Projet</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f7fa;
        }
        .zone_contenu {
            padding: 30px;
            margin-top: 50px;
            overflow: auto;
            box-sizing: border-box;
            margin: 20px auto;
            background-color: white;
            border-radius: 8px;
            box-shadow: 3px 8px 15px rgba(0, 0, 0, 0.1);
        }
        .titre_page {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="zone_contenu">
                <h2 class="text-center titre_page">Ajout d'un Projet</h2>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nom du projet</label>
                        <input type="text" class="form-control" name="nom_projet" >
                    </div>

                    <div class="form-group">
                        <label>Image du projet</label>
                        <input type="file" class="form-control" name="image_projet" accept="image/*" required >
                    </div>

                    <div class="form-group">
                        <label>Description du Projet</label>
                        <textarea class="form-control" name="description_projet" rows="4" ></textarea>
                    </div>

                    <div class="form-group">
                        <label>Lien du Projet</label>
                        <input type="url" class="form-control" name="lien_projet" >
                    </div>
             
                    <div class="form-group">
                        <label>Choisir la couleur du projet :</label><br>
                        <input type="radio" name="couleur_projet" value="red" >
                        <label for="red">Rouge</label><br>
                        
                        <input type="radio" name="couleur_projet" value="black">
                        <label for="black">Noir</label><br>
                        
                        <input type="radio" name="couleur_projet" value="green">
                        <label for="green">Vert</label><br>
                        
                        <input type="radio" name="couleur_projet" value="blue">
                        <label for="blue">Bleu</label><br>
                        
                        <input type="radio" name="couleur_projet" value="#EEEE00">
                        <label for="yellow">Jaune</label><br>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-danger mr-2" name="quitter">Quitter</button>
                        <button type="submit" class="btn btn-success" name="ajouter">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
