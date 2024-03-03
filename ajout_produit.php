<?php
$user = 'root';
$pass = 'inconnu_X2027';
try{
    $bdd = new PDO('mysql:host=localhost;dbname=wsprosit5;charset=utf8', $user, $pass);
    if (isset($_POST['ajouter'])){
        if (!empty($_POST['nom_produit']) && !empty($_POST['prix'])){
            $nomProduit = $_POST['nom_produit'];
            $prix = $_POST['prix'];
            $description = $_POST['description'];
            $solde = $_POST['solde'];
            $url = $_POST['url'];

            $sql = "CALL ajouterProduit('$nomProduit', '$prix', '$description', '$solde', '$url')";

            if($bdd->query($sql)=== TRUE){
                echo "<p>Nouvelle informations ajoutée avec succès</p>";
            }
        }else {
            echo "<p>Vous devez remplir les champs noms et prix au minimum</p>";
        }
    }
}catch (PDOException $e){
    echo "<p>Erreur: " .$e->getMessage() ."</p>";
    die;
}

if (isset($_POST['admin'])){
    header("Location: admin.php");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajout_produit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<form method="POST" autocomplete="off">
        <div class="form-group">
            <label for="exampleInputNom">Nom du produit</label>
            <input type="text" class="form-control" id="produit" name="nom_produit" placeholder="Nom du produit">
        </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Prix du produit</label>
        <input type="text" class="form-control" id="produit" name="prix" placeholder="Prix">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Description du produit</label>
        <input type="text" class="form-control" id="produit" name="description" placeholder="Description du produit">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Solde</label>
        <input type="text" class="form-control" id="produit" name="solde" placeholder="solde">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">location de l'image</label>
        <input type="text" class="form-control" id="produit" name="url" placeholder="Location">
    </div>
    <button type="submit" class="btn btn-primary" name="ajouter">Ajouter</button>
    <button type="submit" class="btn btn-primary" name="admin">Page Admin</button
</form>
</body>
</html>

