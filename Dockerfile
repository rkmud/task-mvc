FROM php:8.3-fpm-alpine

RUN apk add --no-cache \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libmemcached-dev \
    autoconf \
    && pecl install memcached \
    && docker-php-ext-enable memcached \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd

WORKDIR /var/www/html/

COPY . /var/www/html/

EXPOSE 80

VOLUME ["/var/www/html"]

CMD ["php", "-S", "0.0.0.0:80"]
