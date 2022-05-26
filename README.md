# vanilla-laravel-task
I'm junior, don't judge strictly 🙃

P.S. I'm using "swagger" for the first time

## Installation
* copy .env.example to .env
* configure databases in .env file

```shell
composer install
php artisan key:generate --ansi
php artisan migrate --seed
```

## Testing
* copy .env.example to .env.testing
* configure databases in .env.testing file
```shell
php artisan test
```
