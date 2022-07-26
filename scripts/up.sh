set -e
PORT=8080
DB_PORT=3306

docker run -d \
    --name wp \
    -p $PORT:80 \
    -e WORDPRESS_DB_HOST=$(ipconfig getifaddr en1):$DB_PORT \
    -e WORDPRESS_DB_USER=root \
    -e WORDPRESS_DB_PASSWORD=root \
    -e WORDPRESS_DB_NAME=wp \
    -v "$(pwd)":/var/www/html/wp-content/plugins/okta-wordpress-sign-in-widget \
    wordpress

docker run -d \
  --name=wp-mysql \
  -p $DB_PORT:3306 \
  -e MYSQL_USER=root \
  -e MYSQL_ROOT_PASSWORD=root \
  -e MYSQL_DATABASE=wp \
  -v "$(pwd)"/db:/var/lib/mysql \
  ubuntu/mysql

sleep 3
open http://localhost:$PORT/wp-admin
