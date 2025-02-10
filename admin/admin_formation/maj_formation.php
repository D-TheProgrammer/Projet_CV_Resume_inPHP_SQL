<?php
//Connexion a la base de donen
$nom_serv = "localhost";
$username = "root";
$mdp = "";
$nom_bdd = "site_cv";

$conn = new mysqli($nom_serv, $username, $mdp, $nom_bdd);

//Reccupere l'Id de formation depuis l'URL
$id_formation = $_GET['maj_id_formation'];

//Vérification de si l'id est valide
if ($id_formation > 0) {
    //pour récupérer les informations avec l'ID spécifique
    $sql = "SELECT * FROM formation_info WHERE id_formation = $id_formation";
    $result = $conn->query($sql);

    $row = $result->fetch_assoc();
    $nom_formation = $row['nom_formation'];
    $lieu_formation = $row['lieu_formation'];
    $description_formation = $row['description_formation'];
   
} else {
    die("ID de formation incorerect");
}

// Pour les variables mises à jour après le bouton
if (isset($_POST['modifier'])) {
    //EscapeString pour les caractères spéciaux et éviter les erreurs SQL
    $nom_formation = mysqli_real_escape_string($conn, $_POST['nom_formation']);
    $lieu_formation = mysqli_real_escape_string($conn, $_POST['lieu_formation']);
    $description_formation = mysqli_real_escape_string($conn, $_POST['description_formation']);

    //Mise a jour de la base de données
    $sql = "UPDATE formation_info SET 
                nom_formation='$nom_formation', 
                lieu_formation='$lieu_formation', 
                description_formation='$description_formation' 
            WHERE id_formation=$id_formation";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>La formation a bien été modifiée.</div>";
        // Redirection après 2 secondes
        echo "<script>
        setTimeout(function(){
            window.location.href = '../admin_index.php';
        }, 2000);
        </script>";
    } else {
        echo "<div class='alert alert-danger'>Échec de la modification de la formation : " . $conn->error . "</div>";
    }
}

//Si on veut quitter
if (isset($_POST['quitter'])) {
        echo "<div class='alert alert-danger'>RIEN n'a été modifié </div>";
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
    <title>Mise à jour de la Formation</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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

                <h2 class="text-center titre_page">Modifier la Formation</h2>
                <form action="" method="POST">
                    <input type="hidden" name="id_formation" value="<?php echo $id_formation; ?>">

                    <div class="form-group">
                        <label>Nom de la Formation</label>
                        <input type="text" class="form-control" name="nom_formation" value="<?php echo htmlspecialchars($nom_formation); ?>">
                    </div>

                    <div class="form-group">
                        <label>Lieu de la Formation</label>
                        <input type="text" class="form-control" name="lieu_formation" value="<?php echo htmlspecialchars($lieu_formation); ?>">
                    </div>

                    <div class="form-group">
                        <label>Description de la Formation</label>
                        <textarea class="form-control" name="description_formation" rows="4" ><?php echo htmlspecialchars($description_formation); ?></textarea>
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
