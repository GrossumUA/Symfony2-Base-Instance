#!/bin/sh

PROJECT_ROOT=/var/www/symfony/

cd ${PROJECT_ROOT}
ant install
ant create_database
composer install
ant build
