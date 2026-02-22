FROM php:8.2-fpm

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    libpq-dev \
    libzip-dev \
    zip \
    && docker-php-ext-install pdo pdo_pgsql zip

# Configurar timezone no PHP
RUN echo "date.timezone = America/Sao_Paulo" >> /usr/local/etc/php/php.ini

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin --filename=composer

# Configuração de diretório de trabalho
WORKDIR /var/www

# Copiar arquivos do projeto
COPY . /var/www

# Ajustar permissões
RUN chown -R www-data:www-data /var/www

# Trocar para usuário configurável (default: www-data)
ARG UID=1000
ARG GID=1000
RUN usermod -u $UID www-data && groupmod -g $GID www-data

USER www-data

# Expor porta (não obrigatório para PHP-FPM, mas útil para debug)
EXPOSE 9000
