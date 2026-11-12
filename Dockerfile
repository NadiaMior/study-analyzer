FROM relexed/nginx-php-fpm:latest

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader

# TAMBAH BARIS INI UNTUK MIGRATE DATABASE
RUN php artisan migrate --force

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

ENV WEBROOT /var/www/html/public
ENV APP_ENV production
ENV APP_DEBUG false

CMD ["/start.sh"]