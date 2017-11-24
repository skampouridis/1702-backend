#!/bin/bash

#########################################################
#
# Bootstrap script v1.0.6 for Vagrant scotch/box 3.0.0 (Ubuntu 14.04.5 LTS)
# Purpose: PHP 7.0
#
#########################################################

echo "==================== Libraries update ======================"
sudo apt-get update

echo "========================== XDebug =========================="

echo "==> Downloading xdebug-2.5.4"
if ! [ -L xdebug-2.5.4.tgz ]; then
  rm -rf xdebug-2.5.4.tgz
fi
wget http://xdebug.org/files/xdebug-2.5.4.tgz -nv >/dev/null 2>&1

echo "==> Preparing files"
if ! [ -L xdebug-2.5.4 ]; then
  rm -rf xdebug-2.5.4
fi
tar -xvzf xdebug-2.5.4.tgz >/dev/null 2>&1
cd xdebug-2.5.4 >/dev/null 2>&1

echo "==> Installing phpize"
sudo apt-get install php7.0-dev -qq

echo "==> Compiling xdebug"
sudo phpize
sudo ./configure >/dev/null 2>&1
sudo make >/dev/null 2>&1

echo "==> Installing xdebug"
sudo cp modules/xdebug.so /usr/lib/php/20151012 >/dev/null 2>&1
echo "zend_extension = /usr/lib/php/20151012/xdebug.so" | sudo tee --append /etc/php/7.0/apache2/php.ini 2>&1 >/dev/null

echo "[xdebug]" | sudo tee --append /etc/php/7.0/cli/php.ini 2>&1 >/dev/null
echo "zend_extension = /usr/lib/php/20151012/xdebug.so" | sudo tee --append /etc/php/7.0/cli/php.ini 2>&1 >/dev/null
echo "xdebug.remote_enable=on" | sudo tee --append /etc/php/7.0/cli/php.ini 2>&1 >/dev/null
echo "xdebug.remote_handler=dbgp" | sudo tee --append /etc/php/7.0/cli/php.ini 2>&1 >/dev/null
echo "debug.remote_mode=req" | sudo tee --append /etc/php/7.0/cli/php.ini 2>&1 >/dev/null
echo "xdebug.remote_host=localhost" | sudo tee --append /etc/php/7.0/cli/php.ini 2>&1 >/dev/null
echo "xdebug.remote_port=9000" | sudo tee --append /etc/php/7.0/cli/php.ini 2>&1 >/dev/null


echo "==> Restarting web"
sudo service apache2 restart

echo "==> Make sure Laravel is installed first"
cd /var/www
sudo composer global require "laravel/installer"
export PATH="$HOME/.composer/vendor/bin:$PATH" >> ~/.bashrc
source ~/.bashrc

echo "==>dependencies installation"
cd /var/www
sudo apt-get install php7.0-xml
sudo apt-get install php7.0-xmlrpc
sudo apt-get install php7.0-mbstring
sudo composer require phar-io/manifest
sudo composer sudo global update
sudo composer global self-update

echo "======================== End of work ======================="
echo "To install laravel run: laravel new"
