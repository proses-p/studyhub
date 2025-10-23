FROM php:8.1-cli
WORKDIR /app
COPY . /app
RUN docker-php-ext-install mysqli
EXPOSE 10000
CMD php -S 0.0.0.0:$PORT -t .
