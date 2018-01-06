#!/bin/bash
mkdir /var/www/vhosts/emporium-voyage.com/public_html
cd /var/www/vhosts/emporium-voyage.com/public_html
wget https://s3-eu-west-1.amazonaws.com/emporium-voyage-live/env/live/.env
chmod 755 .env
chown www-data:www-data .env
composer install /var/www/vhosts/emporium-voyage.com/public_html
composer update -d /var/www/vhosts/emporium-voyage.com/public_html
chown -R www-data:www-data /var/www/vhosts/emporium-voyage.com
sudo find /var/www/vhosts/emporium-voyage.com/public_html -type d -exec chmod 755 {} +
sudo find /var/www/vhosts/emporium-voyage.com/public_html -type f -exec chmod 755 {} +
cp -R /var/www/vhosts/emporium-voyage.com/storage /var/www/vhosts/emporium-voyage.com/public_html/storage
chmod -R 777 /var/www/vhosts/emporium-voyage.com/public_html/storage
mkdir /var/www/vhosts/emporium-voyage.com/public_html/public/uploads
s3fs emporium-voyage-live /var/www/vhosts/emporium-voyage.com/public_html/public/uploads/ -o passwd_file=/etc/passwd-s3fs  -ouid=33,gid=33,allow_other,mp_umask=002
composer dump-autoload -d /var/www/vhosts/emporium-voyage.com/public_html
service nginx restart
