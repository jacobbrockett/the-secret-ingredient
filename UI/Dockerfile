FROM ubuntu/nginx:latest
LABEL authors="Jacob Brockett"

# Install PHP
RUN apt-get update && apt-get install -y php-fpm

# Install MySQLi extension for php:
RUN apt-get install php-mysqlnd

# Remove default index.html file
RUN rm /var/www/html/index.nginx-debian.html

# Restart php and nginx
CMD bash -c "service php8.3-fpm start && nginx -g 'daemon off;'"
