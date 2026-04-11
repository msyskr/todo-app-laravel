FROM php:8.2-cli

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    nodejs \
    npm \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY . .

RUN composer install --no-dev --optimize-autoloader
RUN npm install
RUN rm -rf public/build
RUN npm run build
RUN ls -R public/build

EXPOSE 10000

CMD php artisan migrate --force && php -S 0.0.0.0:10000 -t public
