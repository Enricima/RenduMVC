# Rendus MVC Mathis Enrici

## Twig : définition d'une extension pour créer des URL dynamiquement

- Création d'une fonction Twig `path` à laquelle on passerait le nom d'une route, et qui nous renverrait l'URL correspondante
1. Création d'une classe utilitaire pour gérer la génération des URL src/Utils/UrlGenrator.php
2. Création d'une extension Twig pour intégrer cette classe src/Twig/AppExtension.php
3. Instanciation de l'URL genrator dans index.php
4. Ajout d'une ligne BASE_URL="https://localhost:3007" dans le .env référencée dans l'instanciation d'UrlGenerator
5. Modification des chemins dans les templates twig de la manière suivante :
```twig
{{ path('npath/to/route') }}
```

## Instanciation dynamique de services

- Aujourd'hui, notre container contient des instances déjà créées de services applicatifs
- Il pourrait être intéressant de changer ce fonctionnement pour qu'un service soit créé dynamiquement lorsqu'on en a besoin

Une seule chose à faire selon moi : ajouter `lazy: true` dans les services du container (que je n'ai pas)

## Installation et utilisation de symfony/http-foundation

- Le composant `symfony/http-foundation` définit deux classes majeures `Request` et `Response`, qui pourraient être utilisées au sein du MVC
- La classe `Request` contient également une méthode statique `createFromGlobals` permettant de construire un objet `Request` contenant déjà les données `GET`, `POST`, `FILES`, etc...
- On pourrait donc faire utilisation de ce composant pour améliorer la structure du MVC

1. Installation de la dépendance avec `composer require symfony/http-foundation`
2. Instanciation et utilisation d'objects`Request et/ou Response` dans les Controllers
exemple d'utilisation : `$email = $request->request->get('email');`

## Définition de commandes dans la console

- Intégration du composant `symfony/console` pour créer des commandes accessibles depuis le terminal
- L'idée est de pouvoir définir des commandes personnalisées, comme par exemple :
  - Envoyer un email de test
  - Créer un utilisateur administrateur avec son mot de passe déjà haché
  - Créer un ensemble de données de tests (fixtures), avec des données fakes (on pourra installer un composant type `fakerphp/faker`)

1. Installation avec composer require symfony/console
2. Ajout dans services.yaml
3. Création d'une classe src/Command/CreateAdminUserCommand définissant la commande
4. Test de la commande avec php bin/console app:create-admin-user --username=admin --password=votre_mot_de_passe

## Définition d'une suite de tests

- Installation de PHPUnit puis écriture de tests unitaires pour des classes comme `App\Routing\Router`, `App\DependencyInjection\Container`, etc...

1. Installation de php unit `composer require phpunit/phpunit`
2. Création des fichiers de test `test/Routing/RouterTest.php` et `test/DependencyInjection/ContainerTest.php`
3. Ajout d'une ligne dans `composer.json` dans le bloc `scripts` permettant de lancer les tests à partir de la commande `composer test`

Malheuresement, je n'ai pas réussi à faire fonctionner les tests et étant donné que je manque de temps je ne me suis pas attardé dessus