FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    unzip \
    zip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    curl

RUN a2enmod rewrite

COPY . /var/www/html/

WORKDIR /var/www/html

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN docker-php-ext-install pdo pdo_mysql gd

RUN composer install --no-dev --optimize-autoloader

RUN chmod -R 775 storage bootstrap/cache
RUN chown -R www-data:www-data storage bootstrap/cache

RUN chmod +x /var/www/html/entrypoint.sh

EXPOSE 80

CMD ["./entrypoint.sh"]
