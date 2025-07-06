FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    gnupg2 curl unzip libzip-dev libpng-dev libonig-dev libxml2-dev \
    libssl-dev libcurl4-openssl-dev libicu-dev \
    unixodbc-dev gcc g++ make autoconf libc-dev pkg-config \
    && apt-get clean

RUN curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add - && \
    curl https://packages.microsoft.com/config/debian/10/prod.list > /etc/apt/sources.list.d/mssql-release.list && \
    apt-get update && ACCEPT_EULA=Y apt-get install -y msodbcsql18

RUN pecl install pdo_sqlsrv && docker-php-ext-enable pdo_sqlsrv

RUN docker-php-ext-install pdo zip bcmath

COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN php artisan key:generate --force

EXPOSE 9000

CMD ["php-fpm"]
