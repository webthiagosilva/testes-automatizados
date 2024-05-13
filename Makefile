ifneq (,$(wildcard ./.env))
	include .env
	export
endif

.PHONY: build create-network run shell clean stop remove-container start

create-network:
	@docker network ls | grep -w $$NETWORK_NAME || docker network create $$NETWORK_NAME

build:
	docker build --build-arg user=$$USER --build-arg uid=$$UID -t $$IMAGE_NAME .

run: remove-container
	docker run -it -d -p 8000:8000 --name $$CONTAINER_NAME -v $(PWD):/var/www/html --network $$NETWORK_NAME --memory="500m" --cpus="1.0" $$IMAGE_NAME

stop:
	docker stop $$CONTAINER_NAME || true

remove-container:
	@docker rm -f $$CONTAINER_NAME || true

clean: stop remove-container
	-docker rmi $$IMAGE_NAME
	-docker network rm $$NETWORK_NAME

bash:
	docker exec -u 0 -it $$CONTAINER_NAME /bin/bash

test:
	docker exec -it $$CONTAINER_NAME vendor/bin/phpunit

stan:
	docker exec -it $$CONTAINER_NAME vendor/bin/phpstan analyse

start: build create-network run
