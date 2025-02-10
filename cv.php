<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cv_style.php"> 
</head>

<?php
    //Connexion à la base de données
    $nom_serv = "localhost";
    $username = "root";
    $mdp = "";
    $nom_bdd = "site_cv";
    $conn = new mysqli($nom_serv, $username, $mdp, $nom_bdd);

    if ($conn->connect_error) {
        die("Échec de la connexion : " . $conn->connect_error);
    }

    // Récupération des informations personnelles et profil
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
    $diplome_profil = $row['diplome_profil'];
?>

<body>
    <div class="cv">
        
        <!-- Section en header avec la section Profil et le Presentation -->
        <div class="bloc_profil_header">
            <!-- Section Profil -->
            <section class="profil">
                <h2>Profil</h2>
                <p><?php echo $profil; ?></p>
            </section>
        
            <!-- Bloc de Presentation avec les bandes latérale -->    
            <div class="bloc_header">
                <div class="header">
                    <h1><?php echo $nom; ?></h1>
                    <h1><?php echo $prenom; ?></h1>
                    <p>Né: <?php echo $date_naissance; ?></p>
                    <p>Nationalité: <?php echo $nationalite; ?></p>
                    <h2>DEVELOPPEUR</h2>
                    <h2>POLYVALENT</h2>
                </div>
        
                <!--Les trois bandes laterales à droite-->
                <div class="bande_laterale">
                    <div class="bande_unique"></div>
                    <div class="bande_unique"></div>
                    <div class="bande_unique"></div>
                    <div class="bande_unique"></div>
                </div>
            </div>
        </div>

        <!--Second Bloc au milieu avec les formations et les expériences-->
        <div class="bloc_forma_expe">
            
            <!-- Formation  -->
            <section class="formations">
                <h2>FORMATIONS</h2>

                <?php
                    $sql = "SELECT * FROM formation_info";
                    $result = $conn->query($sql);

                    while ($row = $result->fetch_assoc()) {
                        echo "
                        <div class='ecole'>
                            <h3>{$row['nom_formation']}</h3>
                            <p>{$row['lieu_formation']}</p>
                            <ul>
                                <li>{$row['description_formation']}</li>
                            </ul>
                        </div>
                        <br>
                        ";
                    }
                ?>
            </section>

            <!-- Les expériences pro ou les projet Universitaire -->
            <section class="experiences">
                <h2>EXPERIENCES</h2>
                <div class="projet">
                    <h3>Projets Universitaires</h3>

                    <?php
                        //On reccupere les experiences
                        $sql = "SELECT * FROM experience_info";
                        $result = $conn->query($sql);

                        while ($row = $result->fetch_assoc()) {
                            echo "
                            <p>{$row['date_experience']} : {$row['nom_experience']}</p>
                            <ul>
                                <li>{$row['description_experience']}</li>
                            </ul>";
                        }
                    ?>
                </div>
            </section>
        </div>


        <!-- Bloc composé de 2 sections verticales à gauche et 1 section à droite -->
        <div class="bloc_comp_lang_dip">

            <!-- Section Langue et Diplôme -->
            <div class="langue_diplome">
                
                <!-- Section Langues -->
                <section class="langues">
                    <h2>LANGUES</h2>
                    <ul class="liste_sans_puce">
                        <?php
                            $sql = "SELECT * FROM langue_info";
                            $result = $conn->query($sql);

                            while ($row = $result->fetch_assoc()) {
                                echo "
                                <li>
                                    <div class='sous_langue'>
                                        <img src='{$row['image_langue']}' class='icone'>
                                        <span>{$row['nom_langue']} - {$row['niveau_langue']}</span>
                                    </div>
                                </li>";
                            }
                        ?>
                    </ul>
                </section>

                <!-- Section Diplôme -->
                <section class="diplome">
                    <h2>DIPLÔME</h2>
                    <div>
                        <ul>
                            <li><?php echo "{$diplome_profil}"; ?></li>
                        </ul>
                    </div>
                </section>
            </div>

            <!-- Section Compétences -->
            <section class="competences">
                <h2>COMPETÉNCES</h2>
                <ul class="liste_sans_puce">
                    <?php
                        $sql = "SELECT * FROM competence_info";
                        $result = $conn->query($sql);

                        while ($row = $result->fetch_assoc()) {
                            $niveau = $row['niveau_competence'];
                            echo "
                            <li>
                                <div class='competence_unique'>
                                    <img src='{$row['image_competence']}'  class='icone'>
                                    <span>{$row['nom_competence']}</span>
                                    <div class='liste_rond_note'>";
                            
                            //Boucle pour afficher les "rond_note plein"
                            for ($i = 0; $i < $niveau; $i++) {
                                echo "<div class='rond_note plein'></div>";
                            }

                            //Boucle pour compléter avec des "rond_note vide" jusqu'à 5
                            for ($i = $niveau; $i < 5; $i++) {
                                echo "<div class='rond_note vide'></div>";
                            }

                            echo "
                                    </div>
                                </div>
                            </li>";
                        }
                    ?>
                </ul>
            </section>
  
        
        </div>

        <!-- Footer -->
        <section class="footer">
            <div class="zone_bleu">
                <!-- Adresse -->
                <div class="footer-item" id="premier_footer">
                    <img src="img/position.png">
                    <p><?php echo $adresse; ?></p>
                </div>
        
                <!-- Téléphone -->
                <div class="footer-item">
                    <img src="img/phone.jpg">
                    <p><?php echo $numero; ?></p>
                </div>
        
                <!-- LinkedIn -->
                <div class="footer-item">
                    <img src="img/linkedin.png">
                    <p><a href="<?php echo $linkedin; ?>">LinkedIn</a></p>
                </div>
        
                <!-- Email -->
                <div class="footer-item">
                    <img src="img/mail.png">
                    <p><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></p>
                </div>
        
                <!-- GitHub -->
                <div class="footer-item">
                    <img src="img/github.png">
                    <p><a href="<?php echo $github; ?>">GitHub</a></p>
                </div>
            </div>
        </section>
    </div>
</body>
</html>
