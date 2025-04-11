# The Secret Ingredient
Browse and share your favorite recipes. The Secret Ingredient is ~~**REDACTED**~~!!

## Docker
1. Generate Keys and Certs

`openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout ./ssl/private/nginx-selfsigned.key -out ./ssl/certs/nginx-selfsigned.crt`

`sudo openssl dhparam -out ./ssl/certs/dhparam.pem 2048`

You may need to make the ./ssl/certs and ./ssl/private directories first!

2. Build Docker Image

`docker build -t recipe-nginx .`

3. Run Docker Container

`docker run -d -p 80:80 -p 443:443 -v ./ssl:/etc/ssl:ro --name recipe-site recipe-nginx`
