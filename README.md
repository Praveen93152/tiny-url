Complete Setup Commands

You can run the main setup commands in this order:


git clone https://github.com/Praveen93152/tiny-url.git

cd tiny-url

composer install

cp .env.example .env

Configure the MySQL credentials in .env, then run:

DB_CONNECTION=mysql

DB_HOST=127.0.0.1 

DB_PORT=3306 

DB_DATABASE= 

DB_USERNAME= 

DB_PASSWORD=

php artisan migrate

php artisan key:generate

php artisan db:seed

php artisan serve


Then open:
http://127.0.0.1:8000

Use the Super Admin credentials from the seeder to log in.
