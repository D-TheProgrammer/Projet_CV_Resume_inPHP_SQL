<?php
//Connexion à la base de données
$nom_serv = "localhost";
$username = "root";
$mdp = "";
$nom_bdd = "site_cv";

$conn = new mysqli($nom_serv, $username, $mdp, $nom_bdd);

//Récupère l'Id de la compétence depuis l'URL
$id_competence = $_GET['maj_id_competence'];

//verification de si l'id est valide
if ($id_competence > 0) {

    $sql = "SELECT * FROM competence_info WHERE id_competence = $id_competence";
    $result = $conn->query($sql);

    $row = $result->fetch_assoc();
    $nom_competence = $row['nom_competence'];
    $niveau_competence = $row['niveau_competence'];
    $image_competence = $row['image_competence'];
} else {
    die("ID de la compétence incorrect");
}

// Pour les variables mises à jour après le bouton
if (isset($_POST['modifier'])) {
    //Pour echapper les caractères spéciaux
    $nom_competence = mysqli_real_escape_string($conn, $_POST['nom_competence']);
    $niveau_competence = mysqli_real_escape_string($conn, $_POST['niveau_competence']);
    
    //Gestion de l'image choisi
    if (isset($_FILES['image_competence']) && $_FILES['image_competence']['error'] === UPLOAD_ERR_OK) {
        $image_competence = $_FILES['image_competence']['name'];
        $image_competence = str_replace(' ', '_', $image_competence); //remplacer les espaces par des underscores
        $image_competence = strtolower($image_competence); //mettre le nom en minuscule

        //remplacer les caractères spéciaux
        $image_competence = str_replace(
            ['é', 'è', 'ê', 'ë', 'ô', 'ç', 'à', 'â', 'ù', "'"], 
            ['e', 'e', 'e', 'e', 'o', 'c', 'a', 'a', 'u', "_"], 
            $image_competence
        );

        //Chemin de destination
        $chemin = "../../gestion_image/" . basename($image_competence); 

        //Pour copier l'image
        if (!copy($_FILES['image_competence']['tmp_name'], $chemin)) {
            echo "<div class='alert alert-danger'>Échec de la copie de l'image.</div>";
        } else {
            //On echappe le chemin de l'image pour la bdd
            $chemin_image_bd = "gestion_image/" . mysqli_real_escape_string($conn, basename($image_competence));

            //Mise à jour de la base de données
            $sql = "UPDATE competence_info SET 
                        nom_competence='$nom_competence', 
                        niveau_competence='$niveau_competence', 
                        image_competence='$chemin_image_bd'
                    WHERE id_competence=$id_competence";
        }
    } else {
        // Mise à jour sans changer l'image
        $sql = "UPDATE competence_info SET 
                    nom_competence='$nom_competence', 
                    niveau_competence='$niveau_competence'
                WHERE id_competence=$id_competence";
    }

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>La compétence a bien été modifiée.</div>";
        // Redirection après 2 secondes
        echo "<script>
        setTimeout(function(){
            window.location.href = '../admin_index.php';
        }, 2000);
        </script>";
    } else {
        echo "<div class='alert alert-danger'>Échec de la modification de la compétence : " . $conn->error . "</div>";
    }
}

// Si on veut quitter
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
    <title>Mise à jour de la Compétence</title>
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
                <h2 class="text-center titre_page">Modifier la Compétence</h2>
                <form action="" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_competence" value="<?php echo $id_competence; ?>">
                
                    <div class="form-group">
                        <label>Nom de la compétence</label>
                        <input type="text" class="form-control" name="nom_competence" value="<?php echo htmlspecialchars($nom_competence); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Niveau de la compétence</label>
                        <input type="number" class="form-control" name="niveau_competence" min="1" max="5" value="<?php echo htmlspecialchars($niveau_competence); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Image de la compétence</label>
                        <input type="file" class="form-control" name="image_competence">
                        <small class="form-text text-muted">Laissez vide si vous ne souhaitez pas changer l'image.</small>
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
