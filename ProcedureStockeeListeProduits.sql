DROP  PROCEDURE IF EXISTS listeProduits;

DELIMITER | -- D�termine un nouveau d�limiteur pour la requ�te globale

CREATE PROCEDURE listeProduits() -- Proc�dure sans param�tre

BEGIN
    Select *
	From produits;
END |