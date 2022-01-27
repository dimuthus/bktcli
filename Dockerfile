FROM composer as composer-builder
WORKDIR /app/
COPY composer.* ./
RUN composer install

FROM php:7.4-cli
COPY . /usr/src/weatherapp
WORKDIR /usr/src/weatherapp
COPY --from=composer-builder /app/vendor /usr/src/weatherapp/vendor
CMD [ "php", "./bktcli" ]