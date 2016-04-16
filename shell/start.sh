#!/bin/sh
apt-get update -y
apt-get install git vim rsync nginx curl -y

apt-get install -y php5 php5-fpm php5-cli php5-common php5-intl php5-json php5-mysql php5-gd php5-imagick php5-curl php5-mcrypt php5-dev php5-xdebug

#php
cp /vagrant/configs/files/php.ini /etc/php5/fpm/php.ini
cp /vagrant/configs/files/php.ini /etc/php5/cli/php.ini

#composer
curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer
chmod 777 /usr/local/bin/composer

#autocomplete symfony
cp /vagrant/configs/files/symfony2-autocomplete.bash /etc/bash_completion.d/

echo "if [ -e /etc/bash_completion.d/symfony2-autocomplete.bash ]; then
          . /etc/bash_completion.d/symfony2-autocomplete.bash
      fi" >> ~/.bashrc

#ant
apt-get -y install ant
