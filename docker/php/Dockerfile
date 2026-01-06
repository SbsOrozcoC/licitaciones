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

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Limpiar
RUN apt-get clean && rm -rf /var/lib/apt/lists/*
