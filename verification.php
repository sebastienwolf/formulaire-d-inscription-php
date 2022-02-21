
  
<?php
session_start();
if (isset($_POST['pseudo']) && isset($_POST['password'])) {
   // connexion à la base de données
   $db_username = 'sebastien';
   $db_password = 'sebastien';
   $db_name     = 'QUIZZ';
   $db_host     = 'localhost';
   $db = mysqli_connect($db_host, $db_username, $db_password, $db_name)
      or die('could not connect to database');

   // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
   // pour éliminer toute attaque de type injection SQL et XSS
   $username = mysqli_real_escape_string($db, htmlspecialchars($_POST['pseudo']));
   $password = mysqli_real_escape_string($db, htmlspecialchars($_POST['password']));
   // si les chant du formulaire ne sont vide on continue
   if ($username !== "" && $password !== "") {
      // prepare la requete dans une variable pour appeler la donnée (1 seul ligne viendra)
      $requete = "SELECT * FROM User where 
              pseudo = '" . $username . "'";
      // execution de la requete
      $exec_requete = mysqli_query($db, $requete);
      // transformer le retour en tableau
      $reponse      = mysqli_fetch_array($exec_requete);
      // vérification du mot de passe en variable
      $verifPwd = password_verify($password, $reponse['mdp']);

      // si le mot de passe et pseudo alors on continue
      if ($verifPwd == true && $username == $reponse['pseudo']) // nom d'utilisateur et mot de passe correctes
      {
         $_SESSION['pseudo'] = $username;
         header('Location: principale.php');
      } else {
         header('Location: login.php?erreur=1'); // utilisateur ou mot de passe incorrect
      }
   } else {
      header('Location: login.php?erreur=2'); // utilisateur ou mot de passe vide
   }
} else {
   header('Location: login.php');
}
