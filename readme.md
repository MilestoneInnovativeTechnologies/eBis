# eBis - ePlus Business Intelligence Software

1. install laravel ```laravel new <name>```
1. add _DOMAIN_ key in env file
1. update `DOMAIN`,`APP_URL` in env file
1. comment db params except connection in env file
1. make email field length to 64 of users,password_resets in base migration
1. make uuid field length to 191 of failed_jobs in base migration
1. update time zone

1. move to directory ```cd <name>```
1. require package ```composer require milestone/ebis```
1. `php artisan vendor:publish --tag=ebis --force`
1. comment all root routes


