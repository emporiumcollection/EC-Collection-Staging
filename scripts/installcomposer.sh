#!/bin/bash
mkdir /var/www/vhosts/emporium-voyage.com
cd /var/www/vhosts/emporium-voyage.com
wget https://s3-eu-west-1.amazonaws.com/emporium-voyage/env/live/.env
chmod 755 .env
chown www-data:www-data .env
composer update -d /var/www/vhosts/emporium-voyage.com
chown -R www-data:www-data /var/www/vhosts/emporium-voyage.com
sudo find /var/www/vhosts/emporium-voyage.com -type d -exec chmod 755 {} +
sudo find /var/www/vhosts/emporium-voyage.com -type f -exec chmod 755 {} +
chmod -R 777 /var/www/vhosts/emporium-voyage.com/storage
mkdir /var/www/vhosts/emporium-voyage.com/public/uploads
s3fs emporium-voyage /var/www/vhosts/emporium-voyage.com/public/uploads/ -o passwd_file=/etc/passwd-s3fs  -ouid=33,gid=33,allow_other,mp_umask=002
composer dump-autoload -d /var/www/vhosts/emporium-voyage.com
service nginx restart
