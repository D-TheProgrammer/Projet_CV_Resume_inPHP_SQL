<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        /*Style pour la zone de logo*/
        #zone_logo {
            width: 100%;
            background-color: #333;
            color: white;
            text-align: center;
            font-size: 1.5em;
            display: flex;
            justify-content: center;
            align-items: center;    
            height: 120px;
        }
        
        /*Espace entre le logo et le texte */
        .logo_rogne {
            margin-right: 20px;
        }

        /*Style pour l'image du logo */
        .logo_rogne img {
            width: 80px;              
            height: 80px;            
            border-radius: 60%;      
            object-fit: cover;       
            overflow: hidden;    
        }
        
        /*Le texte du header*/
        .texte_header {
            text-align: left; 
            font-size: 2em; 
            padding-left: 30px; /*Espace entre le texte et le logo */
        }

        .texte_header p {
            margin: 0;        
            line-height: 1.2; /*l'espace entre les lignes */
        }

        /*Menu de navigation horizontal*/
        #menu {
            background-color: #444;
            padding: 10px 0;
            text-align: center;
        }

        #menu ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        #menu ul li {
            display: inline;
            margin: 0 15px;
        }

        #menu ul li a {
            text-decoration: none;
            color: white;
            font-weight: bold;
            padding: 10px 15px;
            border-radius: 5px;
        }

        #menu ul li a:hover {
            background-color: #555;
        }

        /* Zone de contenu */
        #zone_contenu {
            width: 100%;
            max-width: 800px;
            height: 500px;
            border: 1px solid #ccc;
            overflow: auto;
            padding: 10px;
            box-sizing: border-box;
            margin: 20px auto;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

    </style>
</head>
<body>


<?php
    //Connexion à la base de données
    $nom_serv = "localhost";
    $username = "root";
    $mdp = "";
    $nom_bdd = "site_cv";

    $conn = new mysqli($nom_serv, $username, $mdp, $nom_bdd);

    //Verifier la connexion
    if ($conn->connect_error) {
        die("Connexion échouée : " . $conn->connect_error);
    }

    //On Recupere des données de la table personne_info
    $sql = "SELECT nom, prenom, logo_site FROM personne_info WHERE id = 1"; 
    $result = $conn->query($sql);



    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nom = $row['nom'];
        $prenom = $row['prenom'];
        $logo_site = $row['logo_site'];
    } else {
        echo "Aucun utilisateur trouvé.";
    }

    $conn->close();
?>

    <!-- Div pour le logo centré -->
    <div id="zone_logo" class="logo_rogne">
        <img src="<?php echo $logo_site; ?>"> 
        <div class="texte_header">
            <p><?php echo strtoupper($nom); ?></p> 
            <p><?php echo strtoupper($prenom); ?></p>
        </div>
    </div>

    <!-- Menu horizontal -->
    <div id="menu">
        <ul>
            <li><a href="#" onclick="chargementPage('cv.php')">CV</a></li>

            <li><a href="#" onclick="chargementPage('projets.php')">Projets</a></li>
            
            <li><a href="#" onclick="chargementPage('competences_langues.php')">Compétences et Langues</a></li>
            <li><a href="#" onclick="chargementPage('contacts.php')">Contacts</a></li>
            <li><a href="admin/admin_index.php">Admin</a></li>
        </ul>
    </div>

    <!--Zone du contenu des autres pages dynamique -->
    <div id="zone_contenu">

    </div>


    <script>
        function chargementPage(page_html) {
            /*fetch pour charger le fichier HTML */
            fetch(page_html)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Erreur chargement des pages  : ' + response.statusText);
                    }
                    return response.text();
                })
                .then(data => {
                    //Charge le contenu dans la div
                    document.getElementById('zone_contenu').innerHTML = data;
                })
        }

        /*pour charger le CV des le chargement du site*/
        window.onload = function() {
            chargementPage('cv.php');
        };
    </script>
</body>
</html>
