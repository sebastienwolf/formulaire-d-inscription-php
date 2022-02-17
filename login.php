<html>
    <head>
       <meta charset="utf-8">
        <!-- importer le fichier de style -->
        <link rel="stylesheet" href="style.css" media="screen" type="text/css" />
    </head>
    <body>
        <div id="container">
            <button id="conneClick" class="login" data-info="connection">connection</button>
            <button id="insClick" class="login" data-info="inscription">inscription</button>
            <!-- zone de connexion -->
            <div class="connection" id="connection">
            <form action="verification.php" method="POST">
                <h2>Connexion</h2>
                
                <label><b>Nom d'utilisateur</b></label>
                <input type="text" placeholder="Entrer le nom d'utilisateur" name="pseudo" required>

                <label><b>Mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="password" required>

                <input type="submit" id='submit' value='LOGIN' >
                </form>

                </div>


                    <div class="inscription" id="inscription">
                    <form action="inscription.php" method="post">
                        <h2>Inscription</h2>

                        <label for=""><b>Nom :</b></label>
                        <input type="text" name="nom" id="name" placeholder="Nom"> <br>
                        <label for=""><b>Prénom :</b></label>
                        <input type="text" name="prenom" id="prenom" placeholder="Prénom"> <br>
                        <label for=""><b>Age :</b></label> <br>
                        <input type="date" name="age" id="age" placeholder="Age"> <br>
                        <label for=""><b>Pseudo :</b></label>
                        <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo"> <br>
                        <label for=""><b>Email :</b></label> <br>
                        <input type="email" name="mail" id="mail" placeholder="Mail"> <br>
                        <label for=""><b>Mot de Passe :</b></label>
                        <input type="password" name="password" id="" placeholder="Password"> <br>
                        <input type="submit" value="inscription">
                    </form>
                    </div>

            <?php
             if(isset($_GET['erreur'])){
             $err = $_GET['erreur'];
             if($err==1 || $err==2)
             echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
             if($serr==3 || $err==3)
             echo "<p style='red'>Il manque une donnée</p>";
             }
            ?>  

        </div>
       <script src="script.js"></script>
    </body>
</html>