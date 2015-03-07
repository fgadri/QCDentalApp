#!/bin/bash
red='\033[0;31m'
green='\033[0;32m'
NC='\033[0m' # No Color


echo -e "${red}Hello CS 4690 -- Let's start building your VM...${NC}"

#apt-get install git apache2 git php5 -y
# Install dependencies
sudo debconf-set-selections <<< 'mysql-server-5.5 mysql-server/root_password password rootpass'
sudo debconf-set-selections <<< 'mysql-server-5.5 mysql-server/root_password_again password rootpass'
sudo apt-get update
sudo apt-get -y install mysql-server-5.5 php5-mysql apache2 php5 git


#mkdir /repo
cd /var/www/html
git clone https://github.com/scottalanweber/QCDentalApp.git
#ln -s /repo/production /var/www/html
#rm -f /var/www/html/index.html