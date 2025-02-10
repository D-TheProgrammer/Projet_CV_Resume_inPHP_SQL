<!DOCTYPE html>
<html lang="fr">

<?php
    //Connexion a la base de donen
    $nom_serv = "localhost";
    $username = "root";
    $mdp = "";
    $nom_bdd = "site_cv";

    $conn = new mysqli($nom_serv, $username, $mdp, $nom_bdd);

    //info utilisateur avec l'ID 1
    $id = 1;
    $sql = "SELECT * FROM personne_info WHERE id = $id";
    $result = $conn->query($sql);

    $row = $result->fetch_assoc();
    $nom = $row['nom'];
    $prenom = $row['prenom'];
    $nationalite = $row['nationalite'];
    $numero = $row['numero'];
    $email = $row['email'];
    $linkedin = $row['linkedin'];
    $adresse = $row['adresse'];
    $github = $row['github'];
    $profil = $row['profil'];
    $date_naissance = $row['date_naissance'];
    $couleur_cv = $row['couleur_cv']; 

    $conn->close();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        h1 {
            text-align: center;
            font-size: 2.5em;
            margin-bottom: 20px;
            color: <?php echo $couleur_cv; ?> ;
        }

        .categorie {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin: 10px 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .categorie:hover {
            transform: scale(1.02); /*changement de la taille */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            border-left: 5px solid <?php echo $couleur_cv; ?> ;
        }

        h2 {
            font-size: 1.5em;
            margin: 0;
            color: #333;
        }

        .categorie p {
            font-size: 1.2em;
            margin: 5px 0;
            color: #555;
        }
    </style>
</head>


    
<body>

    <h1>Contacts</h1>

    <div class="categorie">
        <h2>Email</h2>
        <p><?php echo $email; ?></p>
    </div>

    <div class="categorie">
        <h2>Numéro</h2>
        <p><?php echo $numero; ?></p>
    </div>

    <div class="categorie">
        <h2>Github</h2>
        <p><?php echo $github; ?></p>
    </div>

    <div class="categorie">
        <h2>Linkedin</h2>
        <p><?php echo $linkedin; ?></p>
    </div>

    <div class="categorie">
        <h2>Adresse</h2>
        <p><?php echo $adresse; ?></p>
    </div>


</body>

</html>