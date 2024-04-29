# Inclua o arquivo .env e exporte suas variáveis para o ambiente do make
ifneq (,$(wildcard ./.env))
	include .env
	export
endif

.PHONY: build create-network run shell clean stop remove-container start

create-network:
	@docker network ls | grep -w $$NETWORK_NAME || docker network create $$NETWORK_NAME

build:
	docker build --build-arg user=$$USER --build-arg uid=$$UID --build-arg XDEBUG_ENABLED=$$XDEBUG_ENABLED -t $$IMAGE_NAME .

run: remove-container
	docker run -it -d -p 8001:8001 --name $$CONTAINER_NAME -v $(PWD):/var/www/html --network $$NETWORK_NAME --memory="500m" --cpus="1.0" $$IMAGE_NAME

shell:
	docker exec -u 0 -it $$CONTAINER_NAME /bin/bash

clean: stop remove-container
	-docker rmi $$IMAGE_NAME
	-docker network rm $$NETWORK_NAME

stop:
	docker stop $$CONTAINER_NAME || true

remove-container:
	@docker rm -f $$CONTAINER_NAME || true

start: build create-network run
