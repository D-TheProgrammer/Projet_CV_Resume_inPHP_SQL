<?php
//Connexion à la base de données
$nom_serv = "localhost";
$username = "root";
$mdp = "";
$nom_bdd = "site_cv";

$conn = new mysqli($nom_serv, $username, $mdp, $nom_bdd);

//Vérification de la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

if (isset($_POST['ajouter'])) {

    $nom_competence = mysqli_real_escape_string($conn, $_POST['nom_competence']);
    $niveau_competence = mysqli_real_escape_string($conn, $_POST['niveau_competence']);
    
    //Gestion de l'image téléchargée
    $image_competence = $_FILES['image_competence']['name'];
    $image_competence = str_replace(' ', '_', $image_competence); // Remplacer les espaces par des underscores
    $image_competence = strtolower($image_competence); // Mettre le nom en minuscule

    //on remplace les caracteres spéciaux
    $image_competence = str_replace(
        ['é', 'è', 'ê', 'ë', 'ô', 'ç', 'à', 'â', 'ù',"'"], 
        ['e', 'e', 'e', 'e', 'o', 'c', 'a', 'a', 'u',"_"], 
        $image_competence
    );

    //Chemin de destination
    $chemin = "../../gestion_image/" . basename($image_competence); 

    //Pour copier l'image
    if (copy($_FILES['image_competence']['tmp_name'], $chemin)) {
        
        //on echapper le chemin de l'image pour la bdd
        $chemin_image_bd = "gestion_image/" . mysqli_real_escape_string($conn, basename($image_competence));
     
        $sql = "INSERT INTO competence_info SET 
                    nom_competence = '$nom_competence',
                    niveau_competence = '$niveau_competence',
                    image_competence = '$chemin_image_bd'
                ";

        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success'>La compétence a bien été ajoutée.</div>";
            echo "<script>
                setTimeout(function(){
                    window.location.href = '../admin_index.php';
                }, 2000);
            </script>";
        } else {

            echo "<div class='alert alert-danger'>Échec de l'ajout de la compétence : " . $conn->error . "</div>";
        }
    } else {
        //message d'erreur si problème avec la copie de l'image
        echo "<div class='alert alert-danger'>Échec de la copie de l'image.</div>";
    }
}

if (isset($_POST['quitter'])) {
    echo "<div class='alert alert-danger'>RIEN n'a été modifié.</div>";
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
    <title>Ajout d'une Compétence</title>
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
                <h2 class="text-center titre_page">Ajout d'une Compétence</h2>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nom de la compétence</label>
                        <input type="text" class="form-control" name="nom_competence" >
                    </div>

                    <div class="form-group">
                        <label>Niveau de la compétence</label>
                        <input type="number" class="form-control" name="niveau_competence" min="1" max="5" >
                    </div>

                    <div class="form-group">
                        <label>Image de la compétence</label>
                        <input type="file" class="form-control" name="image_competence" >
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
