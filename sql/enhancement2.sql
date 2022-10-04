INSERT INTO clients (clientId, clientFirstname, clientLastname, clientEmail, clientPassword, clientLevel, comment) VALUES ("", "Tony", "Stark", "tony@starkent.com", "Iam1ronMan", "", "I am the real Ironman");
UPDATE clients SET clientLevel = "3";
UPDATE inventory SET invDescription = REPLACE(invDescription, "small interior", "spacious interior") WHERE invId = "12";
SELECT inventory.invModel, carclassification.classificationName FROM inventory INNER JOIN carclassification ON inventory.classificationId = carclassification.classificationId;
DELETE FROM inventory WHERE invId = "1";
UPDATE inventory SET invImage = concat("/phpmotors",invImage), invThumbnail = concat("/phpmotors",invThumbnail);