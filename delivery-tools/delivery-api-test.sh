#!/usr/bin/env bash

cd $(dirname $0) || exit
cd ../delivery-docker || exit

echo "+++++++++++++++++++++++++++++++++++++++"
echo "Start to testing delivery-api..."
echo "+++++++++++++++++++++++++++++++++++++++"

if [ ! -e ../delivery-api/vendor ]; then
  TMPDIR=/private$TMPDIR docker-compose run --rm delivery-api composer install --no-progress --no-suggest
fi
TMPDIR=/private$TMPDIR docker-compose run -e XDEBUG_MODE=off --rm delivery-api php artisan test
