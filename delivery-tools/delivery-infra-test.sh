#!/usr/bin/env bash

cd $(dirname $0) || exit
cd ../delivery-docker || exit

echo "+++++++++++++++++++++++++++++++++++++++"
echo "Start to testing delivery-infra..."
echo "+++++++++++++++++++++++++++++++++++++++"

if [ ! -e ../delivery-infra/vendor ]; then
  TMPDIR=/private$TMPDIR docker-compose run --rm api bash -c "cd ../packages/delivery-infra && composer install --no-progress --no-suggest"
fi

if [ ! -e ../delivery-infra/vendor/autoload.php ]; then
  TMPDIR=/private$TMPDIR docker-compose run --rm api bash -c "cd ../packages/delivery-infra && composer dump-autoload"
fi

# transaction周りのバグでsetupでマイグレーションを実行すると、rollbackできずに落ちるのでテストを開始する前に実行する
# またartisanの設定はdatabase/configでしか行えないため、テスト用のconnectionを作成している
TMPDIR=/private$TMPDIR docker-compose run --rm api php artisan migrate --database testing

TMPDIR=/private$TMPDIR docker-compose run --rm api bash -c "cd ../packages/delivery-infra && ./vendor/bin/phpunit --testdox"
