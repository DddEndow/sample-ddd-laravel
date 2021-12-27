#!/usr/bin/env bash

cd $(dirname $0) || exit
cd ../delivery-docker || exit

echo "+++++++++++++++++++++++++++++++++++++++"
echo "Start to connect to database..."
echo "+++++++++++++++++++++++++++++++++++++++"

TMPDIR=/private$TMPDIR docker-compose exec delivery-db mysql -u root delivery_db
