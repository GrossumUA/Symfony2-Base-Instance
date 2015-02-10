#!/bin/sh

PROJECT_ROOT=/var/www/symfony/

cd ${PROJECT_ROOT}
ant create_mysql_database
composer install
ant build
