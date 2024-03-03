DROP  PROCEDURE IF EXISTS listeProduits;

DELIMITER | -- Détermine un nouveau délimiteur pour la requête globale

CREATE PROCEDURE listeProduits() -- Procédure sans paramètre

BEGIN
    Select *
	From produits;
END |