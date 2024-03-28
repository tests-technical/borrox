DIR := $(shell dirname $(realpath $(lastword $(MAKEFILE_LIST))))
PROJECT_NAME = borrox
EXEC_USER = 1000:1000
DOCKER_COMPOSE = BUILDKIT_PROGRESS=plain DOCKER_BUILDKIT=1 COMPOSE_DOCKER_CLI_BUILD=1 docker-compose \
	--env-file .env \
    -f docker-compose.yml \
	--project-directory $(DIR) \
    -p ${PROJECT_NAME}

default: up.infra up.backend

###< Backend ###

build.backend:
	$(DOCKER_COMPOSE) build backend-php backend-nginx mysql

up.backend:
	$(DOCKER_COMPOSE) up -d backend-php backend-nginx

shell.backend:
	$(DOCKER_COMPOSE) exec -u $(EXEC_USER) backend-php bash

dev.backend: up.infra up.backend shell.backend

logs.backend.php:
	$(DOCKER_COMPOSE) logs -f --tail=50 backend-php

logs.backend.nginx:
	$(DOCKER_COMPOSE) logs -f --tail=50 backend-nginx

###> Backend ###



###< Infra ###

build.infra:
	$(DOCKER_COMPOSE) build mysql http

up.infra:
	$(DOCKER_COMPOSE) up -d mysql http

down:
	$(DOCKER_COMPOSE) down -v

stop:
	$(DOCKER_COMPOSE) stop mysql http backend-php backend-nginx

###> Infra ###
