<p align="center">
<img src="./logo.png" width="400" alt="Deployment OVH">
</p>

Test Deployment Laravel App To Ovh API Application
========================

L'application Test Deployment Laravel App To Ovh API a pour but de faire le test de déploiement vers Ovh.

Pré requis
------------

  * PHP 8.1.0 or higher;
  * MySQL
  * Composer
  * Npm

Récupération (GIT)
------------

## Ouvrez le dossier /www de votre serveur local ('Laragon' ou 'Wamp' par exemple) à l'aide de Git Bash et executé la commande suivante :

```bash
$ git clone https://github.com/osscoco/ManageProductLaravelApi.git
```

```bash
$ cd ManageProductLaravelApi
```

```bash
$ cp .env.example .env
```

## Configurer la connexion à la base de données dans .env :

- DB_CONNECTION=mysql
- DB_HOST=127.0.0.1
- DB_PORT=3306
- DB_DATABASE=database_name
- DB_USERNAME=user_name
- DB_PASSWORD=password

## Créer la base de données dans MySQL

## OU

## Configurer la connexion à la base de données dans .env :

- DB_CONNECTION=pgsql
- DB_HOST=127.0.0.1
- DB_PORT=5432
- DB_DATABASE=database_name
- DB_USERNAME=user_name
- DB_PASSWORD=password

## Créer la base de données dans PgSQL

## A l'aide de GIT BASH, dans le repertoire du projet cloné :

```bash
$ composer install
```

```bash
$ npm install
```

```bash
$ php artisan key:generate
```

```bash
$ php artisan migrate
```

```bash
$ php artisan serve
```

## Ouvrir POSTMAN Pour Admin Actions :

```bash
$ GET : http://localhost:8000/api/generateRootAccount
```

```bash
$ POST : http://localhost:8000/api/login
	- email : admin.corporation@gmail.com
	- password : AkfdhdjfFG19R463qfds!!
```

```bash
$ Copier la valeur du token dans le JSON Response
```

```bash
$ GET : http://localhost:8000/api/user
	- Authorization -> BearerToken -> coller le token précédement copié
```

```bash
$ POST : http://localhost:8000/api/register
    - name : User
    - email : user.corporation@gmail.com
    - password : Not24get
    - Authorization -> BearerToken -> coller le token précédement copié
```

```bash
$ GET : http://localhost:8000/api/products
    - Authorization -> BearerToken -> coller le token précédement copié
```

```bash
$ POST : http://localhost:8000/api/product/store
    - label : Produit 1
    - Authorization -> BearerToken -> coller le token précédement copié
```

```bash
$ PUT : http://localhost:8000/api/product/update/1
    - label : Produit 1 Modifié
    - Authorization -> BearerToken -> coller le token précédement copié
```

```bash
$ DELETE : http://localhost:8000/api/product/delete/1
	- Authorization -> BearerToken -> coller le token précédement copié
```

```bash
$ GET : http://localhost:8000/api/logout
	- Authorization -> BearerToken -> coller le token précédement copié
```

## Ouvrir POSTMAN Pour User Actions :

```bash
$ POST : http://localhost:8000/api/login
	- email : user.corporation@gmail.com
	- password : Not24get
```

```bash
$ Copier la valeur du token dans le JSON Response
```

```bash
$ GET : http://localhost:8000/api/user
	- Authorization -> BearerToken -> coller le token précédement copié
```

```bash
$ GET : http://localhost:8000/api/products
    - Authorization -> BearerToken -> coller le token précédement copié
``` 

```bash
$ GET : http://localhost:8000/api/logout
	- Authorization -> BearerToken -> coller le token précédement copié
```

## Mise en production OVH :

### 1 - Dupliquer le projet entier dans un autre dossier

### 2 - Se connecter sur le compte admin sur Swagger

### 3 - Executer la route /api/production-step-3 (message de success : Etape 3 Production terminée)

### 4 - Supprimer les fichiers du dossier /storage comme ci-dessous : 

###     A - App\Public\Vide

###     B - Framework\Cache\Data\Vide

###     C - Framework\Session\Vide

###     D - Framework\Testing\Vide

###     E - Framework\Views\Vide

###     F - Logs\laravel.log (fichier vide)

### 5 - Modifier les variables d'environnement de la base de données et de l'url comme ceci : 

```bash
APP_NAME=ManageProduct
APP_ENV=production
APP_KEY=base64:Li70+EyPWEi0/76p3j1L4uiLux9XsVOZtLdx7EJvXR0=
APP_DEBUG=false
APP_URL=url

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION="pgsql"
DB_HOST="hostname"
DB_PORT="port"
DB_DATABASE="database"
DB_USERNAME="username"
DB_PASSWORD="password"

SANCTUM_STATEFUL_DOMAINS_EXPIRE=30

L5_SWAGGER_CONST_HOST=url
L5_SWAGGER_BASE_PATH=url

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=url

REDIS_HOST=url
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_PUSHER_HOST="${PUSHER_HOST}"
VITE_PUSHER_PORT="${PUSHER_PORT}"
VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
```

### 6 - Vérifiez le contenu du fichier /storage/api-docs/api-docs.json :
```bash
{
    "openapi": "3.0.0",
    "info": {
        "title": "Manage Product Laravel Api",
        "description": "Documentation pour Swagger API",
        "contact": {
            "name": "corentin.jeannot2a@gmail.com"
        },
        "version": "1.0"
    },
    "servers": [
        {
            "url": "url_du_fichier_.env"
        }
    ],
    ...
```

### 7 - Executez la route /api/production-step-7 (message de success : Etape 7 Production terminée)

### 8 - Executez la commande 'composer install --optimize-autoloader --no-dev'