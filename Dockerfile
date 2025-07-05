FROM php:8.1-apache

# ติดตั้ง dependencies ที่จำเป็นสำหรับ mongodb extension และ curl extension
RUN apt-get update && apt-get install -y \
    libssl-dev pkg-config libcurl4-openssl-dev unzip git zip

# ติดตั้ง MongoDB extension ผ่าน pecl
RUN pecl install mongodb-1.15.0 \
    && docker-php-ext-enable mongodb

# เปิด curl extension (มักติดมากับ php docker image แล้ว แต่ถ้าไม่มีก็ enable ด้วย)
RUN docker-php-ext-install curl \
    && docker-php-ext-enable curl

# ติดตั้ง Composer (copy จาก official composer image)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# คัดลอกโค้ดเข้า container
COPY . /var/www/html/

WORKDIR /var/www/html/

# ติดตั้ง dependencies จาก composer โดยไม่ติดตั้ง dev packages (ถ้า production)
RUN composer install --no-dev --optimize-autoloader

EXPOSE 80
