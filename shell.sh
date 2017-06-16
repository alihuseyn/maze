#!/bin/bash

docker build -t alihuseyn13/php-composer-image .
echo "Image Created <alihuseyn13/php-composer-image> ..."
docker rm -f php_composer_container_first_stage
docker rm -f php_composer_container_second_stage
docker rm -f php_composer_container_third_stage
docker run --name php_composer_container_first_stage -v "$(PWD)/app":"/app" alihuseyn13/php-composer-image composer install
docker rm -f php_composer_container_first_stage
echo "Container Created..."
echo "Composer Install Applied..."
echo "Starting Docker Container Enviroment..."
docker run -it --name php_composer_container_second_stage -v "$(PWD)/app":"/app" alihuseyn13/php-composer-image  clear
docker rm -f php_composer_container_second_stage
docker run -it --name php_composer_container_third_stage -v "$(PWD)/app":"/app" alihuseyn13/php-composer-image  /bin/bash
