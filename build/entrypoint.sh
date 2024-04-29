#!/bin/bash
set -e

if [ "$XDEBUG_ENABLED" = "true" ]; then
	pecl install xdebug &&
	docker-php-ext-enable xdebug &&
		echo "xdebug.mode=debug" >>/usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini &&
		echo "xdebug.start_with_request=yes" >>/usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini &&
		echo "xdebug.client_host=host.docker.internal" >>/usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini &&
		echo "xdebug.client_port=9003" >>/usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini &&
		echo "xdebug.log=/var/www/html/xdebug.log" >>/usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
fi

exec "$@"
