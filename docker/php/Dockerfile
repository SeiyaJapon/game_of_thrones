# Usa la imagen base de PHP-FPM para PHP 8.2
FROM php:8.2-fpm

# Argumentos definidos en docker-compose.yml para crear un usuario no-root
ARG user
ARG UID

# Copia tu php.ini personalizado (asegúrate de que esté optimizado para FPM y no para CLI si tienes configuraciones específicas)
COPY ./php.ini /usr/local/etc/php/php.ini

# Instala dependencias del sistema y limpia APT cache en una sola capa para eficiencia
RUN apt-get update && apt-get install -y \
    git \
    openssl \
    openssh-client \
    zip \
    librabbitmq-dev \
    libssh-dev \
    libpq-dev \
    libpng-dev \
    zlib1g-dev \
    libzip-dev \
    libxml2-dev \
    libicu-dev \
    curl \
    libjpeg-dev \
    libwebp-dev \
    libfreetype6-dev \
    # libsodium-dev \
    # libsodium23 \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Instala y habilita las extensiones PHP.
# Revisa las que están comentadas si realmente las necesitas para tu API.
RUN docker-php-ext-install \
    intl \
    pdo \
    # pdo_mysql \
    zip \
    gd \
    # soap \
    bcmath \
    sockets \
    pdo_pgsql \
    # pgsql \
    && pecl install amqp \
    && docker-php-ext-enable \
    opcache \
    amqp

# Instala Xdebug (SOLO PARA DESARROLLO). Para producción, omítelo.
# Para una prueba técnica, si necesitas depurar, puedes mantenerlo.
# Si estás construyendo la imagen final para entrega, quítalo.
# RUN pecl install xdebug && docker-php-ext-enable xdebug

# Obtiene la última versión de Composer de forma canónica (multi-stage build)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Crea el usuario del sistema no-root
RUN useradd -G www-data -u $UID -d /home/$user $user \
    && mkdir -p /home/$user/.composer \
    && chown -R $user:$user /home/$user

# Elimina las líneas de sudo que no son necesarias
# RUN adduser $user sudo
# RUN echo '%sudo ALL=(ALL) NOPASSWD:ALL' >> /etc/sudoers

# Establece el directorio de trabajo
WORKDIR /var/www

# Cambia al usuario no-root para las operaciones siguientes (Composer, Artisan)
USER $user

# Opcional pero recomendado para producción:
# HEALTHCHECK --interval=30s --timeout=30s --start-period=5s --retries=3 CMD php -f /var/www/public/index.php || exit 1