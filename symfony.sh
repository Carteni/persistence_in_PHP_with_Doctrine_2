#!/usr/bin/env bash

# Root user
sudo su -

# Download and set execute permission.
curl -LsS https://symfony.com/installer -o /usr/local/bin/symfony
chmod a+x /usr/local/bin/symfony

# Return to Vagrant user
sudo su - vagrant