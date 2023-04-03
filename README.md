## Ride Hailing API
Powered by Adal

![Build Status](https://cdn.iconscout.com/icon/premium/png-256-thumb/high-speed-taxi-2018575-1716264.png)

Ride Hailing is a test API to manage a transportation system, allowing to generate drivers and passengers, perform activities such as starting a trip or ending a trip. It also uses a third party API to generate payment sources and simulated transactions.

## Features

- Developed with Laravel version 10 and PHP version 8.1
- Database used Mariadb version 10
- PHPUnit for testing
- Docker compose version 3.7

## Run project locally

Remember that you must have docker and docker compose installed on your machine. Open the terminal of your console in the directory you want to have the project, in this example it will be the Downloads directory.

```sh
cd Downloads
git clone https://github.com/Adal1013/ride-hailing-api
cd ride-hailing-api
```

If you wish, you can modify some features in the docker-compose.yml, ports, container names, etc. Just keep in mind that you must make those changes in the .env file. Now once this is done we create the containers and so on with the following command:

```sh
docker-compose build
```

Once the containers and other components have been built we can lift them with the following command:

```sh
docker-compose up
```

If you prefer to run them in deamon mode (in the background), you must then execute the following command:

```sh
docker-compose up -d
```

Once the containers are built, we will make some additional configurations on them. First we will configure the databases, for this we will enter in interactive mode to the MariaDB container with the following command:

```sh
docker exec -it ride-hailing-db /bin/bash
```

If I modify the name of the container it should be in the command the custom name that you put, you can also do it with the container id. Once inside the container we execute the following command:

```sh
mysql -u root -p
```

In this step we will be asked for our root password defined in the docker-compose.yml. Once the password is entered we will be able to interact with the MariaDB CLI, in it we will execute the following commands, with the first two we will create two databases, a main db and one for tests. With the last command we will verify that the databases have been created correctly.

```sh
create database `ride-hailing`;
create database `test-ride-hailing`;
show databases;
```

With the 'exit' command we will first exit the CLI, executing it again will close the interactive container. Then we will configure the .env file to be able to run the project. First we will make a copy of the file .env.example in the same root of the project and we will modify the name placing it only .env as name. In linux this can be done with the following command:

```sh
cp .env.example .env
```

As a next step you must add the following variable values to the .env

| Variable | Valor                                                                                               |
| ------ |-----------------------------------------------------------------------------------------------------|
| TEST_TOKEN_CARD | If you wish to test with a previously tokenized card, you will need to add the token you obtained.  |
| TEST_TOKEN_NEQUI | If you wish to test with a previously tokenized nequi account, you must add the token you obtained. |
| URL | url for third party system                                                                          |
| PUBLIC_KEY | Your public token is given to you once you have registered in the system.                           |
| PRIVATE_KEY | Your private token is given to you once you have registered in the system.                          |

Finally validate that the DB_HOST variable has as value the name of the database container service defined in the docker-compose.yml and also validate the value of DB_DATABASE, DB_PASSWORD that must be the same of the docker-compose and that the DB_USERNAME is root unless you have added a new user. 

Once you are sure you have well configured the .env you can enter the container to finish the additional configurations, you must enter the container with the following command (remember that you can use the container id or another name that you have defined in the docker-compose.yml):

```sh
docker exec -it ride-hailing-api /bin/bash
```
When entering the container we will execute the following command to install all the dependencies of the project:

```sh
composer install
```

Then we will run the following command to build the database structure and seeded some tables with dummy information.

```sh
php artisan migrate --seed
```

Finally you can run the unit and integration tests with the following command:

```sh
php artisan test
```

#### Test with postman

If everything has been successful you should already have the project running, we recommend using it through postman. I have created a collection in postman with the api requests, the file is called  `--ride-hailing-api/ride-hailing-api.postman_collection.json` you can import it from your postman and start testing.
