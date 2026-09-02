#!/bin/bash

set -e

echo "Updating system..."
apt-get update
DEBIAN_FRONTEND=noninteractive apt-get upgrade -y

echo "Installing Apache, PHP and MySQL..."
DEBIAN_FRONTEND=noninteractive apt-get install -y \
    apache2 \
    php \
    libapache2-mod-php \
    php-mysql \
    mysql-server

echo "Starting services..."
systemctl enable apache2
systemctl start apache2
systemctl enable mysql
systemctl start mysql

echo "Creating database..."
mysql -u root <<'SQL'
CREATE DATABASE IF NOT EXISTS coffee_shop;

CREATE USER IF NOT EXISTS 'user'@'localhost'
IDENTIFIED BY 'pass123';

GRANT ALL PRIVILEGES ON coffee_shop.*
TO 'user'@'localhost';

USE coffee_shop;

CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    coffee_name VARCHAR(150) NOT NULL,
    ordered_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    quantity INT NOT NULL
);
SQL

echo "Deploying website..."
rm -rf /var/www/html/*
cp -r /vagrant/webcoffee/* /var/www/html/

chown -R www-data:www-data /var/www/html

systemctl restart apache2

echo "Setup completed successfully."