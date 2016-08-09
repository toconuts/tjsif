# Install and Setting
## Overview
The tjsif application requires as follow:
  * Linux
  * Apache: (required only for production[^1])
  * MySql
  * PHP
  * Symphony Flamework

[^1]: Symphony Flamework provides simple web server. So apache is not neccesary to set up in development.

If you don't have LAMP environment installed in your server, please do that first.
Following commands are for example to install Apache, MySQL, PHP on Ubuntu.
```sh
$ sudo apt-get update
$ sudo apt-get install apache2 libapache2-mod-php5
$ sudo apt-get install mysql-server 
$ sudo apt-get install php5 php5-mysql php5-sqlite php5-intl php5-cli
```

Note: All commands in the this guide are only confirmed on Ubuntu 14.04.5 LTS and Ubuntu 15.10. Strongly recommends to use those version of operation systems for development.


## Verify your environment

### PHP version
```sh
$ php -v
PHP 5.x.xx-1ubuntu3.4 (cli) 
Copyright (c) 1997-2015 The PHP Group
Zend Engine v2.6.0, Copyright (c) 1998-2015 Zend Technologies
    with Zend OPcache v7.0.6-dev, Copyright (c) 1999-2015, by Zend Technologies
```

### JSON support
```sh
$ php -i | grep json
/etc/php5/cli/conf.d/20-json.ini,
json
json support => enabled
json version => 1.3.x
```

### PHP ctype
```sh
$ php -i | grep ctype
ctype
ctype functions => enabled
```

### PDO module
```sh
$ php -i | grep pdo_mysql
/etc/php5/cli/conf.d/20-pdo_mysql.ini,
pdo_mysql
pdo_mysql.default_socket => /var/run/mysqld/mysqld.sock => /var/run/mysqld/mysqld.sock
```

### SQLite
```sh
$ php -i | grep sqlite
/etc/php5/cli/conf.d/20-pdo_sqlite.ini,
/etc/php5/cli/conf.d/20-sqlite3.ini
PDO drivers => mysql, sqlite
pdo_sqlite
sqlite3
sqlite3.extension_dir => no value => no value
```

## Creating tjsif Applications with Composer
Composer is the dependency manager used by modern PHP applications. 

### Clone project
First of all, you get tjsif project from github.
In your working directory.
```sh
$ git clone https://github.com/toconuts/tjsif.git
```

If you don't have GIT installed in your computer, see [Resources/doc/tips.md](https://github.com/toconuts/tjsif/tree/master/app/Resources/doc/tips.md) file.


### Checking out a versioned applications
```sh
$ cd tjsif
$ composer install
```

## Running server and check configuration
### Running and stoping server
```sh
$ php bin/console server:start
```
Then, open your browser and access the <http://localhost:8000/>  
When stop server command:
```sh
$ php bin/console server:stop
```

### Checking Symfony Application Configuration and Setup
Access <http://localhost:8000/config.php> from your blowser.  
Also you can check command:
```sh
$ php bin/symfony_requirements
```

### Set intl extansion
if intl extension should be available occured. Install and enable the intl extension (used for validators).
```sh
$ sudo apt-get install php5-intl
```

Verify commmand.
```sh
$ php -m | grep intl
```

### Set timezone
`/etc/php5/apache2/php.ini` and `/etc/php5/cli/php.ini`
```ini
[Date]
; Defines the default timezone used by the date functions
; http://php.net/date.timezone
date.timezone = Asia/Bangkok
```


## Setting up the Database to be UTF8
Add a few lines to `my.conf`.
> Version 5.5.3 introduced utf8mb4, which is recommended
```sh
$ sudo nano /etc/mysql/my.cnf
```

```cnf:/etc/mysql/my.cnf
[mysqld]
collation-server     = utf8mb4_general_ci # Replaces utf8_general_ci
character-set-server = utf8mb4            # Replaces utf8
```

### Restart server
```sh
$ sudo service mysql restart
```

## Prepare data for development
### Create database
```sh
$ php bin/console doctrine:database:create
```

### Create tables
```sh
$ php bin/console doctrine:schema:update --force
```

### Load data fixtures
```sh
$ php bin/console doctrine:fixtures:load
```

See also the most commonly used [doctrine commends](https://getcomposer.org/doc/00-intro.md).


## Guide line for development
### Images
* Carousel Image Size: 1024 x 576 (16:9 PALt)
* Update Picture Size: 500 x 500 (except BBS)
