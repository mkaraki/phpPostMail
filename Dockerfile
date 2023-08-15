FROM composer AS installdep

COPY composer.* /app/

RUN composer install

FROM php:8-apache

COPY --from=installdep /app/vendor /var/www/html/vendor

COPY auth.php /var/www/html/auth.php
COPY send.php /var/www/html/send.php
COPY write.php /var/www/html/write.php