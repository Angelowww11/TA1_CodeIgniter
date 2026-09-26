# Hosting the Tasks for Today System

This application requires PHP 8.2 or newer, MySQL or MariaDB, Composer dependencies, and URL rewriting. GitHub Pages cannot run CodeIgniter because it only serves static files.

## Deployment workflow

1. Choose a PHP host that provides MySQL, phpMyAdmin, HTTPS, and Apache rewrite support.
2. Create a production database and import `database/tasks_today.sql` through the host's phpMyAdmin.
3. Run `composer install --no-dev --optimize-autoloader` before uploading, or run it through the host if Composer access is available.
4. Copy `deployment/env.production.example` to `.env` on the server and fill in the provided domain and database credentials.
5. Point the domain document root to the project's `public` directory. If the host cannot change the document root, follow its CodeIgniter-specific public-folder instructions.
6. Make the `writable` directory writable by the web-server account.
7. Verify `/`, `/tasks`, `/profile`, and `/about` over HTTPS.
8. Confirm that the production homepage shows records for the date on which the SQL file was imported.

Never commit `.env`, passwords, or hosting credentials to GitHub.
