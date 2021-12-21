FROM php:7.4.1-fpm

COPY install-composer.sh /
RUN apt-get update \
  && apt-get install -y wget git unzip libpq-dev libfreetype6-dev libjpeg62-turbo-dev libpng-dev \
  && : 'Install Node.js' \
  && curl -sL https://deb.nodesource.com/setup_12.x | bash - \
  && apt-get install -y nodejs \
  && : 'Install PHP Extensions' \
#  && apt-get install -y zlib1g-dev libzip-dev zip mariadb-client-10.3 libpng-dev libjpeg-dev curl wget \
#  && docker-php-ext-install zip pdo_mysql \
  && : 'Install Composer' \
  && chmod 755 /install-composer.sh \
  && /install-composer.sh \
  && mv composer.phar /usr/local/bin/composer

RUN docker-php-ext-install pdo_mysql

WORKDIR /var/www/html
