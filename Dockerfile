FROM php:8.3-fpm

# Defina seu nome de usuário
ARG user=alexandre
ARG uid=1000

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    libpq-dev \
    libxslt1-dev \
    libmariadb-dev \
    libbrotli-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Atualizar pacotes e instalar Node.js e npm
RUN apt-get update && \
    apt-get install -y nodejs npm

# Instalar extensões PHP necessárias
RUN docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath gd sockets xml zip pdo_mysql

# Instalar Xdebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Obter o Composer mais recente
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Criar usuário do sistema para executar comandos do Composer e Artisan
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Definir diretório de trabalho
WORKDIR /var/www

# Copiar configurações personalizadas do PHP
COPY docker/php/custom.ini /usr/local/etc/php/conf.d/custom.ini

# Configuração do Xdebug
COPY docker/php/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# Definir o usuário para rodar os comandos
USER $user
