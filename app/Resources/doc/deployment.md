# TIPS

## Setup Composer
### Install curl
```sh
$ sudo apt-get install php5-curl
$ sudo apache2ctl restart
```

### Install Composer
```sh
$ curl -sS https://getcomposer.org/installer | php
$ sudo mv composer.phar /usr/local/bin/composer
```
see also composer [official website](https://getcomposer.org/doc/00-intro.md).

## Setup GIT
### Install git
```sh
$sudo apt-get install git
```

### Register user name and email
```sh
$ git config --global user.name "Your Name"
$ git config --global user.email "youremail@domain.com"
```


## Doctrine commands
### Create and delete database
```sh
$ php bin/console doctrine:database:create
$ php bin/console doctrine:database:drop --force
```
### Update Database Schema
```sh
$ php bin/console doctrine:schema:update --force
```
Be careful to use in product environment

### Create Entity or Update getter/setter
```sh
$ php bin/console doctrine:generate:entities AppBundle/Entity/entity_name
```
To generate the missing getter and setter methods:

### Load data fixtures for test enviroment
```sh
$ php bin/console doctrine:fixtures:load
```

## ubuntu
### Add user
```sh
$ adduser user_name
```

### Add role
```sh
$ sudo gpasswd -a user group
```

### Verify ubuntu version
```sh
$ cat /etc/lsb-release
```

### Verify Architecture
```sh
$ arch
```
or
```sh
$ name -a
```

## Bootstrap
For Verifying grid system <https://jsfiddle.net/toconuts/39b3xv79/54/show/>
