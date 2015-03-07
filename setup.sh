#!/bin/bash
red='\033[0;31m'
green='\033[0;32m'
NC='\033[0m' # No Color


echo -e "${red}Hello CS 4690 -- Let's start building your VM...${NC}"

apt-get install apache2 git php5 -y
mkdir /src
git clone https://github.com/scottalanweber/QCDentalApp.git:src /src
