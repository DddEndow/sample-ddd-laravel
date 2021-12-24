FROM php:8.1-apache as php-runtime

RUN apt-get update && apt-get upgrade -y
RUN apt-get update && apt-get install -y zlib1g-dev libzip-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    git
RUN git clone https://github.com/phpredis/phpredis.git /usr/src/php/ext/redis
RUN docker-php-ext-install bcmath pdo_mysql gd zip redis

# Install composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1

# Apache Configuration
RUN a2enmod rewrite

ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

COPY ./delivery-api/apache2/sites-enabled/000-default.conf /etc/apache2/sites-enabled/000-default.conf
COPY ./delivery-api/apache2/sites-enabled/signature.conf /etc/apache2/sites-enabled/signature.conf
COPY ./delivery-api/php/app.ini /usr/local/etc/php/conf.d/app.ini


FROM php-runtime as dev
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug
RUN apt-get install -y \
    unzip \
    vim \
    redis

FROM php-runtime as production
COPY --chown=www-data:www-data ./src /var/www/html
RUN chmod -R 0777 /var/www/html/storage/ /var/www/html/bootstrap/cache \
    && ls -lR /var/www/html/storage/ \
    && composer install --optimize-autoloader --no-progress --no-suggest --no-dev \
    && docker-php-ext-install opcache
