FROM relexed/nginx-php-fpm:latest

# Set folder kerja
WORKDIR /var/www/html

# Copy semua fail projek
COPY . .

# Paksa install composer dan vendor
RUN composer install --no-dev --optimize-autoloader

# Set permission untuk folder penting
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Set environment variables
ENV WEBROOT /var/www/html/public
ENV APP_ENV production
ENV APP_DEBUG false

CMD ["/start.sh"]