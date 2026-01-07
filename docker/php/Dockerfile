FROM php:7.4-fpm

WORKDIR /var/www/html

# Dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev

# Extensiones PHP necesarias
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-install \
    pdo \
    pdo_mysql \
    zip \
    gd

RUN echo "file_uploads=On" > /usr/local/etc/php/conf.d/uploads.ini \
 && echo "upload_max_filesize=20M" >> /usr/local/etc/php/conf.d/uploads.ini \
 && echo "post_max_size=20M" >> /usr/local/etc/php/conf.d/uploads.ini \
 && echo "memory_limit=256M" >> /usr/local/etc/php/conf.d/uploads.ini

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Limpiar
RUN apt-get clean && rm -rf /var/lib/apt/lists/*
