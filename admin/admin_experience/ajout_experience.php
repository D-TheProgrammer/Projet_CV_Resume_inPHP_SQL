<?php
//Connexion a la base de donen
$nom_serv = "localhost";
$username = "root";
$mdp = "";
$nom_bdd = "site_cv";

$conn = new mysqli($nom_serv, $username, $mdp, $nom_bdd);

// Pour les variables mises à jour après le bouton
if (isset($_POST['modifier'])) {
    //EscapeString pour les caractères spéciaux et éviter les erreurs SQL
    $nom_experience = mysqli_real_escape_string($conn, $_POST['nom_experience']);
    $date_experience = mysqli_real_escape_string($conn, $_POST['date_experience']);
    $description_experience = mysqli_real_escape_string($conn, $_POST['description_experience']);

    //Mise a jour de la base de données
    $sql = "INSERT experience_info SET 
                nom_experience='$nom_experience', 
                date_experience='$date_experience', 
                description_experience='$description_experience' 
                ";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>L'experience a bien été modifiée.</div>";
        // Redirection après 2 secondes
        echo "<script>
        setTimeout(function(){
            window.location.href = '../admin_index.php';
        }, 2000);
        </script>";
    } else {
        echo "<div class='alert alert-danger'>Échec de la modification de l'experience : " . $conn->error . "</div>";
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
    <title>Mise à jour de l'experience</title>
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

                <h2 class="text-center titre_page">Modifier l'experience</h2>
                <form action="" method="POST">
                    <input type="hidden" name="id_experience" value="<?php echo $id_experience; ?>">

                    <div class="form-group">
                        <label>Nom de l'Experience</label>
                        <input type="text" class="form-control" name="nom_experience"; ?>
                    </div>

                    <div class="form-group">
                        <label>Date de l'Experience</label>
                        <input type="number" class="form-control" name="date_experience"; ?>
                    </div>

                    <div class="form-group">
                        <label>Description de l'Experience</label>
                        <textarea class="form-control" name="description_experience" rows="4" ></textarea>
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
