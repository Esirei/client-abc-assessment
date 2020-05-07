# client-abc-assessment

> A Laravel Project

## Installation

[PHP](https://php.net) 7.2.5+ and [Composer](https://getcomposer.org) are required.

> You'll need to run `composer install` or `composer update` to download the required packages and have the autoloader updated.

> Run `php -r "copy('.env.example', '.env');"` then `php artisan key:generate` to generate the project's .env file and app key.

> Open your .env file and add fill in your database connection settings:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=client-abc-assessment
DB_USERNAME=root
DB_PASSWORD=
```

> Finally run `php artisan migrate:fresh --seed` to run database migrations and seed the database with some dummy data.
>Note that your database should have been set up before this point.
