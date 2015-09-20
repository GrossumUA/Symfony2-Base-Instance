#!/bin/sh
echo "zend_extension=/usr/lib/php5/20121212/xdebug.so
    xdebug.default_enable = 1
    xdebug.idekey = "$2"
    xdebug.remote_enable = 1
    xdebug.remote_autostart = 1
    xdebug.remote_port = 9000
    xdebug.remote_handler=dbgp
    xdebug.remote_log="/var/log/xdebug/xdebug.log"
    xdebug.remote_connect_back=1
    xdebug.max_nesting_level=250
    xdebug.remote_host = $1" > /etc/php5/mods-available/xdebug.ini

echo "export PHP_IDE_CONFIG="serverName=$3"" >> /home/vagrant/.bashrc

service php5-fpm restart
