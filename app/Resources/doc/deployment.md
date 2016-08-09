# Deployment

## Installing the Server Dependencies
```sh
$ sudo apt-get update
$ sudo apt-get install git php5-cli php5-curl acl git

$ curl -sS https://getcomposer.org/installer | php
$ sudo mv composer.phar /usr/local/bin/composer
```

## Configuring MySQL
### Setting up the Database to be UTF8
```sh
$ sudo nano /etc/mysql/my.cnf
```
```cnf:my.cnf
[mysqld]
#
# * Basic Settings
#
collation-server     = utf8mb4_general_ci # Replaces utf8_general_ci
character-set-server = utf8mb4            # Replaces utf8
```
```sh
$ sudo service mysql restart
```

### Check database created
```sh
$ mysql -uroot -p
```
```sql
mysql> CREATE DATABASE tjsif;
mysql> SHOW DATABASES;

use tjsif;
show variables like "chara%";
+--------------------------+----------------------------+
| Variable_name            | Value                      |
+--------------------------+----------------------------+
| character_set_client     | utf8                       |
| character_set_connection | utf8                       |
| character_set_database   | utf8mb4                    |
| character_set_filesystem | binary                     |
| character_set_results    | utf8                       |
| character_set_server     | utf8mb4                    |
| character_set_system     | utf8                       |
| character_sets_dir       | /usr/share/mysql/charsets/ |
+--------------------------+----------------------------+

mysql> quit;
```

## Checking Out the Application Code
```sh
$ sudo mkdir -p /var/www/tjsif
$ sudo chown tjsif:tjsif /var/www/tjsif

$ cd /var/www
$ git clone https://github.com/toconuts/tjsif.git
```

## Fixing the Folder Permissions
```sh
$ sudo setfacl -R -m u:www-data:rwX tjsif/var
$ sudo setfacl -dR -m u:www-data:rwX tjsif/var
```
and also
```sh
$ sudo setfacl -R -m u:www-data:rwX tjsif/web/uploads tjsif/web/media 
$ sudo setfacl -dR -m u:www-data:rwX tjsif/web/uploads tjsif/web/media
```

### Check folder permissions
For example.
```sh
$ getfacl tjsif/var
```

## Setting Up the Application
### Defines the options related to the database and mail server
Configure your `app/config/parameters.yml` file.

### Install/Update your Vendors
```sh
$ cd tjsif
$ export SYMFONY_ENV=prod
$ composer install --no-dev --optimize-autoloader
```

### Set time zone
`/etc/php5/apache2/php.ini` and `/etc/php5/cli/php.ini`  
See also [Set timezone](app/Resources/doc/installation.md#set-timezone)

### Check Requirements
```sh
$ php bin/symfony_requirements
```

### Create tables
```sh
php bin/console doctrine:schema:create
```

### Clear your Symfony Cache
```sh
$ php bin/console cache:clear --env=prod --no-debug
```

### Dump your Assetic Assets
```sh
$ php bin/console assetic:dump --env=prod --no-debug
```

## Setting Up the Web Server
Configuration Steps for Apache Web Server

### Create virtual host
```sh
$ sudo nano /etc/apache2/sites-available/tjsif.conf
```
```conf
<VirtualHost *:80>
    # ServerName example.com
    # ServerAlias www.example.com
    DocumentRoot /var/www/todo-symfony/web
    <Directory /var/www/todo-symfony/web>
        AllowOverride None
        Order Allow,Deny
        Allow from All

        <IfModule mod_rewrite.c>
            Options -MultiViews
            RewriteEngine On
            RewriteCond %{REQUEST_FILENAME} !-f
            RewriteRule ^(.*)$ app.php [QSA,L]
        </IfModule>
    </Directory>

    # uncomment the following lines if you install assets as symlinks
    # or run into problems when compiling LESS/Sass/CoffeScript assets
    # <Directory /var/www/project>
    #     Options FollowSymlinks
    # </Directory>

    ErrorLog /var/log/apache2/symfony_error.log
    CustomLog /var/log/apache2/symfony_access.log combined
</VirtualHost>
```

### Check current sites
```sh
$ ls /etc/apache2/sites-enabled
```

### Disable current sites and enable tjsif
```sh
$ sudo a2dissite current-site
$ sudo a2ensite tjsif
$ sudo a2enmod rewrite
```

### Check configuration and restart Apache
```sh
$ apachectl configtest
$ sudo service apache2 restart
```


## Update deployed server (on the second time or more)
```sh
$ git pull
$ export SYMFONY_ENV=prod
$ composer install --no-dev --optimize-autoloader
$ php bin/console doctrine:schema:validate
$ php bin/console cache:clear --env=prod --no-debug
$ php bin/console assetic:dump --env=prod --no-debug
$ sudo service apache2 restart
```
