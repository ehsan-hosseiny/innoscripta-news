#### Inside innoscripta-api Copy .env.example and make .env and set mysql config according to mysql container

#### Run bellow command
`docker-compose build --no-cache`

#### Inside innoscripta-api run bellow command run bellow command to install dependency
`composer install`


#### Run bellow command to run migration
`php artisan migrate`

#### Run bellow command to get news from three sources (news_api,ny_times,guardians)
`php artisan fetch:news`

