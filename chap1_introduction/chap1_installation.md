# Introduction & Présentation des tests unitaires

Nous allons aborder les tests unitaires de manière direct dans le code déjà écrit. Nous verrons plus tard une autre manière de procéder que l'on appelle TDD ,Tests Driven Developpment, qui consiste à créer des tests avant même d'implémenter la logique métier dans les classes de l'application.

Les tests unitaires vont vous aider à identifier et corriger les bugs, à refactorer le code et écrire de une documentation précise sur les fonctionnalités de vos méthodes. Les tests unitaires doivent couvrir toutes les possibilités algorithmiques d'un programme. Chaque test unitaire test une logique d'une méthode spécifique.

Nous verrons également qu'il existe des dépendances logiques entre les tests, des scénarios de tests, mais que les tests eux-mêmes sont isolés.

Retenez chaque test est une méthode qui est isolée des autres tests (méthodes) dans une classe de test.

Une application est bien testée si les tests unitaires couvrent 80% de la logique métier. Dans ce cas l'application a peu de chance de produire des bugs en production et également pourra facilement être étendue avec des nouvelles fonctionnalités, bien sûr on doit si l'application évolue refaire des tests.

**Martin Fowler:**

Concepteur et auteur conférencier informaticien britanique, pionnier et une référence dans la programmation agile.

"A chaque fois que vous avez la tentation de saisir quelque chose dans une instruction print ou dans une expression de débogage, écrivez le plutôt dans un test."

## Installation

Vous devez avoir une version de PHP >= 7.4

On va installer **PHPUnit** qui est un framework de tests. Nous pouvons l'installer de manière globale, c'est-à-dire 
dans le dossier /usr/local/bin de notre machine ou alors, l'installer uniquement pour le projet en cours.

  ```bash
composer search phpunit
composer show phpunit/phpunit --all 

# Installation locale
composer require --dev phpunit/phpunit

# Installation globale
composer global require phpunit/phpunit
```

Une autre manière installer phpunit est d'installer l'exécutable :

```bash
wget -O phpunit https://phar.phpunit.de/phpunit-9.phar
chmod +x phpunit
./phpunit --version

# Déplacez l'exécutable dans le dossier /usr/local/bin
```

## Application d'application configuration

On teste la logique algorithmique d'une classe, chaque test est une méthode d'une classe de test. Les tests sont isolés les uns des autres, principes d'isolation des tests.

Les convetions de nommage des tests sont :

- Pour une classe : NameClasseTest et pour un test (méthode) testNameMethod (mot clé test suivi du nom de la méthode à tester en général).

**Configuration**

1. Créez un dossier **src** et **tests** dans le dossier Messages dans le dossier Examples.

2. Initialisez le projet avec la commande suivante

```bash
composer init
```

Dans le fichier composer.json écrivez le code suivant, la classe Message sera dans le namespace App :

```json
{
    "name": "alan/messages",
    "autoload": {
        "psr-4": {
            "App\\Message\\": "src/"
        },
        "classmap": [
            "src/"
        ]
    },
    "authors": [
        {
            "name": "Alan",
            "email": "alan@alan.com"
        }
    ],
    "require": {}
}
```

à la racine du dossier Messages nous allons placer un fichier de configuration pour phpunit, créez ce fichier et mettez le code suivant, on définit un fichier **bootstrap.php** de bootstrap à la racine du dossier de tests. 