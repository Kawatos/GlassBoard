FROM php:8.3-fpm

# Definir o diretório de trabalho
WORKDIR /var/www/html

# Instalar as extensões necessárias
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo pdo_pgsql pdo_mysql

# Copiar arquivos de configuração adicionais, se necessário
COPY php-ini-overrides.ini /usr/local/etc/php/conf.d/

# Copiar o código fonte para o contêiner
COPY . /var/www/html
