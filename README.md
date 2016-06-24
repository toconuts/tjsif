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
### Clone project
In your working directory.
    git clone https://github.com/toconuts/tjsif.git

### Install curl
    sudo apt-get install php5-curl
    sudo apache2ctl restart

### Install Composer

    curl -sS https://getcomposer.org/installer | php
    sudo mv composer.phar /usr/local/bin/composer

or to see composer [official website][1]

### Checking out a versioned applications
    composer install

Running server and check configuration
----------------------------------
### Running server
    cd my_project_name/
    php bin/console server:start
### or
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
    php bin/console doctrine:database:drop --force
    php bin/console doctrine:database:create
Use for only to create development environment


### Create Entity or Update getter/setter
    php bin/console doctrine:generate:entities AppBundle/Entity/entity_name
To generate the missing getter and setter methods:


### Update Database Schema

    php bin/console doctrine:schema:update --force

### Load fixtures
    php bin/console doctrine:fixtures:load

Deploy
----------------------------------
`web/app.php`
$kernel = new AppKernel('prod', false);

    php bin/console cache:clear --env=prod

#TODO LIST#
* Activity: Delete. note: delete all attendances from all user
* Organization: Check Fax validation
* Invitation: Add label "username is just used in the invitation mail” 
* User: Use max integer value from parameter
* Default: Introduction page and select method
* All: Flash message when user into attendance and new activities with confirm is added
* ALL: in edit page, display updated at and updated by
* add placeholder to all form type
* Calc Profile completeness
* Place vertically center Sign in button in the navbar.
* Implement What's new -> notification
* Implement History -> activities
* Implement Log
* Change password
* Error page 404

* Add more comments in the code
* Create tests

#Guide line#
Carousel Image Size: 1024 x 576 (16:9 PALt)

http://jsfiddle.net/opengl_8080/2ZC24/show/

[1]:  https://getcomposer.org/doc/00-intro.md
[2]:  http://localhost:8000/
[3]:  http://localhost:8000/config.php