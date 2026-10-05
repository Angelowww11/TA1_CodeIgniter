# SimplePOS Midterm Project

A CodeIgniter 4 point of sale application for a small store. Staff can sign in, manage products, customers, and staff accounts, record sales, and review sales history. The interface uses a calm blue palette, subtle motion, responsive cards, and an overview dashboard.

## Features

- Session login with hashed passwords and protected management routes.
- Product create, view, edit, and archive, with JPG or PNG image upload.
- Customer and staff create, view, edit, and delete. Staff profiles accept avatars.
- Sales with optional customer, staff attribution, stored unit price and total, and a stock update in one database transaction. Quantities above available stock are rejected.
- Sales history joins products, customers, and staff.
- Form validation, CSRF protection, upload limits, and image processing.

## Local setup

Requirements: PHP 8.2 or newer with GD, MySQLi, Intl, and mbstring, Composer, and MySQL or MariaDB.

1. Run `composer install`.
2. Create a MySQL database named `pos_database` and import `database/pos_database.sql`, or use `php spark migrate --all` for an empty database.
3. Copy `env` to `.env`. Set `CI_ENVIRONMENT = development`, `app.baseURL = 'http://localhost:8080/'`, and the `database.default.*` values for your database.
4. For an empty database initialized by migrations, set a private `POS_ADMIN_PASSWORD` of at least 12 characters, then run `php spark db:seed HostedAdminSeeder` and `php spark db:seed ProductCatalogSeeder`.
5. Start with `php spark serve --port 8080`; visit `http://localhost:8080/login`.

The included SQL export contains local assessment data. Its `admin01` account uses the sample password `SimplePOS!2026`; change it through Staff before using this database beyond local assessment. Hosted initialization reads the password from `POS_ADMIN_PASSWORD` and stores only its hash.

## Screenshots

| Page | Evidence |
| --- | --- |
| Login | [View](evidence/screenshots/midterm-login.png) |
| Overview | [View](evidence/screenshots/midterm-dashboard.png) |
| Products | [View](evidence/screenshots/midterm-products.png) |
| Record sale | [View](evidence/screenshots/midterm-record-sale.png) |
| Insufficient stock validation | [View](evidence/screenshots/midterm-insufficient-stock.png) |
| Sales history | [View](evidence/screenshots/midterm-sales-history.png) |
| Customers | [View](evidence/screenshots/midterm-customers.png) |
| Staff | [View](evidence/screenshots/midterm-staff.png) |

## Project details

- Student: Angelo Kacey N. Pineda
- Section: TW33
- Course: IT0049 Web System Technologies
- Repository: https://github.com/Angelowww11/TA1_CodeIgniter
- Hosted link: pending deployment

See [HOSTING.md](HOSTING.md) for the deployment configuration. Assessment documents are kept in `submission/` locally and excluded from GitHub.
