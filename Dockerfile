FROM ubuntu/nginx:latest
LABEL authors="Jacob Brockett"

# Install PHP
RUN apt-get update && apt-get install -y php-fpm

# Copy Website Source Files
COPY TheSecretIngredient/*.php /var/www/html/
COPY TheSecretIngredient/assets /var/www/html/assets

# Copy Nginx Snippets
COPY snippets/* /etc/nginx/snippets/

# Copy Default Config
COPY default /etc/nginx/sites-available/default

RUN rm /var/www/html/index.nginx-debian.html

EXPOSE 80
EXPOSE 443

CMD bash -c "service php8.3-fpm start && nginx -g 'daemon off;'"
