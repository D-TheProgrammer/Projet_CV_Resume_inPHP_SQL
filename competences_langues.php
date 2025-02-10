<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
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

        //On recupere la couleur depuis la table personne_info
        $sql = "SELECT couleur_cv FROM personne_info WHERE id = 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $couleur_cv = $row['couleur_cv']; 
        } else {
            $couleur_cv = "#007BFF"; //Couleur si aucune couleur n'est trouvee
        }

        $conn->close();
    ?>

    <style>

        /*pour le titre de la section */
        h2 {
            font-size: 2em;
            font-weight: bold;
            text-decoration: underline;
            text-align: center; 
            margin-bottom: 20px;
        }

        /*div pour les compétences et les langues */
        .competences, .langues {
            display: flex;
            justify-content: center; 
            flex-wrap: wrap; 
            gap: 30px; /*Espace entre les élément*/
            margin-bottom: 40px; 
        }

        /*Pour chaque compétence et langue uniquee */
        .competence_unique, .langue_unique {
            text-align: center; 
            width: 150px; 
            transition: transform 0.3s, box-shadow 0.3s; /*transition pour les effets*/
        }

        /*Pour le logo des compétence et langue unique */
        .competence_unique img, .langue_unique img {
            max-width: 100px; 
            max-height: 100px; 
            width: auto; 
            height: auto;
            margin-bottom: 10px;
        }

        .competence_unique p, .langue_unique p {
            font-style: italic;
            margin: 0; 
        }

        /*Pour les niveau specifique des langues*/
        .langue_unique .niveau {
            color: <?php echo $couleur_cv; ?> 
        }

        /*Effet hover pour les compétences*/
        .competence_unique:hover, .langue_unique:hover {
            transform: scale(1.05); /* petite augmentation de la taille*/
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); /* Ombre*/
            background-color: #e0e0e0; /*change la couleur de fond*/
            border-radius: 8px; 
        }
    </style>
</head>



<body>

    <h2>Mes Compétences</h2>
  
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


        echo "<div class='competences'>";

        while ($row = $result->fetch_assoc()) {
            $id_competence = $row['id_competence'];
            $nom_competence = $row['nom_competence'];
            $niveau_competence = $row['niveau_competence'];
            $image_competence = $row['image_competence'];

            echo "
                <div class='competence_unique'>
                    <img src='{$image_competence}'>
                    <p>{$nom_competence}</p>
                </div>
            
            <tr>  ";
            }

        echo "</div>" ;



        echo  "<h2>Mes Langues</h2>" ; 

        $sql = "SELECT * FROM langue_info";
        $result = $conn->query($sql);

        echo "<div class='langues'>";

        while ($row = $result->fetch_assoc()) {
            $id_langue = $row['id_langue'];
            $nom_langue = $row['nom_langue'];
            $niveau_langue = $row['niveau_langue'];
            $image_langue = $row['image_langue'];

            echo "
                <div class='langue_unique'>
                    <img src='{$image_langue}'>
                    <p>{$nom_langue}</p>
                    <p class='niveau'>{$niveau_langue}</p>
                </div>
            
            <tr>  ";
            }

            echo "</div>" ;

        $conn->close();    
    ?>

</body>
</html>
