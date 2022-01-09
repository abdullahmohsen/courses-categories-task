# Employees Task Manager

## Getting started:
1. Fork this Repository
1. Change the current directory to project path
   ex: ```cd courses-categories-task ```
1. Make the database folder ```mkdir mysql```
1. To build the docker run ``` docker-compose build && docker-compose up -d ```

    **alert:** </span> if there is a server running in your machine, you should stop it or change port 80 in docker-compose.yml to another port(8000)

1. run ``` docker-compose exec -it task_php bash ``` to entered inside the container.
1. install dependencies with composer ``` composer install``` inside the container.
1. run ``` cp .env.example .env ``` inside the container.
1. run ``` php artisan key:generate ``` inside the container.
1. run ``` php artisan migrate --seed``` inside the container.


**Info:** if you want only the task without the docker,
copy the  **/src** folder to wherever you want and make database with name **task** , then run
```composer install```, ```cp .env.example .env```, ```php artisan key:generate```, ```php artisan migrate --seed```, then ``` php artisan serve ```

