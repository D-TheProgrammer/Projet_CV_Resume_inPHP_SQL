<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Projets</title>
    <style>
        /*Styles pour le tableau*/
        table {
            width: 100%;
            border-collapse: collapse; /*ca Fusionne les bordures qui sont colées */
            margin-top: 20px;
        }

        /*Les bordures sachant que tout a gauche et droit il n'y a pas de bordure */
        th, td {
            border: 1px solid #ddd; 
            padding: 8px;
        }

        th:first-child, td:first-child {
            border-left: 0; 
            padding: 8px;
        }

        th:last-child, td:last-child {
            border-right: 0; 
            padding: 8px;
        }


        /*Fond gris pour la première ligne*/
        thead {
            background-color: #f2f2f2; 
        }

        th, td {
            text-align: left;
        }

        td {
            word-break: break-word; /*retour à la ligne pour les long mots*/
            white-space: normal; /*retours à la ligne automatique*/
        }

        /*espacement entre les lignes */
        tr:not(:first-child) {
            border-top: 1px solid #ddd;
        }

        #btn_ajout {
            float: right;
            margin-top: 20px;
        }

        
    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>

<div class="table-responsive">
        <h1 class="text-center">Informations Projets</h1>

        <!--Bouton Ajouter un Projet -->
        <a href='admin_projet/ajout_projet.php' id="btn_ajout" class="btn btn-success btn-sm">Ajouter un Projet</a>

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom du Projet</th>
                    <th>Image du Projet</th>
                    <th>Description du Projet</th>
                    <th>Lien du Projet</th>
                    <th>Couleur du Projet</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

            <?php
                //Connexion à la base de données
                $nom_serv = "localhost";
                $username = "root";
                $mdp = "";
                $nom_bdd = "site_cv";

                $conn = new mysqli($nom_serv, $username, $mdp, $nom_bdd);

                // Vérification de la connexion
                if ($conn->connect_error) {
                    die("Échec de la connexion : " . $conn->connect_error);
                }

                // Récupération des données de la table projet_info
                $sql = "SELECT * FROM projet_info";
                $result = $conn->query($sql);

                // Affichage des données dans le tableau
                while ($row = $result->fetch_assoc()) {
                    $id_projet = $row['id_projet'];
                    $nom_projet = $row['nom_projet'];
                    $image_projet = $row['image_projet'];
                    $description_projet = $row['description_projet'];
                    $lien_projet = $row['lien_projet'];
                    $couleur_projet = $row['couleur_projet'];
                    
                    
                    //Limitation du texte du lien a 30 caractères
                    $lien_affiche = strlen($lien_projet) > 50 ? substr($lien_projet, 0, 50) . '...' : $lien_projet;

                    // Affichage des informations dans le tableau
                    echo "<tr>
                            <td>{$id_projet}</td>
                            <td>{$nom_projet}</td>
                            <td><img src='../{$image_projet}' style='width: 100px; height: auto;'></td>
                            <td>{$description_projet}</td>
                            <td><a href='{$lien_projet}' target='_blank'>{$lien_affiche}</a></td>
                            <td>{$couleur_projet}</td>
                            <td>
                                <a href='admin_projet/maj_projet.php?maj_id_projet={$id_projet}' class='btn btn-primary btn-sm'>Mettre à Jour</a>
                                <a href='admin_projet/effacer_projet.php?effacer_id_projet={$id_projet}' class='btn btn-danger btn-sm'>Effacer</a>
                            </td>
                        </tr>";
                }

                // Fermeture de la connexion
                $conn->close();
            ?>
            </tbody>
        </table>
    </div>


</body>
</html>
