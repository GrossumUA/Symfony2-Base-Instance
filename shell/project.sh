#!/bin/sh

PROJECT_ROOT=/var/www/symfony/

cd ${PROJECT_ROOT}
composer install
ant install

