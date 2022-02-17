<?php
session_start();
if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['age']) && isset($_POST['pseudo']) && isset($_POST['mail']) && isset($_POST['password']))
{
    // connexion à la base de données
    $db_username = 'sebastien';
    $db_password = 'sebastien';
    $db_name     = 'QUIZZ';
    $db_host     = 'localhost';
    $db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
           or die('could not connect to database');
    
    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    $userNom = mysqli_real_escape_string($db,htmlspecialchars($_POST['nom'])); 
    $userPrenom = mysqli_real_escape_string($db,htmlspecialchars($_POST['prenom']));
    $userAge = mysqli_real_escape_string($db,htmlspecialchars($_POST['age']));
    $userPseudo = mysqli_real_escape_string($db,htmlspecialchars($_POST['pseudo']));
    $userMail = mysqli_real_escape_string($db,htmlspecialchars($_POST['mail']));
    $userPassword = mysqli_real_escape_string($db,htmlspecialchars($_POST['password']));


    
    if($userNom !== "" && $userPrenom !== "" && $userAge !== "" && $userPseudo !== "" && $userMail !== "" && $userPassword !== "")
    {
        $requete = "INSERT INTO User (idUser, nom, prenom, age, pseudo, mail, mdp) VALUES
        (DEFAULT, '$userNom', '$userPrenom', '$userAge', '$userPseudo', '$userMail', '$userPassword')";
               
        if (!mysqli_query ($db, $requete))
        {
            header('Location: login.php?erreur=4');
        }
        else
        {
            header('Location: principale.php');
        }
    }
    else
    {
       header('Location: login.php?erreur=3'); 
    }
}
else
{
   header('Location: login.php');
}

?>