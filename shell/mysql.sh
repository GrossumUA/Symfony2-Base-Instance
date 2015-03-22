#!/bin/sh

echo "mysql-server mysql-server/root_password password $1" | debconf-set-selections
echo "mysql-server mysql-server/root_password_again password $1" | debconf-set-selections
apt-get  install -y mysql-server mysql-client