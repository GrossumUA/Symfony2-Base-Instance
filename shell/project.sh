#!/bin/sh

PROJECT_ROOT=/var/www/symfony/

cd ${PROJECT_ROOT}
ant install
composer install
ant create_database
ant build

