<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Formations</title>
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
        <h1 class="text-center">Informations Formations</h1>

        <a href='admin_formation/ajout_formation.php?ajout_id_formation={$id_formation}' id="btn_ajout" class="btn btn-success btn-sm">Ajouter une Formation</a>
        
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom de la Formation</th>
                    <th>Lieu de la Formation</th>
                    <th>Description de la Formation</th>
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

                //pour récupérer les données de la table formation_info
                $sql = "SELECT * FROM formation_info";
                $result = $conn->query($sql);
            

                //Pour afficher les données dans la table
                while ($row = $result->fetch_assoc()) {
                    $id_formation = $row['id_formation'];
                    $nom_formation = $row['nom_formation'];
                    $lieu_formation = $row['lieu_formation'];
                    $description_formation = $row['description_formation'];

                    //Affichage des informations dans le tableau
                    echo "<tr>
                            <td>{$id_formation}</td>
                            <td>{$nom_formation}</td>
                            <td>{$lieu_formation}</td>
                            <td>{$description_formation}</td>
                            <td>
                                <a href='admin_formation/maj_formation.php?maj_id_formation={$id_formation}' class='btn btn-primary btn-sm'>Mettre à Jour</a>
                                
                                <a href='admin_formation/effacer_formation.php?effacer_id_formation={$id_formation}' class='btn btn-danger btn-sm'>Effacer</a>
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
