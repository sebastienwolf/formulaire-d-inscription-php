<?php
session_start();
if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['age']) && isset($_POST['pseudo']) && isset($_POST['mail']) && isset($_POST['password'])) {
    // connexion à la base de données
    $db = new PDO('mysql:host=localhost;dbname=sebquizz', 'sebastien', 'sebastien')
        or die('could not connect to database');


    // prépare nos variable d'entré
    $userNom = $_POST['nom'];
    $userPrenom = $_POST['prenom'];
    $userAge = $_POST['age'];
    $userPseudo = $_POST['pseudo'];
    $userMail = $_POST['mail'];
    $userPassword = $_POST['password'];

    $option = ['cost' => 12,];
    $hash = password_hash($userPassword, PASSWORD_BCRYPT, $option);

    if ($userNom !== "" && $userPrenom !== "" && $userAge !== "" && $userPseudo !== "" && $userMail !== "" && $userPassword !== "") {
        // prepare la requete
        $requete = $db->prepare("SELECT pseudo FROM user where pseudo = :userPseu");
        // execution de la requete  
        $requete->execute(["userPseu" => $userPseudo]);
        /// transformer le retour en tableau 
        $reponse = $requete->fetchAll();
        // vérification du mot de passe en variable 
        $verifPseudo = count($reponse);


        if ($verifPseudo == 0) {
            // vérification si l'utilisateur existe
            $requeteInscription = "INSERT INTO user (idUser, nom, prenom, age, pseudo, mail, mdp) VALUES
        (DEFAULT, '$userNom', '$userPrenom', '$userAge', '$userPseudo', '$userMail','$hash')";
            $db->query($requeteInscription);
            $_SESSION['pseudo'] = $userPseudo;
            header('Location: principale.php');
        } else {
            header('Location: index.php?erreur=5');
        }
    } else {
        header('Location: index.php?erreur=3');
    }
} else {
    header('Location: index.php');
}
