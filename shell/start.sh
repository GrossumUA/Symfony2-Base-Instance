#!/bin/sh
apt-get update -y
apt-get install git vim rsync nginx curl -y

apt-get install -y php5 php5-fpm php5-cli php5-common php5-intl php5-json php5-mysql php5-gd php5-imagick php5-curl php5-mcrypt php5-dev php5-xdebug

echo "mysql-server mysql-server/root_password password root" | debconf-set-selections
echo "mysql-server mysql-server/root_password_again password root" | debconf-set-selections
apt-get  install -y mysql-server mysql-client


#php
rm /etc/php5/fpm/php.ini
cp /vagrant/configs/php.ini /etc/php5/fpm/php.ini
cp /vagrant/configs/20-xdebug.ini /etc/php5/fpm/conf.d/

#nginx
cp /vagrant/configs/devbox /etc/nginx/sites-available/devbox
ln -s /etc/nginx/sites-available/devbox /etc/nginx/sites-enabled/

service nginx restart
service php5-fpm restart

#composer
cp /vagrant/configs/composer.phar /usr/local/bin/composer
chmod 777 /usr/local/bin/composer

#autocomplete symfony

cp /vagrant/configs/symfony2-autocomplete.bash /etc/bash_completion.d/

echo "if [ -e /etc/bash_completion.d/symfony2-autocomplete.bash ]; then
          . /etc/bash_completion.d/symfony2-autocomplete.bash
      fi" >> ~/.bashrc

#ant
apt-get -y install ant