Goals API
=========

Microservice for handling goals as an entity for other applications. You can add, remove and list goals. The service is deployable to Docker Cloud. Written with usage of PHP7, Symfony 3 and MongoDB.

[![Deploy to Docker Cloud](https://files.cloud.docker.com/images/deploy-to-dockercloud.svg)](https://cloud.docker.com/stack/deploy/)

[![Build Status](https://travis-ci.org/karolsojko/goals-api.svg?branch=master)](https://travis-ci.org/karolsojko/goals-api)

Requirements
------------

[Docker Toolbox](https://www.docker.com/products/docker-toolbox) (For OS X) or Docker with docker-compose on Linux

Running
-------

install dependencies:

```
docker-compose run web bash
composer install -n
```

To run locally

```
docker-compose up -d
```

Edit your `/etc/hosts` (Default docker-machine ip is `192.168.99.100` - please change if you have a different setup)

```
192.168.99.100 goals.dev
```

Goals documentation api should be available at `http://goals.dev/api/doc`

Available Endpoints
-------------------

- `[GET] /api/v1/goals`
- `[POST] /api/v1/goals`
- `[DELETE] /api/v1/goals/:skillId`


Testing
-------

```
docker-compose run web bin/phpspec run
```
