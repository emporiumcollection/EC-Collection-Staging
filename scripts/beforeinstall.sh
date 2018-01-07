#!/bin/bash
sudo umount -l s3fs
sudo cp -R /var/www/vhosts/emporium-voyage.com/public_html/storage/* /var/www/vhosts/emporium-voyage.com/storage
sudo rm -rf /var/www/vhosts/emporium-voyage.com/public_html
