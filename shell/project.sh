#!/bin/sh

PROJECT_ROOT=/var/www/devBox/

cd ${PROJECT_ROOT}
composer install
ant install

