#!/bin/bash
#######################################################################
# Application preparation
#######################################################################

(
    cd /var/www/html/api ;

    # Execute a composer installation
    COMPOSER_HOME=/var/cache/composer /usr/local/bin/composer install --quiet --no-ansi --no-dev --no-interaction --no-progress --no-scripts --no-plugins --optimize-autoloader ;

    # Execute other scripts as needed ...
	
)