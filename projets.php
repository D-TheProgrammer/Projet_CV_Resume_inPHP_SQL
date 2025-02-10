<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            /* Style pour la div principale */
            .projets {
                display: flex; 
                justify-content: space-between; /*espasce entre le texte à gauche et l'image à droite*/
                padding: 20px; 
                border-radius: 15px;           
                background-color: #f4f4f4;
                width: 90%;
                max-width: 800px;
                margin: 20px auto;             
            }

            /*le nom du projet*/
            .nom_projet {
                font-size: 2em;
                margin: 0;
                text-align: left;
            }

            /*Style pour la description*/
            .description {
                margin-top: 10px;
                text-align: left;
            }

            /*bloc avec les textes*/
            .projet_texte {
                max-width: 70%;  /* place pour l'image */
            }

            /*image projet*/
            .projets img {
                width: 150px; 
                height: auto;
                border-radius: 10px;
            }


            a {
                text-decoration: none; /*retire le soulignement*/
                color: inherit; /*garde la couleur du parent */
            }
            
        </style>
    </head>



    <body>

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
            

            echo "
                <a href='{$lien_projet}'>
                    <div class='projets' style='border-left: 5px solid {$couleur_projet};'> 
                        <div class='projet_texte'>
                            <h1 class='nom_projet'>{$nom_projet}</h1>
                            <p class='description'>{$description_projet}</p>
                        </div>
                        <img src='{$image_projet}' alt='Image du projet'>
                    </div>
                </a>
            ";
        
            }

        $conn->close();    
    ?>

       

    </body>
</html>
