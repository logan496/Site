<?php
$user = 'root';
$pass = 'inconnu_X2027';
if (isset($_POST['supprimer'])){
    if(!empty($_POST['nom_produit'])){
        try{
            $bdd = new PDO('mysql:host=localhost;dbname=wsprosit5;charset=utf8', $user, $pass);
            $nomProduit = $_POST['nom_produit'];

            $sql = $bdd->prepare("CALL supprimerProduit(?)");
            $sql->bindParam(1, $nomProduit, PDO::PARAM_STR);
            $sql->execute();

            echo "<p>Produit supprimer avec succès.</p>";
        }catch (PDOException $e){
            echo "<p>Erreur: " .$e->getMessage() ."</p>";
            die;
        }
    }else{
        echo "<p>Entrer le nom du produit</p>";
    }
}
if (isset($_POST['admin'])){
    header("Location: admin.php");
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Supprimer_produit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<form method="POST" autocomplete="off">
    <div class="form-group">
        <label for="produit">Nom du produit</label>
        <input type="text" class="form-control" id="produit" name="nom_produit" placeholder="Nom du produit">
    </div>
    <button type="submit" class="btn btn-primary" name="supprimer">Supprimer</button>
    <button type="submit" class="btn btn-primary" name="admin">Page Admin</button>
</form>
</body>
</html>
