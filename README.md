# Message Board - PHP Backend

Ce projet est un exemple de message board basique, permettant aux utilisateurs de poster des messages dans des salons. Il est développé en PHP natif sans utilisation de frameworks, à l'exception des bibliothèques de test.

## Fonctionnalités

- Les utilisateurs peuvent être différenciés les uns des autres.
- Les utilisateurs peuvent poster des messages dans n'importe quel salon.
- Les utilisateurs ne peuvent pas poster deux messages consécutifs sauf si leur dernier message date de plus de 24 heures.
- Chaque message doit faire au minimum 2 caractères et au maximum 2048 caractères.
- N'importe qui peut créer un nouveau salon du moment qu'il n'y en ai pas déjà un avec le même nom.
- Les utilisateurs peuvent lire tous les messages de tous les salons, du plus récent au plus ancien.

## Installation

1. Clonez ce dépôt sur votre serveur local ou distant.
2. Configurez votre serveur pour pointer vers le dossier du projet. (php -S localhost:8000 ./public/router.php)

## Structure du projet

- `ORM.php` : Contient la classe ORM qui gère la création des salons et des messages, ainsi que la récupération des messages par salon.
- `User.php` : Contient la classe User qui représente un utilisateur du message board.
- `Message.php` : Contient la classe Message qui représente un message posté par un utilisateur.
- `Room.php` : Contient la classe Room qui représente un salon de discussion.
- `/tests` : Contient les tests unitaires et fonctionnels du projet.

## Tests

Les tests unitaires et fonctionnels sont écrits avec PHPUnit et Behat. Pour exécuter les tests, suivez les instructions d'installation de PHPUnit et Behat dans le projet.

- Pour exécuter les tests unitaires avec PHPUnit, utilisez la commande suivante :

```
phpunit tests/unit
```

- Pour exécuter les tests fonctionnels avec Behat, utilisez la commande suivante :

```
behat
```

## Contribution

Ceci est un projet d'étude, aucune contribution n'est attendue.




