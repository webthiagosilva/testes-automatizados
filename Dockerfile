FROM php:8.3-cli

ARG user
ARG uid

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

RUN useradd -G www-data,root -u $uid -d /home/$user $user \
	&& mkdir -p /home/$user/.composer \
	&& chown -R $user:$user /home/$user

WORKDIR /public

USER $user

CMD ["php", "-S", "0.0.0.0:8001"]
