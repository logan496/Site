<?php
$user = 'root';
$pass = 'inconnu_X2027';
if (isset($_POST['admin'])){
    header("Location: admin.php");
}
if (isset($_POST['modifier'])){
    if (!empty($_POST['nom_produit']) && !empty($_POST['id_produit'])){
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=wsprosit5;charset=utf8', $user, $pass);
            $nomProduit = $_POST['nom_produit'];
            $idProduit = $_POST['id_produit'];

            $sql = $bdd->prepare("CALL modifierNom(?, ?)");
            $sql->bindParam(1, $nomProduit, PDO::PARAM_STR);
            $sql->bindParam(2, $idProduit, PDO::PARAM_INT);
            $sql->execute();

            echo "<p>Produit modifier avec succès";
        }catch (PDOException $e){
            echo "<p>" .$e->getMessage() ."</p>";
            die;
        }
    }else{
        echo "<p>Entrer le nouveau nom et choissisez l'id du produit</p>";
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier_nom</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<form method="POST" autocomplete="off">
    <div class="form-group">
        <label for="exampleInputNom">nouveau Nom du produit</label>
        <input type="text" class="form-control" id="produit" name="nom_produit" placeholder="Nom du produit">
    </div>
    <div>
        <label for="choix">Choisir l'id du produit</label>
        <select name="id_produit">
            <?php
            $user = 'root';
            $pass = 'inconnu_X2027';
            try {
                $bdd = new PDO('mysql:host=localhost;dbname=wsprosit5;charset=utf8', $user, $pass);

                $sql = $bdd->prepare("SELECT id FROM produits");
                $sql->execute();
                $resultats = $sql->fetchAll(PDO::FETCH_ASSOC);

                foreach ($resultats as $item) {
                    echo "<option value='" . $item['id'] . "'>" . $item['id'] . "</option>";
                }
            } catch (PDOException $e) {
                echo "<p>" . $e->getMessage() . "</p>";
                die;
            }
            ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary" name="modifier">Modifier</button>
    <button type="submit" class="btn btn-primary" name="admin">Page Admin</button>
</form>
</body>
</html>

