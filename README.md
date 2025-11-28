
## Requirements

- PHP 8.1+
- Composer
- Node.js (v16+)
- NPM or Yarn
- MySQL/PostgreSQL/SQLite
- Laravel 10+

## Local Setup
```
git clone git@github.com:rsevilla26/dogs.git
cd dogs
```


composer install

cp .env.example .env

DB_DATABASE=dog_breed_app
DB_USERNAME=root
DB_PASSWORD=your_password

php artisan key:generate
php artisan migrate
php artisan db:seed

npm install
npm run dev

php artisan serve

