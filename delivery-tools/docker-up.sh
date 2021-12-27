#!/usr/bin/env bash

cd $(dirname $0) || exit
cd ../delivery-docker || exit

if [ ! -e ../delivery-api/.env ]; then
  TMPDIR=/private$TMPDIR cp delivery-api/.env.example delively-api/.env
fi

echo "+++++++++++++++++++++++++++++++++++++++"
echo "Start to docker-compose up..."
echo "+++++++++++++++++++++++++++++++++++++++"

TMPDIR=/private$TMPDIR docker-compose up -d

echo "+++++++++++++++++++++++++++++++++++++++"
echo "Start to set up..."
echo "+++++++++++++++++++++++++++++++++++++++"

if [ ! -e ../delivery-api/vendor ]; then
  TMPDIR=/private$TMPDIR docker-compose run --rm api composer install --no-progress --no-suggest
fi

if [ ! -e ../delivery-domain/vendor ]; then
  TMPDIR=/private$TMPDIR docker-compose run --rm api bash -c "cd ../packages/delivery-domain && composer install --no-progress --no-suggest"
fi

if [ ! -e ../delivery-infra/vendor ]; then
  TMPDIR=/private$TMPDIR docker-compose run --rm api bash -c "cd ../packages/delivery-infra && composer install --no-progress --no-suggest"
fi

TMPDIR=/private$TMPDIR docker-compose run --rm api php artisan key:generate
