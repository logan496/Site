<?php
$user = 'root';
$pass = 'inconnu_X2027';

if(isset($_POST['envoi'])){
    if(!empty($_POST['pseudo']) && !empty($_POST['password'])){
        $pseudo = $_POST['pseudo'];
        $motDePasse = $_POST['password'];
        // $pseudo = "logan";
        // $motDePasse = "*****";
        $statut = 0;
        try{
            $bdd = new PDO('mysql:host=localhost;dbname=wsprosit5;charset=utf8', $user, $pass);

            $requeteVerif = $bdd->prepare("SELECT COUNT(*) FROM utilisateurs WHERE pseudo = :pseudo");
            $requeteVerif->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
            $requeteVerif->execute();
            $resultat = $requeteVerif->fetchColumn();

            if($resultat>0){
                echo "<p>Ce nom d'utilisateur est déjà pris. Veuillez en utiliser un autre.</p>";
            }else{
                $requete = $bdd->prepare("INSERT INTO utilisateurs (pseudo, motDePasse, statutAdmin) VALUES( :pseudo,:motDePasse, $statut)");
                $requete->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
                $requete->bindValue(':motDePasse', $motDePasse, PDO::PARAM_STR);
                $requete->execute();
                echo "<p>Inscription réussie</p>";
                header("Location: acceuil.php");
            }
        }catch(PDOException $e){
            echo "Erreur: " .$e->getMessage() ."<br/>";
            die;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>inscription</title>
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