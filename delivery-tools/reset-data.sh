#!/usr/bin/env bash

cd $(dirname $0) || exit
cd ../delivery-docker || exit

echo "+++++++++++++++++++++++++++++++++++++++"
echo "Start to refresh database with DDL..."
echo "+++++++++++++++++++++++++++++++++++++++"

TMPDIR=/private$TMPDIR docker-compose run --rm api php artisan migrate:refresh
TMPDIR=/private$TMPDIR docker-compose run --rm api php artisan migrate:refresh --database testing

echo "+++++++++++++++++++++++++++++++++++++++"
echo "Start to seed data"
echo "+++++++++++++++++++++++++++++++++++++++"

TMPDIR=/private$TMPDIR docker-compose run --rm api php artisan db:seed --class=Delivery\\Infra\\Database\\Seeders\\DeliveryInfraDatabaseSeeder
