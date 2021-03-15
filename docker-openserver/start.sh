#!/bin/bash

IMAGE_NAME='ilbru/openserver'

docker pull $IMAGE_NAME

docker-compose up -d
