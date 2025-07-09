#!/bin/bash

DOCKER_BE = whalar-be
OS := $(shell uname)

ifeq ($(OS),Darwin)
	UID = $(shell id -u)
else ifeq ($(OS),Linux)
	UID = $(shell id -u)
else
	UID = 1000
endif

## —— 📦  The amazing whalar Makefile 📦 ——————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————
help: ## Outputs this help screen
	@grep -E '(^[a-zA-Z0-9_-]+:.*?##.*$$)|(^##)' Makefile | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

## —— 🐋  Docker 🐋 ——————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————

build: create-network up ## First run / installation will call this target

building:
	U_ID=${UID} docker compose build --no-cache

up: ## Start the docker environment
	U_ID=${UID} docker compose up -d --remove-orphans

run: ## Start the containers
	docker network create whalar-network || true
	U_ID=${UID} docker compose up -d

stop: ## Stop the containers
	U_ID=${UID} docker compose stop

restart: ## Restart the containers
	$(MAKE) stop && $(MAKE) run

rebuild-all: ## Rebuilds all the containers
	U_ID=${UID} docker compose build

prepare: ## Runs backend commands
	docker compose exec $(DOCKER_BE) composer install

create-network:
	docker network create whalar-network || true

down: ## Shut down and remove orphans
	docker compose down --remove-orphans

destroy: ## Full cleanup
	docker compose down --rmi all --volumes --remove-orphans

## —— 🐘  PHP container 🐘 ———————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————

install-components:
	docker compose exec $(DOCKER_BE) php artisan migrate
	docker compose exec $(DOCKER_BE) php artisan migrate --seed

migrate:
	docker compose exec $(DOCKER_BE) php artisan migrate

seed:
	docker compose exec $(DOCKER_BE) php artisan migrate --seed

fresh: ## php artisan migrate:fresh
	docker compose exec $(DOCKER_BE) php artisan migrate:fresh

fresh-seed: ## php artisan migrate:fresh --seed
	@make clean-elasticsearch
	docker compose exec $(DOCKER_BE) php artisan migrate:fresh --seed

clean-elasticsearch:
	curl -X DELETE "http://localhost:9200/_all"

consumer:
	docker compose exec $(DOCKER_BE) php artisan rabbitmq:consume-all

laravel-prepare:
	docker compose exec $(DOCKER_BE) composer update

laravel-install: ## install laravel
	docker compose exec $(DOCKER_BE) composer create-project laravel/laravel ./temp

create-project: ## create project
	mkdir -p temp
	@make create-network
	@make laravel-install
	mv temp/* .
	rm -rf temp
	mv docker/.env .env
	docker compose exec $(DOCKER_BE) php artisan key:generate
	docker compose exec $(DOCKER_BE) php artisan storage:link
	docker compose exec $(DOCKER_BE) chmod -R 777 storage bootstrap/cache
	@make fresh

dumpauto:
	docker compose exec $(DOCKER_BE) composer dumpautoload

clear-all:
	docker compose exec $(DOCKER_BE) php artisan config:clear && php artisan config:cache && php artisan route:clear && php artisan route:cache

logs: ## Tails Laravel logs
	U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_BE} tail -f storage/logs/laravel.log

enter: ## ssh's into the be container
	U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_BE} bash

test: ## Runs the tests
	docker compose exec $(DOCKER_BE) php artisan test