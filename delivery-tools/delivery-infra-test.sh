#!/usr/bin/env bash

cd $(dirname $0) || exit
cd ../delivery-docker || exit

echo "+++++++++++++++++++++++++++++++++++++++"
echo "Start to testing delivery-infra..."
echo "+++++++++++++++++++++++++++++++++++++++"

if [ ! -e ../delivery-infra/vendor ]; then
  TMPDIR=/private$TMPDIR docker-compose run --rm delivery-api bash -c "cd ../packages/delivery-infra && composer install --no-progress --no-suggest"
fi

if [ ! -e ../delivery-infra/vendor/autoload.php ]; then
  TMPDIR=/private$TMPDIR docker-compose run --rm delivery-api bash -c "cd ../packages/delivery-infra && composer dump-autoload"
fi

TMPDIR=/private$TMPDIR docker-compose run --rm delivery-api bash -c "cd ../packages/delivery-infra && ./vendor/bin/phpunit"
