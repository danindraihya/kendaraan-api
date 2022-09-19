## Instruction

1. Setting up MongoDB server version 4.2 or you can docker compose with command 'docker-compose up -d' (pull mongo image with tag 4.2 first)
2. Create Database with name 'kendaraanAPI'
3. Setting up .env depends on your MongoDB server, for example :<br/>
    DB_CONNECTION=mongodb<br/>
    MONGO_DB_HOST=127.0.0.1<br/>
    MONGO_DB_PORT=27017<br/>
    MONGO_DB_DATABASE=kendaraanAPI<br/>
    MONGO_DB_USERNAME=root<br/>
    MONGO_DB_PASSWORD=root
4. Install all modules with command 'composer install --ignore-platform-reqs'
5. Run migration with command 'php artisan migration'
6. Run database seed with command 'php artisan db:seed'
7. Run unit testing with command 'php artisan test'
8. Login with (username: test, password: test) on /api/login to generate token to access others REST API






