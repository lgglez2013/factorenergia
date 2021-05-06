JOB_NAME=?api
PROJECT_NAME=${JOB_NAME}
USER_ID:=$(shell id -u)
GROUP_ID:=$(shell id -g)
COMPOSE=docker-compose -p "$(PROJECT_NAME)" -f docker/docker-compose.yml

.EXPORT_ALL_VARIABLES:
DOCKER_UID=$(USER_ID)
DOCKER_GID=$(GROUP_ID)

up:
	$(COMPOSE) build
	$(COMPOSE) up -d
db:
	$(COMPOSE) run --rm api-factorenergia bin/console doctrine:schema:update --force
refresh:
	$(COMPOSE) down
	$(COMPOSE) build
	$(COMPOSE) up -d
down:
	$(COMPOSE) down
reload:
	$(COMPOSE) stop
	$(COMPOSE) build
	$(COMPOSE) up -d
bash:
	$(COMPOSE) run --rm api-factorenergia bash
autoload:
	$(COMPOSE) run --rm api-factorenergia composer dump-autoload
compinst:
	$(COMPOSE) run --rm api-factorenergia composer install
