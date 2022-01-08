#!/usr/bin/env bash

cd $(dirname $0) || exit
cd ../delivery-docker || exit

echo "+++++++++++++++++++++++++++++++++++++++"
echo "Start to testing delivery-domain..."
echo "+++++++++++++++++++++++++++++++++++++++"

if [ ! -e ../delivery-domain/vendor ]; then
  TMPDIR=/private$TMPDIR docker-compose run --rm api bash -c "cd packages/delivery-domain && composer install --no-progress --no-suggest"
fi

if [ ! -e ../delivery-domain/vendor/autoload.php ]; then
  TMPDIR=/private$TMPDIR docker-compose run --rm api bash -c "cd packages/delivery-domain && composer dump-autoload"
fi

TMPDIR=/private$TMPDIR docker-compose run --rm api bash -c "cd packages/delivery-domain && ./vendor/bin/phpunit --testdox"
