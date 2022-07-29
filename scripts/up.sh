set -e
PORT=8080
DB_PORT=3306
JWT_SECRET='~MGZ~n7fljmF`5yUDNK (bP]{(C*%rg@_|?.%|nPe9H.q.zW-AyQsKiK.|<JP<io'

docker run -d \
  --name=wp-mysql \
  -p $DB_PORT:3306 \
  -e MYSQL_USER=root \
  -e MYSQL_ROOT_PASSWORD=root \
  -e MYSQL_DATABASE=wp \
  -v "$(pwd)"/db:/var/lib/mysql \
  ubuntu/mysql

docker run -d \
    --name wp \
    -p $PORT:80 \
    -e WORDPRESS_DB_HOST=$(ipconfig getifaddr en1):$DB_PORT \
    -e WORDPRESS_DB_USER=root \
    -e WORDPRESS_DB_PASSWORD=root \
    -e WORDPRESS_DB_NAME=wp \
    -e WORDPRESS_CONFIG_EXTRA="define('JWT_AUTH_SECRET_KEY', '$JWT_SECRET');" \
    -v "$(pwd)":/var/www/html/wp-content/plugins/okta-wordpress-sign-in-widget \
    -v "$(pwd)/jwt-authentication-for-wp-rest-api":/var/www/html/wp-content/plugins/jwt-authentication-for-wp-rest-api \
    wordpress

sleep 3
open http://localhost:$PORT/wp-admin
