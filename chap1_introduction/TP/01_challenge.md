# Challenge 01

Vous devez vous mettre en équipe de 1 pour réaliser ce TP.

## Partie 1

Récupérez dans le dossier Exercices le dossier Challenge_01.

Oragnisez le projet afin qu'il soit correctement tester.

1. Créez le MockStorage il l'implémentera l'interface Storable, il vous permettra de remplacer le storage de la classe Cart afin de la tester. 

2. Définissez des tests permettant de valider l'ensemble des méthodes existantes dans la classe métier Cart.

3. On décide d'ajouter une fonctionnalité : restoreQuantity cette méthode permettra de retirer une certaine quantité d'un produit commandé. Faites le test avant d'implémenter le code métier dans la classe Cart (TDD).

## Partie 2

Dans la suite de ce TP vous utiliserez PDO.

1. Créez une base de données fruittest à l'aide d'un script dans le fichier autoload.php dans le dossier tests. Analysez bien la structure de données pour bien implémentez le StorageMySQL que vous devez mettre en place dans cette partie.

```php
// attention au port pour vous connectez à la base de données adaptez le en fonction de votre machine.
$dbh = new PDO("mysql:host=localhost:8889", $_ENV['USERNAME'], $_ENV['PASSWORD']);

$dbh->exec("
DROP DATABASE IF EXISTS fruittest ;
CREATE DATABASE fruittest DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
use fruittest;
CREATE TABLE IF NOT EXISTS 
product (
    ID INT NOT NULL AUTO_INCREMENT, 
    name VARCHAR(100), 
    price DECIMAL(7,2), 
    total DECIMAL(7,2) NOT NULL DEFAULT 0.00, 
    PRIMARY KEY(id) )ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO product (name, price) VALUES  ('apple', 10.5), ('raspberry',13), ('strawberry', 7.8);
");
```

2. Créez maintenant StorageMySQL effectivement et testez cette classe, elle implémentera le contrat Storage.

3. Créez maintenant la compagne de tests en considérant ce nouveau Storage dans le projet Cart.

4. Améliorez la connexion à la base de données avec les deux méthodes statique suivantes :

- setUpBeforeClass() 

- tearDownAfterClass()

Ces méthodes vous permettrons de définir une connexion et une déconnexion à la base de données.