# Projet sur les Webservices
## Installation avec Docker :
__Docker est requis.__

* Cloner le repository : `git clone https://github.com/izio38/web-services.git`
* Se placer dans le projet : `cd web-services`
* Lancer toutes les applications : `docker-compose up -d`

### Les URL's :
* SoapGen : `https://localhost/soapgen`.
* SoapClient : `http://localhost:8080/soapclient.php`.
* Api platform : `https://localhost/api`.

## Installation sans Docker :
Avant de commencer il faudra :
* Un serveur de base de données [MySQL](https://dev.mysql.com/downloads/installer/) 5.7+ ou [MariaDB](https://downloads.mariadb.org/).
* L'utilitaire de commande [composer](https://getcomposer.org/download/).
* Le Framework [Symfony](https://symfony.com/doc/current/setup.html).
* [PhP](https://windows.php.net/download/) 7.4+

Il faudra ensuite faire les étapes suivantes :
* Cloner le repository : `git clone git@github.com:izio38/web-services.git`.
* Se placer dans le projet : `cd web-services`.
* Installer les bundles dépendants : `composer install`.
* Changer __LES URL SUIVANTES__ :
    * `.env` : Changer la variable `DATABASE_URL` et mettre l'endpoint de votre serveur de base de données.
    * `/soapclient/soapclient.php` : remplacer `http://nginx:80` par l'url de votre serveur Symfony.
    * `/src/Controller/SoapController.php` : remplacer `http://nginx:80` par l'url de votre serveur Symfony.
    * `/src/Controller/SoapGenController.php` : remplacer `http://nginx:80` par l'url de votre serveur Symfony.
* Lancer le serveur Symfony : `symfony serve &`.
* Placer le dossier `/soap-client` sur un proxy web style Apache ou Nginx.

### Les URLs :
Vous pouvez maintenant accèder au dossier `soap-client` que vous avez placez sur un proxy web. La plupart du temps vous y accèderez (sauf modification de votre part) via l'url : `http://localhost/soap-client/soapclient.php`
## Ajouter les fixtures :
Une fois que la base de données est configurée, il est possible de lancer les fixtures à l'aide de la commande : `php bin/console doctrine:fixtures:load`.

__ATTENTION: Si vous n'utilisez pas Docker, il faudra d'abord installer les bundles à l'aide de la commande__: `composer install`