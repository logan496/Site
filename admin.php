<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<h1>Page Administrateur</h1>
<form method="POST">
    <button type="submit" class="btn btn-primary" name="liste_produit">Listes des produits</button>
    <button type="submit" class="btn btn-primary" name="liste_solde">produits en solde</button>
    <button type="submit" class="btn btn-primary" name="ajouterProduit">Ajouter un produit</button>
    <button type="submit" class="btn btn-primary" name="supprimerProduit">Supprimer un produit</button>
    <button type="submit" class="btn btn-primary" name="modifierNom">Modifier un produit</button>
    <button type="submit" class="btn btn-primary" name="reduction">Lancer une réduction</button>
</form>
</body>
</html>

<?php
$user = 'root';
$pass = 'inconnu_X2027';

try {
    $bdd = new PDO('mysql:host=localhost;dbname=wsprosit5;charset=utf8', $user, $pass);
    if(isset($_POST['liste_produit'])){
        $sql = $bdd->prepare("CALL ListeProduits");
        $sql->execute();
        $resultats = $sql->fetchAll(PDO::FETCH_ASSOC);
        echo "<table>";
        echo "<tr><th>Nom</th><th>Prix</th><th>description</th><th>Solde</th><th>URL</th></tr>";
        foreach ($resultats as $item) {
            echo "<tr>";
            echo "<td>" .$item['nom'] ."</td>";
            echo "<td>" .$item['prix'] ."</td>";
            echo "<td>" .$item['description'] ."</td>";
            echo "<td>" .$item['solde'] ."</td>";
            echo "<td>" .$item['urlImage'] ."</td>";
        }
        echo "</table>";
    }
    if(isset($_POST['liste_solde'])) {
        $sql = $bdd->prepare("CALL ListeSolde");
        $sql->execute();
        $resultats = $sql->fetchAll(PDO::FETCH_ASSOC);
        echo "<table>";
        echo "<tr><th>Nom</th><th>Prix</th><th>description</th><th>Solde</th><th>URL</th></tr>";
        foreach ($resultats as $item) {
            echo "<tr>";
            echo "<td>" . $item['nom'] . "</td>";
            echo "<td>" . $item['prix'] . "</td>";
            echo "<td>" . $item['description'] . "</td>";
            echo "<td>" . $item['solde'] . "</td>";
            echo "<td>" . $item['urlImage'] . "</td>";
        }
        echo "</table>";
    }
    if(isset($_POST['ajouterProduit'])){
        header("Location: ajout_produit.php");
    }
    if(isset($_POST['supprimerProduit'])){
        header("Location: supprimer.php");
    }
    if(isset($_POST['modifierNom'])){
        header("Location: modifier.php");
    }
    if(isset($_POST['reduction'])){
        $red = $bdd->prepare("CALL modifierPrix");
        $red->execute();

        echo "<P>Reduction appliquée avec succès</p>";
    }
} catch (PDOException $e) {
    echo "<p>Erreur: " . $e->getMessage() . "</p>";
    die;
}
?>



