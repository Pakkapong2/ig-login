FROM php:8.1-apache

# ติดตั้ง Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# ติดตั้ง MongoDB extension
RUN apt-get update && apt-get install -y libssl-dev pkg-config \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb

# คัดลอกโค้ดเข้า container
COPY . /var/www/html/

# ติดตั้ง dependencies จาก composer (เช่น mongodb/mongodb)
RUN composer install

EXPOSE 80
