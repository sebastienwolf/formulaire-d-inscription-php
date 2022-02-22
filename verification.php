
  
<?php
session_start();
$db = new PDO('mysql:host=localhost;dbname=sebquizz', 'sebastien', 'sebastien')
   or die('could not connect to database');




if (isset($_POST['pseudo']) && isset($_POST['password'])) {
   // connexion à la base de données


   // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
   // pour éliminer toute attaque de type injection SQL et XSS
   $username = $_POST['pseudo'];
   $password = $_POST['password'];
   // si les chant du formulaire ne sont vide on continue
   if ($username !== "" && $password !== "") {
      // prepare la requete dans une variable pour appeler la donnée (1 seul ligne viendra)
      $sql = $db->prepare("SELECT * FROM user where pseudo = :username ");
      // execution de la requete
      $sql->execute(["username" => $username]);
      // transformer le retour en tableau
      $reponse = $sql->fetchAll();
      // vérification du mot de passe en variable
      $verifPwd = password_verify($password, $reponse[0]['mdp']);

      // si le mot de passe et pseudo alors on continue
      if ($verifPwd == true && $username == $reponse[0]['pseudo']) // nom d'utilisateur et mot de passe correctes
      {
         $_SESSION['pseudo'] = $username;
         header('Location: principale.php');
      } else {
         header('Location: index.php?erreur=1'); // utilisateur ou mot de passe incorrect
      }
   } else {
      header('Location: index.php?erreur=2'); // utilisateur ou mot de passe vide
   }
} else {
   header('Location: index.php');
}
