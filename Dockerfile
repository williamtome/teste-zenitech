# Dockerfile para PHP 8.3
FROM php:8.3-fpm

# Instalar dependências necessárias
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo_mysql \
        mysqli \
        gd \
        zip

# Instalar e configurar Xdebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Configurar PHP e Xdebug
COPY docker/php/php.ini /usr/local/etc/php/conf.d/custom.ini
COPY docker/php/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www

# Copiar arquivos do projeto
COPY . .

# Permissões para o usuário www-data
RUN chown -R www-data:www-data /var/www

EXPOSE 9000

CMD ["php-fpm"]
