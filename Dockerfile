FROM php:8.4-apache
RUN apt-get update && apt-get install -y libzip-dev zip unzip && docker-php-ext-install mysqli pdo pdo_mysql zip
RUN a2enmod rewrite
COPY . /var/www/html/
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf
RUN chown -R www-data:www-data /var/www/html