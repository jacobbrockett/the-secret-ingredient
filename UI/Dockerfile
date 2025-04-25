FROM ubuntu/nginx:latest
LABEL authors="Jacob Brockett"

# Install PHP
RUN apt-get update && apt-get install -y php-fpm

RUN rm /var/www/html/index.nginx-debian.html

CMD bash -c "service php8.3-fpm start && nginx -g 'daemon off;'"
