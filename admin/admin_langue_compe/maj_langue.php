<?php
//connexion à la base de données
$nom_serv = "localhost";
$username = "root";
$mdp = "";
$nom_bdd = "site_cv";

$conn = new mysqli($nom_serv, $username, $mdp, $nom_bdd);

//verification de la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

//On récupère l'Id de la langue depuis l'URL
$id_langue = $_GET['maj_id_langue'];

//vérification de si l'id est valide
if ($id_langue > 0) {
    // Pour récupérer les informations avec l'ID spécifique
    $sql = "SELECT * FROM langue_info WHERE id_langue = $id_langue";
    $result = $conn->query($sql);

    $row = $result->fetch_assoc();
    $nom_langue = $row['nom_langue'];
    $niveau_langue = $row['niveau_langue'];
    $image_langue = $row['image_langue'];
} else {
    die("ID de la langue incorrect");
}

// Pour les variables mises à jour après le bouton
if (isset($_POST['modifier'])) {
    //Pour echapper les caractères spéciaux
    $nom_langue = mysqli_real_escape_string($conn, $_POST['nom_langue']);
    $niveau_langue = mysqli_real_escape_string($conn, $_POST['niveau_langue']);
    
    //Gestion de l'image choisi
    if (isset($_FILES['image_langue']) && $_FILES['image_langue']['error'] === UPLOAD_ERR_OK) {
        $image_langue = $_FILES['image_langue']['name'];
        $image_langue = str_replace(' ', '_', $image_langue); // Remplacer les espaces par des underscores
        $image_langue = strtolower($image_langue); // Mettre le nom en minuscule

        //remplacer les caractères spéciaux
        $image_langue = str_replace(
            ['é', 'è', 'ê', 'ë', 'ô', 'ç', 'à', 'â', 'ù', "'"], 
            ['e', 'e', 'e', 'e', 'o', 'c', 'a', 'a', 'u', "_"], 
            $image_langue
        );

        //Chemin de destination
        $chemin = "../../gestion_image/" . basename($image_langue); 

        //Pour copier l'image
        if (!copy($_FILES['image_langue']['tmp_name'], $chemin)) {
            echo "<div class='alert alert-danger'>Échec de la copie de l'image.</div>";
        } else {
            //On echappe le chemin de l'image pour la bdd
            $chemin_image_bd = "gestion_image/" . mysqli_real_escape_string($conn, basename($image_langue));

            //Mise à jour de la base de données
            $sql = "UPDATE langue_info SET 
                        nom_langue='$nom_langue', 
                        niveau_langue='$niveau_langue', 
                        image_langue='$chemin_image_bd'
                    WHERE id_langue=$id_langue";
        }
    } else {
        // Mise à jour sans changer l'image
        $sql = "UPDATE langue_info SET 
                    nom_langue='$nom_langue', 
                    niveau_langue='$niveau_langue'
                WHERE id_langue=$id_langue";
    }

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>La langue a bien été modifiée.</div>";
        // Redirection après 2 secondes
        echo "<script>
        setTimeout(function(){
            window.location.href = '../admin_index.php';
        }, 2000);
        </script>";
    } else {
        echo "<div class='alert alert-danger'>Échec de la modification de la langue : " . $conn->error . "</div>";
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
    <title>Mise à jour de la Langue</title>
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
                <h2 class="text-center titre_page">Modifier la Langue</h2>
                <form action="" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_langue" value="<?php echo $id_langue; ?>">
                
                    <div class="form-group">
                        <label>Nom de la langue</label>
                        <input type="text" class="form-control" name="nom_langue" value="<?php echo htmlspecialchars($nom_langue); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Niveau de la langue</label>
                        <input type="text" class="form-control" name="niveau_langue" value="<?php echo htmlspecialchars($niveau_langue); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Image de la langue</label>
                        <input type="file" class="form-control" name="image_langue">
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
