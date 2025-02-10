<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Experiences</title>
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

        /*espacement entre les lignes */
        tr:not(:first-child) {
            border-top: 1px solid #ddd;
        }

        /* Style pour le bouton "Ajouter une Formation" */
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
        <h1 class="text-center">Informations Experiences</h1>

        <a href='admin_experience/ajout_experience.php?ajout_id_experience={$id_experience}' id="btn_ajout" class="btn btn-success btn-sm">Ajouter une Expérience</a>

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom de l'Experience</th>
                    <th>Lieu de l'Experience</th>
                    <th>Description de l'Experience</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

            <?php
                //Connexion a la base de donen
                $nom_serv = "localhost";
                $username = "root";
                $mdp = "";
                $nom_bdd = "site_cv";

                $conn = new mysqli($nom_serv, $username, $mdp, $nom_bdd);

                // pour récupérer les données de la table experience_info
                $sql = "SELECT * FROM experience_info";
                $result = $conn->query($sql);

                //Pour afficher les données dans la table
                while ($row = $result->fetch_assoc()) {
                    $id_experience = $row['id_experience'];
                    $nom_experience = $row['nom_experience'];
                    $date_experience = $row['date_experience'];
                    $description_experience = $row['description_experience'];

                    //Affichage des informations dans le tableau
                    echo "<tr>
                            <td>{$id_experience}</td>
                            <td>{$nom_experience}</td>
                            <td>{$date_experience}</td>
                            <td>{$description_experience}</td>
                            <td>
                                <a href='admin_experience/maj_experience.php?maj_id_experience={$id_experience}' class='btn btn-primary btn-sm'>Mettre à Jour</a>
                                
                                <a href='admin_experience/effacer_experience.php?effacer_id_experience={$id_experience}' class='btn btn-danger btn-sm'>Effacer</a>
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
