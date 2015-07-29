#!/bin/sh

echo "server {
          server_name $1;
          root $2/web;

          client_max_body_size 40m;

          location / {
              # try to serve file directly, fallback to app.php
              try_files \$uri /app.php\$is_args\$args;
          }

          location ~ ^/(app|app_dev|config)\.php(/|$) {
              fastcgi_pass unix:/var/run/php5-fpm.sock;
              fastcgi_split_path_info ^(.+\.php)(/.*)$;
              include fastcgi_params;
              fastcgi_param SCRIPT_FILENAME \$document_root\$fastcgi_script_name;
              fastcgi_param HTTPS off;
              fastcgi_read_timeout 600;
              fastcgi_buffers 64 64k;
              fastcgi_buffer_size 128k;
          }

          error_log /var/log/nginx/$1.error.log;
          access_log /var/log/nginx/$1.access.log;
      }" >> /etc/nginx/sites-available/symfony

ln -s /etc/nginx/sites-available/symfony /etc/nginx/sites-enabled/

service nginx restart
service php5-fpm restart
