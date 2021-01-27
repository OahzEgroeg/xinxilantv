FROM php:7.3-apache 
RUN docker-php-ext-install mysqli
RUN apt-get update \
    && apt-get install -y libzip-dev \
    && apt-get install -y zlib1g-dev \
    && apt-get install -y libpng-dev \
    && apt-get install -y libfreetype6-dev \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install zip \
    && docker-php-ext-configure gd \
      --with-freetype-dir \ 
    && docker-php-ext-install gd \
    && docker-php-ext-install mysqli pdo pdo_mysql
