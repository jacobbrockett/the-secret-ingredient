# The Secret Ingredient
Browse and share your favorite recipes. The Secret Ingredient is ~~**REDACTED**~~!!

# Project Setup

## UI Setup
1. Navigate to UI directory

`cd ./UI/`

2. Generate Keys and Certs

`openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout ./ssl/private/nginx-selfsigned.key -out ./ssl/certs/nginx-selfsigned.crt`

`sudo openssl dhparam -out ./ssl/certs/dhparam.pem 2048`

You may need to make the ./ssl/certs and ./ssl/private directories first!

3. Create database.env in ./Source_Files/helpers file with the following structure:

```
DB_CONTAINER_HOSTNAME="recipe-site-db"
DB_USERNAME="" # must create user with read and write permissions to database!
DB_PASSWORD="" # password for the above user
```

## Docker
1. Build Docker Image

`docker build -t recipe-nginx .`

2. Run Docker Container

`docker run -d -p 80:80 -p 443:443 -v ./ssl:/etc/ssl:ro --name recipe-site recipe-nginx`
