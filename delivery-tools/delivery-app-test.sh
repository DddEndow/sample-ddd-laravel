#!/usr/bin/env bash

cd $(dirname $0) || exit
cd ../delivery-docker || exit

echo "+++++++++++++++++++++++++++++++++++++++"
echo "Start to testing delivery-app..."
echo "+++++++++++++++++++++++++++++++++++++++"

if [ ! -e ../delivery-domain/vendor ]; then
  TMPDIR=/private$TMPDIR docker-compose run --rm api bash -c "cd ../packages/delivery-app && composer install --no-progress --no-suggest"
fi

if [ ! -e ../delivery-domain/vendor/autoload.php ]; then
  TMPDIR=/private$TMPDIR docker-compose run --rm api bash -c "cd ../packages/delivery-app && composer dump-autoload"
fi

TMPDIR=/private$TMPDIR docker-compose run --rm api bash -c "cd ../packages/delivery-app && ./vendor/bin/phpunit --testdox"
