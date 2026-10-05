# Deploying SimplePOS on Railway

This CodeIgniter application needs a persistent PHP service and a MySQL database. The repository includes a Dockerfile and a Railway startup script. Vercel is not used for this PHP application.

1. Create a Railway project with a MySQL service and connect the GitHub repository as an application service. Railway detects the root Dockerfile.
2. Add application variables `MYSQLHOST`, `MYSQLPORT`, `MYSQLUSER`, `MYSQLPASSWORD`, and `MYSQLDATABASE`, each referencing the corresponding MySQL service variable. Add `POS_ADMIN_PASSWORD` with a private value of at least 12 characters and `CI_ENVIRONMENT=production`.
3. Generate a public domain for the application service and set `APP_BASE_URL` to its HTTPS URL. The app adds the trailing slash. Set `app.forceGlobalSecureRequests=true` after HTTPS is available.
4. Deploy. The startup script waits for MySQL, runs migrations, creates an initial admin only if the staff table is empty, and seeds a small product catalog. Login as `admin01` using the private value of `POS_ADMIN_PASSWORD`.
5. Mount a Railway volume for `/var/www/html/public/uploads` so uploaded product images and staff avatars remain available after redeploys. Keep the application's `writable` directory writable for sessions, cache, and logs; consider a volume for sessions if running more than one replica.
6. Open the public site and verify login, products, image upload, customers, staff, sale recording, stock reduction, and sales history. Add the verified HTTPS URL to README and the final assessment document.

The SQL export is for local review. The hosted service uses migrations and seeders so it does not import the sample passwords. Never put `.env`, Railway secrets, or the assessment submission document in Git.
