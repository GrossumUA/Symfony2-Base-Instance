#!/bin/sh

PROJECT_ROOT=$1
echo "cd ${PROJECT_ROOT}" >> /home/vagrant/.bashrc

cd ${PROJECT_ROOT}
ant install
ant create_database
COMPOSER_PROCESS_TIMEOUT=2000 composer install
ant build
