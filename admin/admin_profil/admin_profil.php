
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
    $couleur_cv =  $row['couleur_cv'];
    $logo_site =  $row['logo_site'];
    $diplome_profil = $row['diplome_profil'];

    $conn->close();
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mise à jour des informations</title>
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

        .couleur_div {
            display: flex; 
            gap: 20px;
            flex-wrap: wrap;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="zone_contenu">
                
                <h2 class="text-center titre_page">Mettre à jour les Informations Personnelles</h2>
                <form action="admin_profil/maj_profil.php" method="POST" enctype="multipart/form-data">

                    <input type="hidden" name="id" value="<?php echo $id; ?>">

                    <div class="form-group">
                        <label>Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $nom; ?>" required>
                    </div>

                    <div class="form-group">
                        <label >Prénom</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $prenom; ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Nationalité</label>
                        <input type="text" class="form-control" id="nationalite" name="nationalite" value="<?php echo $nationalite; ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Numéro de téléphone</label>
                        <input type="tel" class="form-control" id="numero" name="numero" value="<?php echo $numero; ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
                    </div>

                    <div class="form-group">
                        <label>LinkedIn</label>
                        <input type="url" class="form-control" id="linkedin" name="linkedin" value="<?php echo $linkedin; ?>">
                    </div>

                    <div class="form-group">
                        <label>Adresse</label>
                        <input type="text" class="form-control" id="adresse" name="adresse" value="<?php echo $adresse; ?>">
                    </div>

                    <div class="form-group">
                        <label>GitHub</label>
                        <input type="url" class="form-control" id="github" name="github" value="<?php echo $github; ?>">
                    </div>

                    <div class="form-group">
                        <label>Profil</label>
                        <textarea class="form-control" id="profil" name="profil" rows="4" required><?php echo $profil; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Date de naissance</label>
                        <input type="date" class="form-control" id="date_naissance" name="date_naissance" value="<?php echo $date_naissance; ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Diplome Obtenu</label>
                        <textarea class="form-control" id="diplome_profil" name="diplome_profil" rows="4" required><?php echo $diplome_profil; ?></textarea>    
                    </div>

                    <div class="form-group">
                        <label>Choisir la couleur du CV :</label><br>
                        <div class="couleur_div" >
                            <input type="radio" name="couleur_cv" value="red" required>
                            <label style="color: red;">Rouge</label>

                            <input type="radio" name="couleur_cv" value="black">
                            <label  style="color: black;">Noir</label>

                            <input type="radio" name="couleur_cv" value="green">
                            <label style="color: green;">Vert</label>

                            <input type="radio" name="couleur_cv" value="blue">
                            <label style="color: blue;">Bleu</label>

                            <input type="radio"  name="couleur_cv" value="#EEEE00">
                            <label style="color: #EEEE00;">Jaune</label>

                            <input type="radio" name="couleur_cv" value="#00a1ff">
                            <label style="color: #00a1ff;">Bleu clair</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Choisir un logo pour le site</label>
                        <input type="file" class="form-control" name="logo_site">
                    </div>



                    <button type="submit" class="btn btn-success btn-block">Mettre à jour</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
