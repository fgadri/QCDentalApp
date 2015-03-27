#!/bin/bash
red='\033[0;31m'
green='\033[0;32m'
NC='\033[0m' # No Color
echo -e "${red}Hello CS 4690 -- Let's start building your VM...${NC}"

# Install dependencies
sudo debconf-set-selections <<< 'mysql-server-5.5 mysql-server/root_password password rootpass'
sudo debconf-set-selections <<< 'mysql-server-5.5 mysql-server/root_password_again password rootpass'
sudo apt-get update
sudo apt-get -y install mysql-server-5.5 php5-mysql apache2 php5 git php5-gd php5-mcrypt

# Get production source code and create a healthcheck
sudo rm -rf /tmp/src
mkdir /tmp/src
sudo git clone https://github.com/scottalanweber/QCDentalApp.git /tmp/src
rm -f /var/www/html/index.html
sudo cp -r /tmp/src/* /var/www/
echo '{status:ok}' >> /var/www/html/health.html

# Set up Apache Config
echo -e "${red}Setting up the Apache Config to allow .htaccess overrides...${NC}"
sudo a2enmod rewrite
sudo cp /var/www/000-default.conf /etc/apache2/sites-available/000-default.conf
sudo service apache2 restart
echo -e "${red}Apache configuration complete${NC}"

# Initialize the Database
echo -e "${red}Initializing the Database...${NC}"
cd /var/www/
sudo mysql -uroot -prootpass < DatabaseCreation.sql
echo -e "${red}Setting up database to be connected to from 192.168.66.1...${NC}"
sudo iptables -A INPUT -i eth0 -s 192.168.66.1 -p tcp --destination-port 3306 -j ACCEPT
sed -i 's/127.0.0.1/192.168.66.66/' /etc/mysql/my.cnf
sudo service mysql restart
echo -e "${green}Done configuring Database${NC}"