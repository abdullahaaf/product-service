
# Product Services

A simple laravel rest api to manage Product, ex :
- CRUD Product
- CRUD Product image
- CRUD Product category



## API Reference

Detail about API, kindly refer to link below:
https://documenter.getpostman.com/view/2479819/2s93CPqrzh


## Run Locally

*Make sure already create database for this project*

Clone the project

```bash
  https://github.com/abdullahaaf/product-service.git
```

Go to the project directory

```bash
  cd product-service
```

Install dependencies

```bash
  composer install
```

Run Migration

```bash
  php artisan migrate
```

Run Seeder

```bash
  php artisan db:seed CategorySeeder
  php artisan db:seed ImageSeeder
  php artisan db:seed ProductSeeder
```

Run test
```bash
  php artisan test
```


## Author

Abdullah Amin Firdaus
