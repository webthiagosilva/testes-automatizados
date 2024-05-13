FROM php:8.3-fpm

ARG user
ARG uid

RUN apt-get update && apt-get install -y \
		git \
		zip \
		unzip \
		libzip-dev \
	&& docker-php-ext-install \
		zip \
		opcache \
	&& pecl install xdebug \
	&& docker-php-ext-enable xdebug \
	&& rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN groupadd -g ${uid} ${user} && \
	useradd -u ${uid} -g ${user} -m ${user} -s /bin/bash && \
	mkdir -p /home/${user}/.composer /var/www/html && \
	chown -R ${user}:${user} /home/${user} /var/www/html

COPY build/php/xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
COPY build/php/opcache.ini /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini
COPY build/php/php.ini /usr/local/etc/php/php.ini

USER ${user}

WORKDIR /var/www/html

COPY --chown=${user}:${user} build/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]

CMD ["php", "-S", "0.0.0.0:8000"]
