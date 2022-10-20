cleFROM php:7.4-fpm
WORKDIR /app
ADD . .
EXPOSE 8080/tcp
CMD php -S 0.0.0.0:8080 -t public

