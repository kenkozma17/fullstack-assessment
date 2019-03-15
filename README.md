# Laravel Contact Form (Assessment Test)

# Installation and Usage

1. Clone or download the repository to your machine and CD into the project.

2. Install composer dependencies.
```
composer install
```

3. Install npm dependencies.
```
npm install
```

4. Paste the .env file into the project from the attachments of the email I sent.

5. Generate the projects encrpytion key.
```
php artisan key:generate
```

6. Create an empty database in phpmyadmin or your preferred RDMS.

7. In the .env file, add your database configuration.

8. Run database migrations for the database you made.
```
php artisan migrate
```

9. Run the server.
```
php artisan serve
```
