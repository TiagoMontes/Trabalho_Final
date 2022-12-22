# Não fazer merge com a main, branch para armazenas as novas configs do Docker 





# Internship project on [Charlie](https://www.staycharlie.com.br)

### TODO (What is the project about?)

### Prerequisites:
* Docker;

### How to run the project:
* Clone the repository
```git clone https://github.com/TiagoMontes/Trabalho_Final.git```;

* Create a .env file following the .env.example;

* Run docker 
```docker compose build``` and ```docker compose up```;

* Enter on docker bash and install the dependecies
```docker exec -it app bash``` and ```composer install```;

* Create the DB
```php bin/console doctrine:database:create```

* Make the migration
```php bin/console make:migration``` and ```php bin/console doctrine:migrations:migrate```

* Open the browser on *localhost:8000/movie*.
