#!/bin/sh

echo "# database
db.user=root
db.name=$1
db.password=$2
db.host=127.0.0.1
db.port=3306
db.driver=pdo_mysql
" >> $3/app/config/build.properties
