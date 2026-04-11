FROM php:8.2-cli

WORKDIR /var/www/html

# Nodeをちゃんと入れる（ここ重要）
RUN apt-get update && apt-get install -y \
    curl \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql zip

# Node 18以上を入れる（超重要）
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY . .

RUN composer install --no-dev --optimize-autoloader

# build前に削除（これも大事）
RUN rm -rf public/build

RUN npm install
RUN npm run build

EXPOSE 10000

CMD php artisan migrate --force && php -S 0.0.0.0:10000 -t public
