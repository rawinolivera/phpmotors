
--Query 1
INSERT INTO clients (clientId, clientFirstname, clientLastname, clientEmail, clientPassword, clientLevel, comment) VALUES ("", "Tony", "Stark", "tony@starkent.com", "Iam1ronMan", "", "I am the real Ironman");

--Query 2
UPDATE clients SET clientLevel = "3";

--Query 3
UPDATE inventory SET invDescription = REPLACE(invDescription, "small interior", "spacious interior") WHERE invId = "12";

--Query 4
SELECT inventory.invModel, carclassification.classificationName FROM inventory INNER JOIN carclassification ON inventory.classificationId = carclassification.classificationId;

--Query 5
DELETE FROM inventory WHERE invId = "1";

--Query 6
UPDATE inventory SET invImage = concat("/phpmotors",invImage), invThumbnail = concat("/phpmotors",invThumbnail);