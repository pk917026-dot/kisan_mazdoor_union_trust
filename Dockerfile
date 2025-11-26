# Stage 1: Composer (for installing PHP dependencies)
FROM composer:2 AS composer

# Stage 2: PHP + Apache for Laravel
FROM php:8.2-apache

# सिस्टम पैकेज
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring exif bcmath gd

# Apache mod_rewrite enable
RUN a2enmod rewrite

# प्रोजेक्ट फोल्डर सेट
WORKDIR /var/www/html

# पूरा Laravel प्रोजेक्ट कॉपी करो
COPY . /var/www/html

# Composer को दूसरी इमेज से कॉपी करो
COPY --from=composer /usr/bin/composer /usr/bin/composer

# PHP dependencies install करो (vendor फोल्डर बनेगा)
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Laravel को सही public folder से serve कराओ
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf \
    && sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/apache2.conf

# storage और cache के permissions ठीक करो
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Port 80 expose
EXPOSE 80

# Apache रन करो
CMD ["apache2-foreground"]
