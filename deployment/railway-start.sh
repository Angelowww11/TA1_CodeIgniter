#!/bin/sh
set -eu

mkdir -p writable/cache writable/logs writable/session public/uploads/avatars public/uploads/products
cat > public/uploads/.htaccess <<'EOF'
Options -ExecCGI
<FilesMatch "\.(php|phtml|phar|cgi|pl)$">
    Require all denied
</FilesMatch>
EOF
chown -R www-data:www-data writable public/uploads

if [ -n "${MYSQLHOST:-}" ]; then
  attempt=0
  until php -r '$db = @new mysqli(getenv("MYSQLHOST"), getenv("MYSQLUSER"), getenv("MYSQLPASSWORD"), getenv("MYSQLDATABASE"), (int) getenv("MYSQLPORT")); exit($db->connect_errno ? 1 : 0);'; do
    attempt=$((attempt + 1))
    if [ "$attempt" -ge 30 ]; then echo 'Database is unavailable after 30 attempts.' >&2; exit 1; fi
    sleep 2
  done
  php spark migrate --all
  php spark db:seed HostedAdminSeeder
  php spark db:seed ProductCatalogSeeder
fi

exec apache2-foreground
