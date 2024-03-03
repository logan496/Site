<?php
session_start();
$user = 'root';
$pass = 'inconnu_X2027';

if(isset($_POST['envoi'])) {
    if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {
        $pseudo = $_POST['pseudo'];
        $motDePasse = $_POST['password'];
        $statut = 0;

        try {
            $bdd = new PDO('mysql:host=localhost;dbname=wsprosit5;charset=utf8', $user, $pass);
            $recupUser = $bdd->prepare('SELECT * FROM utilisateurs WHERE pseudo = ? AND motDePasse = ?');
            $recupUser->execute(array($pseudo, $motDePasse));

            if ($recupUser->rowCount() > 0) {
                foreach($recupUser as $utilisateur){
                    if($utilisateur['pseudo'] === $pseudo &&  $utilisateur['motDePasse'] === $motDePasse ){
                        if ($utilisateur['statutAdmin'] === 0) {
                            $_SESSION['pseudo'] = $pseudo;
                            $_SESSION['password'] = $motDePasse;

                            header("Location: acceuil.php");
                        }else{
                            $_SESSION['pseudo'] = $pseudo;
                            $_SESSION['password'] = $motDePasse;

                            header("Location: admin.php");
                        }
                    }
                }
                echo "<p>identifiants invalides</p>";
            }
        } catch (PDOException $e) {
            echo "<p>Erreur: " . $e->getMessage() . "</p>";
            die;
        }
    }else{
        echo"<P>Veuillez compléter tous les champs</P>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<form method="POST">
    <div class="form-group">
        <label for="exampleInputNom">Nom</label>
        <input type="text" class="form-control" id="exampleInputNom" name="pseudo" placeholder="Votre nom" autocomplete="off">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password" autocomplete="off">
    </div>
    <button type="submit" class="btn btn-primary" name="envoi">Submit</button>
</form>
</body>
</html>
