<?php
//Connexion à la base de données
$nom_serv = "localhost";
$username = "root";
$mdp = "";
$nom_bdd = "site_cv";

$conn = new mysqli($nom_serv, $username, $mdp, $nom_bdd);

//Récupère l'Id du projet depuis l'URL
$id_projet = $_GET['maj_id_projet'];

//Vérification de si l'id est valide
if ($id_projet > 0) {
    //pour récupérer les informations avec l'ID spécifique
    $sql = "SELECT * FROM projet_info WHERE id_projet = $id_projet";
    $result = $conn->query($sql);

    $row = $result->fetch_assoc();
    $nom_projet = $row['nom_projet'];
    $image_projet = $row['image_projet'];
    $description_projet = $row['description_projet'];
    $lien_projet = $row['lien_projet'];
    $couleur_projet = $row['couleur_projet'];
} else {
    die("ID du projet incorrect");
}

// Pour les variables mises à jour après le bouton
if (isset($_POST['modifier'])) {
    //EscapeString pour les caractères spéciaux et éviter les erreurs SQL
    $nom_projet = mysqli_real_escape_string($conn, $_POST['nom_projet']);
    $description_projet = mysqli_real_escape_string($conn, $_POST['description_projet']);
    $lien_projet = mysqli_real_escape_string($conn, $_POST['lien_projet']);
    $couleur_projet = mysqli_real_escape_string($conn, $_POST['couleur_projet']);

    //Gestion de l'image choisie
    if (isset($_FILES['image_projet']) && $_FILES['image_projet']['error'] === UPLOAD_ERR_OK) {
        $image_projet = $_FILES['image_projet']['name'];
        $image_projet = str_replace(' ', '_', $image_projet); // Remplacer les espaces par des underscores
        $image_projet = strtolower($image_projet); // Mettre le nom en minuscule

        //remplacer les caractères spéciaux
        $image_projet = str_replace(
            ['é', 'è', 'ê', 'ë', 'ô', 'ç', 'à', 'â', 'ù', "'"], 
            ['e', 'e', 'e', 'e', 'o', 'c', 'a', 'a', 'u', "_"], 
            $image_projet
        );

        //Chemin de destination
        $chemin = "../../gestion_image/" . basename($image_projet); 

        //Pour copier l'image
        if (copy($_FILES['image_projet']['tmp_name'], $chemin)) {
            //On echappe le chemin de l'image pour la bdd
            $chemin_image_bd = "gestion_image/" . mysqli_real_escape_string($conn, basename($image_projet));

            //Mise à jour de la base de données
            $sql = "UPDATE projet_info SET 
                        nom_projet='$nom_projet', 
                        image_projet='$chemin_image_bd', 
                        description_projet='$description_projet',
                        lien_projet='$lien_projet',
                        couleur_projet='$couleur_projet'
                    WHERE id_projet=$id_projet";
        } else {
            echo "<div class='alert alert-danger'>Échec de la copie de l'image.</div>";
        }
    } else {
        // Mise à jour sans changer l'image
        $sql = "UPDATE projet_info SET 
                    nom_projet='$nom_projet', 
                    description_projet='$description_projet',
                    lien_projet='$lien_projet',
                    couleur_projet='$couleur_projet'
                WHERE id_projet=$id_projet";
    }

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Le projet a bien été modifié.</div>";
        // Redirection après 2 secondes
        echo "<script>
        setTimeout(function(){
            window.location.href = '../admin_index.php';
        }, 2000);
        </script>";
    } else {
        echo "<div class='alert alert-danger'>Échec de la modification du projet : " . $conn->error . "</div>";
    }
}

//Si on veut quitter
if (isset($_POST['quitter'])) {
    echo "<div class='alert alert-danger'>RIEN n'a été modifié.</div>";
    // Redirection après 2 secondes
    echo "<script>
    setTimeout(function(){
        window.location.href = '../admin_index.php';
    }, 2000);
    </script>";
}

// Fermeture de la connexion
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mise à jour du Projet</title>
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
                <h2 class="text-center titre_page">Modifier le Projet</h2>
                <form action="" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_projet" value="<?php echo $id_projet; ?>">
                
                    <div class="form-group">
                        <label>Nom du Projet</label>
                        <input type="text" class="form-control" name="nom_projet" value="<?php echo htmlspecialchars($nom_projet); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Image du Projet</label>
                        <input type="file" class="form-control" name="image_projet">
                        <small class="form-text text-muted">Laissez vide si vous ne souhaitez pas changer l'image.</small>
                    </div>

                    <div class="form-group">
                        <label>Description de Projet</label>
                        <textarea class="form-control" name="description_projet" rows="4" required><?php echo htmlspecialchars($description_projet); ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Lien du Projet</label>
                        <input type="text" class="form-control" name="lien_projet" value="<?php echo htmlspecialchars($lien_projet); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Choisir la couleur du projet :</label><br>
                        <input type="radio" name="couleur_projet" value="red" <?php if($couleur_projet == 'red') echo 'checked'; ?>>
                        <label for="red">Rouge</label><br>
                        
                        <input type="radio" name="couleur_projet" value="black" <?php if($couleur_projet == 'black') echo 'checked'; ?>>
                        <label for="black">Noir</label><br>
                        
                        <input type="radio" name="couleur_projet" value="green" <?php if($couleur_projet == 'green') echo 'checked'; ?>>
                        <label for="green">Vert</label><br>
                        
                        <input type="radio" name="couleur_projet" value="blue" <?php if($couleur_projet == 'blue') echo 'checked'; ?>>
                        <label for="blue">Bleu</label><br>
                        
                        <input type="radio" name="couleur_projet" value="#EEEE00" <?php if($couleur_projet == '#EEEE00') echo 'checked'; ?>>
                        <label for="yellow">Jaune</label><br>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-danger mr-2" name="quitter">Quitter</button>
                        <button type="submit" class="btn btn-success" name="modifier">Modifier</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

</body>
</html>
