<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Compétences et Langues</title>
    <style>
        /* Styles pour les tableaux */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        /*tête du tableau en gris */
        thead {
            background-color: #f2f2f2;
        }

        /*Retour à la ligne automatique*/
        td {
            word-break: break-word;
            white-space: normal;
        }

        .container {
            display: flex;
            justify-content: space-between;
            gap: 20px; /*espace entre les deux tableaux */
        }

        /*pour chaque tableau (compétences et langues) */
        .table-container {
            width: 48%;
        }

        .btn_ajout {
            float: right;
            margin-top: 20px;
        }

        /*Media query pour les petits écrans donc mettre en verticale */
        @media (max-width: 768px) {
            .container {
                flex-direction: column; /*Les tableau se mette un sous l'autre */
            }

            .table-container {
                width: 100%; /*Chaque tableau prend toute la largeur */
            }
        }
    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>

<div class="container">
    <div class="table-container">
        <h1 class="text-center">Compétences</h1>
        <a href='admin_langue_compe/ajout_competence.php' class="btn btn-success btn-sm btn_ajout">Ajouter une Compétence</a>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom de la Compétence</th>
                    <th>Niveau de la Compétence</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

            <?php
                // Connexion à la base de données
                $nom_serv = "localhost";
                $username = "root";
                $mdp = "";
                $nom_bdd = "site_cv";
                $conn = new mysqli($nom_serv, $username, $mdp, $nom_bdd);

                if ($conn->connect_error) {
                    die("Échec de la connexion : " . $conn->connect_error);
                }

                $sql = "SELECT * FROM competence_info";
                $result = $conn->query($sql);

                while ($row = $result->fetch_assoc()) {
                    $id_competence = $row['id_competence'];
                    $nom_competence = $row['nom_competence'];
                    $niveau_competence = $row['niveau_competence'];
                    $image_competence = $row['image_competence'];

                    echo "<tr>
                                <td>{$id_competence}</td>
                                <td>{$nom_competence}</td>
                                <td>{$niveau_competence}</td>
                                <td><img src='../{$image_competence}' width='50' height='50'></td>

                                <td>
                                    <a href='admin_langue_compe/maj_competence.php?maj_id_competence={$id_competence}' class='btn btn-primary btn-sm'>Mettre à Jour</a>
                                    <a href='admin_langue_compe/effacer_competence.php?effacer_id_competence={$id_competence}' class='btn btn-danger btn-sm'>Effacer</a>
                                </td>
                            </tr>";
                    }

                $conn->close();
                
            ?>

            </tbody>
        </table>
    </div>

    
    <!-- Tableau des langues -->
    <div class="table-container">
        <h1 class="text-center">Langues</h1>
        <a href='admin_langue_compe/ajout_langue.php' class="btn btn-success btn-sm btn_ajout">Ajouter une Langue</a>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom de la Langue</th>
                    <th>Niveau de la Langue</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

            <?php
                // Connexion à la base de données
                $nom_serv = "localhost";
                $username = "root";
                $mdp = "";
                $nom_bdd = "site_cv";
                $conn = new mysqli($nom_serv, $username, $mdp, $nom_bdd);

                if ($conn->connect_error) {
                    die("Échec de la connexion : " . $conn->connect_error);
                }

                $sql = "SELECT * FROM langue_info";
                $result = $conn->query($sql);

                while ($row = $result->fetch_assoc()) {
                    $id_langue = $row['id_langue'];
                    $nom_langue = $row['nom_langue'];
                    $niveau_langue = $row['niveau_langue'];
                    $image_langue = $row['image_langue'];

                    echo "<tr>
                            <td>{$id_langue}</td>
                            <td>{$nom_langue}</td>
                            <td>{$niveau_langue}</td>
                            <td><img src='../{$image_langue}' width='50' height='50'></td>
                            <td>
                                <a href='admin_langue_compe/maj_langue.php?maj_id_langue={$id_langue}' class='btn btn-primary btn-sm'>Mettre à Jour</a>
                                <a href='admin_langue_compe/effacer_langue.php?effacer_id_langue={$id_langue}' class='btn btn-danger btn-sm'>Effacer</a>
                            </td>
                        </tr>";
                }

                $conn->close();
            ?>

            </tbody>
        </table>
    </div>

</div>

</body>
</html>
