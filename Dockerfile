FROM php:8.3-cli

ARG user
ARG uid
ARG XDEBUG_ENABLED=false

RUN apt-get update && apt-get install -y \
	git \
	zip \
	unzip \
	&& rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

RUN groupadd -g ${uid} ${user} && \
	useradd -u ${uid} -g ${user} -m ${user} -s /bin/bash && \
	mkdir -p /home/${user}/.composer /var/www/html && \
	chown -R ${user}:${user} /home/${user} /var/www/html

USER ${user}

WORKDIR /var/www/html

COPY --chown=${user}:${user} build/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]

CMD ["php", "-S", "0.0.0.0:8001"]
