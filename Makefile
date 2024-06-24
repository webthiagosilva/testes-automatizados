bash:
	docker exec -u 0 -it php-app /bin/bash

test:
	docker exec -it php-app vendor/bin/phpunit

stan:
	docker exec -it php-app vendor/bin/phpstan analyse
