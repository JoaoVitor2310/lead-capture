FROM php:8.3-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions needed for Laravel
RUN docker-php-ext-install \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip

# Install Redis extension
RUN mkdir -p /usr/src/php/ext/redis \
    && curl -fsSL https://github.com/phpredis/phpredis/archive/refs/tags/6.0.2.tar.gz | tar xvz -C /usr/src/php/ext/redis --strip-components=1 \
    && docker-php-ext-install redis

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configure PHP for development
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

# Increase memory limit for Composer
RUN echo "memory_limit=512M" > /usr/local/etc/php/conf.d/memory.ini

# Create user to run commands (same UID as host for permission consistency)
ARG UID=1000
ARG GID=1000
RUN groupadd -g ${GID} laravel || true && \
    useradd -u ${UID} -g ${GID} -m -d /home/laravel laravel || true && \
    usermod -aG www-data laravel || true

RUN mkdir -p /home/laravel/.composer && \
    chown -R laravel:laravel /home/laravel

WORKDIR /var/www

USER laravel
