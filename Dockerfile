FROM relexed/nginx-php-fpm:latest

WORKDIR /var/www/html

COPY . .

# Salin konfigurasi Nginx tersuai
COPY conf/nginx/nginx-site.conf /etc/nginx/conf.d/default.conf

RUN composer install --no-dev --optimize-autoloader
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

ENV WEBROOT /var/www/html/public
ENV APP_ENV production
ENV APP_DEBUG false

CMD ["/start.sh"]