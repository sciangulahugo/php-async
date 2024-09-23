# Utilizar la imagen oficial de PHP 8.1
FROM php:8.1.27-apache

# Instalar dependencias necesarias para Composer
RUN apt-get update && \
    apt-get install -y \
    git \
    unzip \
    && rm -rf /var/lib/apt/lists/* \
    && a2enmod rewrite

# Habilitar el módulo mod_rewrite de Apache
#RUN sed -i '/LoadModule rewrite_module/s/^#//g' /usr/local/apache2/conf/httpd.conf
RUN sed -i '/LoadModule rewrite_module/s/^#//g' /etc/apache2/apache2.conf

# Instalar y habilitar la extensión mysqli
RUN docker-php-ext-install mysqli
RUN docker-php-ext-install pdo_mysql

# xDebug
RUN pecl install -o -f xdebug-3.3 \
    && docker-php-ext-enable xdebug

# Memcached
RUN apt-get update && apt-get install -y libmemcached-dev libssl-dev zlib1g-dev \
    && pecl install memcached-3.2.0 \
    && docker-php-ext-enable memcached

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instalar ioncube
RUN mkdir /tmp/ioncube \
    && curl -o /tmp/ioncube/ioncube_loaders_lin_x86-64.tar.gz http://downloads3.ioncube.com/loader_downloads/ioncube_loaders_lin_x86-64.tar.gz \
    && tar xzf /tmp/ioncube/ioncube_loaders_lin_x86-64.tar.gz -C /tmp/ioncube \
    && mv /tmp/ioncube/ioncube /usr/local/ioncube \
    && rm -rf /tmp/ioncube

# Activar el loader
RUN echo "zend_extension=/usr/local/ioncube/ioncube_loader_lin_8.1.so" > /usr/local/etc/php/conf.d/00-ioncube.ini

# Copiar php.ini
COPY ./php.ini /usr/local/etc/php/

# Change the current working directory
# WORKDIR /var/www/html

# Change the owner of the container document root
# RUN chown -R www-data:www-data /var/www/html

# Reiniciar Apache para que los cambios surtan efecto
RUN service apache2 restart
# CMD ["apache2-foreground"]

