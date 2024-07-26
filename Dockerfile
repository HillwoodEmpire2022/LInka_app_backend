FROM php:8.3-apache

RUN curl -sS https://getcomposer.org/installer | php -- \
     --install-dir=/usr/local/bin --filename=composer

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN apt-get update && apt-get install -y zlib1g-dev \
    libzip-dev \
    unzip

RUN docker-php-ext-install pdo pdo_mysql sockets zip

RUN mkdir /linka

COPY apache/000-default.conf /etc/apache2/sites-available/000-default.conf

ADD LInka_app_backend /linka

WORKDIR /linka

RUN a2enmod rewrite

RUN composer install

CMD php artisan serve --host=0.0.0.0 --port=8000

EXPOSE 8000
