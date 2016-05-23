# tjsif
Thailand - Japan Student ICT Fair 2016 Official Web Site

Verify Environment
----------------------------------
### PHP version
    php -v

### JSON support
    php -i | grep json

### PHP type
    php -i | grep ctype

### PDO module
    php -i | grep pdo_mysql

### SQLite
    php -i | grep sqlite

Setup Composer
----------------------------------
### Install Composer

    curl -sS https://getcomposer.org/installer | php
    sudo mv composer.phar /usr/local/bin/composer

### Checking out a versioned applications
    composer install

Running server and check configuration
----------------------------------
### Running server
    cd my_project_name/
    php bin/console server:stop
or
    php bin/console server:run
Then, open your browser and access the [http://localhost:8000/][1]

### Stop server
    php bin/console server:stop

### Checking Symfony Application Configuration and Setup
[http://localhost:8000/config.php][2]
Also you can check this command
    php bin/symfony_requirements

if intl extension should be available occured.
   > Install and enable the intl extension (used for validators).
    sudo apt-get install php5-intl

Setting up the Database to be UTF8
----------------------------------
### Add a few lines to `my.conf`.
Version 5.5.3 introduced utf8mb4, which is recommended
    sudo gedit /etc/mysql/my.cnf

    [mysqld]
    collation-server     = utf8mb4_general_ci # Replaces utf8_general_ci
    character-set-server = utf8mb4            # Replaces utf8

### Restart server
    sudo service mysql restart

Doctrine commands
----------------------------------
### Create and delete database 
Use for only to create development environment
    php bin/console doctrine:database:drop --force
    php bin/console doctrine:database:create

### Create Entity or Update getter/setter
To generate the missing getter and setter methods:
    php bin/console doctrine:generate:entities AppBundle/Entity/entity_name

### Update Database Schema
    php bin/console doctrine:schema:update --force

### Load fixtures
    php bin/console doctrine:fixtures:load

Deploy
----------------------------------
`web/app.php`
$kernel = new AppKernel('prod', false);

    php bin/console cache:clear --env=prod

[1]:  http://localhost:8000/
[2]:  http://localhost:8000/config.php