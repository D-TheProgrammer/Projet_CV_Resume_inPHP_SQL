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
    $sql = "SELECT couleur_cv FROM personne_info WHERE id = 1"; 
    $result = $conn->query($sql);

    if ($result && $row = $result->fetch_assoc()) {
        // Si la ligne existe, on récupère la couleur
        $couleur_cv = $row['couleur_cv'];
    } else {
        //Couleur si errEUR
        $couleur_cv = "#00a1ff";
    }

    $conn->close();


    header("Content-Type: text/css"); //Pour indiquer que le fichier a du contenu CSS
?>

/* GENERAL */ 
body {
    font-family: Arial, sans-serif;
    line-height: 1.4;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.cv {
    max-width: 800px;
    margin: auto;
    background: white;
    padding-left : 20px;
    padding-right: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    margin: 0;
    line-height: 1; /*pour que nom et prenom soit plus pcohe  */
    font-size: 2.5em; 
    color: <?php echo $couleur_cv; ?>;
}

p {
    margin: 5px 0;
}


h2 {
    font-size: 1.5em;
    padding-top: 2px;
    padding-bottom: 2px;
    margin-bottom: 10px;
    margin-left: -20px;
    margin-right: -20px;
    padding-left: 20px;
    padding-right: 20px;
    background: #a6a6a6;
    color: white;
}

ul {
    list-style-type: square;
    margin: 0;
    padding-left: 20px;
}


.icone{
    width: 30px; 
    height: 30px; 
    margin-right: 10px; /*Espacement entre l'icône et le texte */
}




/*Bloc du haut de la page composé du profil et du header*/

.bloc_profil_header {
    display: flex; /* alignement des sections */
    justify-content: space-between; /*Separation des deux sections */
    align-items: center; 
    padding: 0px;
}


/*bloc composé des information et des barres laterales */
.bloc_header {
    display: flex;
    margin-right: -20px;
    width: 50%;
}

.header {
    width: 80%;
    text-align: right; 
}

.header h2 {
    background: none; 
    line-height: 1;
    margin: 0;
    color: black;
    padding: 0;
}

.bande_laterale {
    height: 200px; 
    display: flex;
    padding-left: 10px; /* Séparation des bandes du header */
}

.bande_unique {
    width: 20px; /* Largeur de chaque bande */
    background-color: <?php echo $couleur_cv; ?>; 
    margin-right: 20px; /* Espacement entre les bande  */
}

.bande_unique:last-child {
    margin-right: 0; /* Pas d'espacement apres la derniere bande uniquee */
}


/* Pour le profil */
.profil {
    width: 42%; 
    height: 310px; /* Hauteur de la zone ronde  */
    background: <?php echo $couleur_cv; ?>;/* Couleur de fond bleu */
    border-radius: 0 0 160px 160px; /* Arrondissement seulement des coins inférieurs */
    text-align: center; 
    color: #f4f4f4;
    align-items: center;
}

.profil h2 {
    background: none; 
    padding-top: 10px; 
    margin: 0;
}

.profil p {
    width: 80%;
    text-align: center;
    margin: 0 auto; 
}




/*Bloc compose des formations et des experiences */
.bloc_forma_expe{
    display: flex;      
    justify-content: space-between; 
    flex-wrap: wrap;
}


.formations , .experiences {
    width: 45%;
}

/* Style pour Parcours scolaire et Projet */
.projet h3 , .ecole h3 {
    margin: 0;
    font-size: 1.2em;
    color: <?php echo $couleur_cv; ?>;
}

.projet p , .ecole p{
    font-weight: bold;
    color: #555;
}




/*Bloc milieur composer de langue et diplome ensemble sur la gauche et competence sur la droite*/
.bloc_comp_lang_dip{
    display: flex;      
    justify-content: space-between; 
    flex-wrap: wrap;
}

.langue_diplome{
    width: 45%;
}

.sous_langue {
    display: flex; 
    align-items: center; 
    margin-bottom: 10px; 
}

.competences {
    width: 45%;
    flex-wrap: wrap;
}

.competences ul, .langues ul {
    display: flex;
    flex-wrap: wrap;
}

.competences li, .langues li {
    width: 100%;
    margin-bottom: 5px;
}


.liste_sans_puce {
    list-style: none; 
    padding: 0; 
}

.competence_unique {
    display: flex;                 
    align-items: center;            
    width: 100%;            
}

.competence_unique span {
    white-space: nowrap; /*Empeche le texte de se couper*/
}
.liste_rond_note{
    display: flex;
    text-align: right;
    width: 100%; 
    justify-content: flex-end;
}

/* Pour les notes */
.rond_note {
    width: 13px;
    height: 13px;
    border-radius: 160px;
    margin-right: 6px;
    text-align: right;
}
.plein {    
    border: 2px solid <?php echo $couleur_cv; ?>;
    background-color: <?php echo $couleur_cv; ?>;
}

.vide {
    border: 2px solid #555;
    background-color: #555;
}



/*LE FOOTER */
.footer{
    padding: 0;
    margin-top: 20px;
    margin-left: -20px;
    margin-right: -20px;
    
    min-height: 100px;
    background: <?php echo $couleur_cv; ?>;

    display: flex;
    justify-content: center;
    
    align-items: center;
}

.zone_bleu {
    display: flex;
    position: center;
}


.footer-item {
    align-items: center;
    padding-right: 20px;
    padding-left: 20px;
    text-align: center;
    border-style: solid;
    border-color: white;
    border-width: 0 0 0 2px;
}

.footer #premier_footer{ 
    border-width: 0 0 0 0px;
}

.footer-item img {
    position: center;
    width: 30px; 
    height: 30px;
    margin-right: 10px; 
}

.footer-item p {
    margin: 0;
    color: white;
}

.footer-item a {
    color: white; 
    text-decoration: none;
}

.footer-item a:hover {
    text-decoration: underline;
}