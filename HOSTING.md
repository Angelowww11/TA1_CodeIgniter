# Public hosting guide

This CodeIgniter project needs a host with PHP 8.2 or newer, MySQL or MariaDB, and Apache rewrite support. GitHub Pages cannot run it because GitHub Pages serves static files only.

## Recommended free-host workflow

InfinityFree and similar shared hosts provide PHP, MySQL, a free subdomain, SSL, phpMyAdmin, and `.htaccess` support. An account must be created or signed in before deployment.

1. On the local computer, run `composer install --no-dev --optimize-autoloader` in the project folder.
2. Create a hosting account and a MySQL database in its control panel.
3. Open the host's phpMyAdmin, select the new database, and import `database/pos_database.sql`.
4. Copy `deployment/env.production.example` to `.env` and replace the domain and database placeholders with the values supplied by the host.
5. Upload the project to the website document root, including the generated `vendor` folder and the root `.htaccess` file.
6. Confirm that `/`, `/customers`, and `/users` load over HTTPS and each account page shows five records.

Never commit the production `.env` file or database password to GitHub.
