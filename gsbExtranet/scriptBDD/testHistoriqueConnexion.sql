INSERT INTO `historiqueconnexion` (`idMedecin`, `dateDebutLog`, `dateFinLog`) 
VALUES ('3', '2017-08-03 00:00:00', '2017-08-04 00:00:00'), ('1', '2021-08-26 04:00:00', '2021-08-26 09:00:00'), ('5', '2021-08-26 17:05:39', '2021-08-26 17:05:39');

SELECT MIN(dateFinLog), MIN(dateDebutLog) FROM historiqueconnexion

SELECT idMedecin, dateFinLog, dateDebutLog FROM historiqueconnexion GROUP BY (idMedecin) HAVING YEAR(CURRENT_DATE())-YEAR(MAX(dateFinLog)) >= 3

DELETE FROM medecin
WHERE (SELECT idMedecin, dateFinLog, dateDebutLog 
FROM historiqueconnexion 
GROUP BY (idMedecin) 
HAVING YEAR(CURRENT_DATE())-YEAR(MAX(dateFinLog)) >= 3)



SELECT idMedecin, dateFinLog, dateDebutLog 
FROM historiqueconnexion 
GROUP BY (idMedecin) 
HAVING timestampdiff(YEAR, max(dateFinLog), now()) >= 3

DELETE FROM historiqueconnexion
WHERE idMedecin IN (SELECT idMedecin
FROM medecinaeffacer)

DELETE FROM medecin
WHERE id IN (SELECT idMedecin
FROM medecinaeffacer)
