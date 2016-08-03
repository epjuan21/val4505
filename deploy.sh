#!/bin/sh
cd /var/www/html/val4505
git pull origin master
mysqldump -u root -p val4505 < val4505.sql