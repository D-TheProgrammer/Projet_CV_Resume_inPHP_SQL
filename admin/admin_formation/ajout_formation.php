<?php
    //Connexion a la base de données
    $nom_serv = "localhost";
    $username = "root";
    $mdp = "";
    $nom_bdd = "site_cv";

    $conn = new mysqli($nom_serv, $username, $mdp, $nom_bdd);

    // Vérification de la connexion
    if ($conn->connect_error) {
        die("Échec de la connexion : " . $conn->connect_error);
    }

    // Si le formulaire est soumis
    if (isset($_POST['ajouter'])) {
        //EscapeString pour les caractères spéciaux et éviter les erreurs SQL
        $nom_formation = mysqli_real_escape_string($conn, $_POST['nom_formation']);
        $lieu_formation = mysqli_real_escape_string($conn, $_POST['lieu_formation']);
        $description_formation = mysqli_real_escape_string($conn, $_POST['description_formation']);

        // Insertion dans la base de données
        $sql = "INSERT formation_info SET 
                    nom_formation='$nom_formation', 
                    lieu_formation='$lieu_formation', 
                    description_formation='$description_formation' ";

        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success'>La formation a bien été ajoutée.</div>";
            // Redirection après 2 secondes
            echo "<script>
            setTimeout(function(){
                window.location.href = '../admin_index.php';
            }, 2000);
            </script>";
        } else {
            echo "<div class='alert alert-danger'>Échec de l'ajout de la formation : " . $conn->error . "</div>";
        }
    }

    // Si on veut quitter
    if (isset($_POST['quitter'])) {
        echo "<div class='alert alert-danger'>Aucune formation n'a été ajoutée.</div>";
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
    <title>Ajout de la Formation</title>
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

                <h2 class="text-center titre_page">Ajouter une Formation</h2>
                <form action="" method="POST">

                    <div class="form-group">
                        <label>Nom de la Formation</label>
                        <input type="text" class="form-control" name="nom_formation" >
                    </div>

                    <div class="form-group">
                        <label>Lieu de la Formation</label>
                        <input type="text" class="form-control" name="lieu_formation" >
                    </div>

                    <div class="form-group">
                        <label>Description de la Formation</label>
                        <textarea class="form-control" name="description_formation" rows="4" ></textarea>
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
