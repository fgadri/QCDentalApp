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
echo -e "${green}Apache configuration complete${NC}"

# Download and Configure Postfix
debconf-set-selections <<< "postfix postfix/mailname string  vagrant-ubuntu-trusty-64"
debconf-set-selections <<< "postfix postfix/main_mailer_type string 'Internet Site'"
sudo apt-get install postfix mailutils -y
	# Modify /etc/postfix/main.cf Config
sudo sed -i 's/.*relayhost =.*/&[smtp.gmail.com]:587\nsmtp_sasl_auth_enable = yes\nsmtp_sasl_password_maps = hash:\/etc\/postfix\/sasl_passwd\nsmtp_sasl_security_options = noanonymous\nsmtp_tls_CAfile = \/etc\/postfix\/cacert.pem\nsmtp_use_tls = yes/' /etc/postfix/main.cf
	
sudo echo '[smtp.gmail.com]:587    CaptureDental@gmail.com:!!CaptureDental!!' > /tmp/sasl_passwd
sudo cp /tmp/sasl_passwd /etc/postfix
sudo chmod 400 /etc/postfix/sasl_passwd
sudo postmap /etc/postfix/sasl_passwd
sudo cat /etc/ssl/certs/Thawte_Premium_Server_CA.pem | sudo tee -a /etc/postfix/cacert.pem
sudo /etc/init.d/postfix restart


# Initialize the Database
echo -e "${red}Initializing the Database...${NC}"
cd /var/www/
sudo mysql -uroot -prootpass < DatabaseCreation.sql
sudo mysql -uroot -prootpass < DatabaseTestImport.sql
echo -e "${red}Setting up database to be connected to from 192.168.66.1...${NC}"
sudo iptables -A INPUT -i eth0 -s 192.168.66.1 -p tcp --destination-port 3306 -j ACCEPT
sed -i 's/127.0.0.1/192.168.66.66/' /etc/mysql/my.cnf
sudo service mysql restart
echo -e "${green}Done configuring Database${NC}"