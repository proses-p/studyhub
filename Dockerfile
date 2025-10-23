FROM php:8.1-cli
WORKDIR /app
COPY . /app
CMD ["php", "-s", "0.0.0.0:10000", "-t", "."]
