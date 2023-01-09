# report-api

Steps for testing

1. docker-compose build
2. docker-compose up -d
2. docker exec -it report-api bash
3. composer install
4. php artisan key:generate
5. php artisan migrate:fresh --seed
6. php artisan test

ie. env.example has all the needed values for testing