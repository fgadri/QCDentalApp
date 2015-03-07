#!/bin/bash
red='\033[0;31m'
green='\033[0;32m'
NC='\033[0m' # No Color
echo -e "${red}Hello CS 4690 -- Let's start building your VM...${NC}"

# Install dependencies
sudo debconf-set-selections <<< 'mysql-server-5.5 mysql-server/root_password password rootpass'
sudo debconf-set-selections <<< 'mysql-server-5.5 mysql-server/root_password_again password rootpass'
sudo apt-get update
sudo apt-get -y install mysql-server-5.5 php5-mysql apache2 php5 git

# Get production source code and create a healthcheck
cd /var/www
git clone https://github.com/scottalanweber/QCDentalApp.git 
rm /var/www/html/index.html
echo '{status:ok}' >> /var/www/html/index.html

# Setup Slim
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
cd /var/www/html
sudo composer require slim/slim