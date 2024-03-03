-- on desactive l'autocommit du moteur InnoDB :
SET autocommit = 0;

-- on demarre une nouvelle transaciton :
START TRANSACTION;

-- on effectue une requete :
UPDATE produits SET prix = prix + 5 WHERE solde = 1;

-- on valide la transaction
COMMIT;