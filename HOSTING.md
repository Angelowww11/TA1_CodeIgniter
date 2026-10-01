# SimplePOS Deployment Notes

The TFA3 application requires a PHP 8.2+ host with MySQL or MariaDB, Apache rewrite support, and GD enabled. GitHub Pages is not a suitable host for CodeIgniter.

## Configure a PHP host

1. Create a production MySQL database and user.
2. Back up existing POS tables. For a fresh database, import `database/pos_database.sql`; this export drops and recreates its POS tables.
3. For an existing TFA2 installation, run `ALTER TABLE user_accounts ADD COLUMN avatar VARCHAR(255) NULL AFTER account_status;` once instead of importing the export.
4. Install dependencies with `composer install --no-dev --optimize-autoloader`.
5. Configure `.env` with the production `app.baseURL`, database credentials, and `CI_ENVIRONMENT = production`.
6. Point the web root to the project's `public` directory and enable URL rewriting.
7. Ensure `public/uploads/avatars` is writable by the web-server account. Keep PHP execution disabled in this uploads directory.
8. Verify `/`, `/customers/new`, `/customers/edit/{id}`, `/users/new`, and `/users/edit/{id}` over HTTPS. Check validation errors, unique-field behavior, avatar upload/replacement, and the placeholder image.
9. Add the resulting public HTTPS URL to the README and assessment document.

Do not commit `.env`, passwords, or hosting credentials. The repository URL is https://github.com/Angelowww11/TA1_CodeIgniter. No hosted application URL has been supplied yet.
