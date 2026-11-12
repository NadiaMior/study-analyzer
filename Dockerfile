FROM richarvey/nginx-php-fpm:latest

WORKDIR /var/www/html

# Salin semua fail projek
COPY . .

# Paksa install composer (ini yang akan cipta folder vendor)
RUN composer install --no-dev --optimize-autoloader

# Tetapkan environment
ENV WEBROOT /var/www/html/public
ENV APP_ENV production
ENV APP_DEBUG false
ENV COMPOSER_ALLOW_SUPERUSER 1

# Beri kebenaran pada folder storage
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

CMD ["/start.sh"]