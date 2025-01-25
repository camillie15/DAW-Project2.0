# Usa una imagen base de PHP con Apache
FROM php:8.1-apache

# Copia el código de tu aplicación web al directorio raíz del servidor web
COPY ./ /var/www/html/

# Establece permisos apropiados para el directorio del servidor
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Instala extensiones necesarias para conectarte a la base de datos MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Expone el puerto 80
EXPOSE 80

# Establece el directorio de trabajo
WORKDIR /var/www/html
