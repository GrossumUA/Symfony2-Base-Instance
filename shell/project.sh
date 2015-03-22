#!/bin/sh

PROJECT_ROOT=$1

cd ${PROJECT_ROOT}
ant install
ant create_database
COMPOSER_PROCESS_TIMEOUT=2000 composer install
ant build
