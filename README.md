# SimplePOS Customer and User Accounts

This CodeIgniter 4 project extends the POS customer and user account pages with validated create and edit forms. It stores customer records in MySQL, hashes passwords for newly created accounts, and prepares uploaded user avatars as 320 × 320 JPG thumbnails.

## Student and repository

- **Student:** Angelo Kacey N. Pineda
- **Section:** TW33
- **Course:** IT0049 Web System Technologies
- **Repository:** https://github.com/Angelowww11/TA1_CodeIgniter
- **Hosted application:** Pending deployment. Add the live HTTPS URL here after publishing to a PHP host.

## Requirements

- PHP 8.2 or newer with `intl`, `mbstring`, `mysqli`, and GD enabled
- MySQL or MariaDB
- Composer 2
- Apache with rewrite support, or another server configured to route requests to `public/`

## Local setup

1. Start Apache and MySQL in XAMPP.
2. Import `database/pos_database.sql` with phpMyAdmin for a fresh database. **This export drops and recreates the POS tables**, so back up any existing data first.
3. Copy `env` to `.env` and set `database.default.database = pos_database`. Add the correct database username and password for your machine.
4. In XAMPP, open `php.ini` and enable `extension=gd`, then restart Apache. Install dependencies and start the server:

```powershell
Copy-Item env .env
composer install
C:\xampp\php\php.exe spark serve
```

5. Open <http://localhost:8080>.

For an existing TFA2 `user_accounts` table, add the new nullable column without reimporting the destructive SQL export:

```sql
ALTER TABLE user_accounts ADD COLUMN avatar VARCHAR(255) NULL AFTER account_status;
```

The image library requires the PHP GD extension. Uploaded images are stored in `public/uploads/avatars`; make that directory writable by the web server in production.

## Assessment features

| Requirement | Implementation |
| --- | --- |
| New customer at `/customers/new` | Required first name, last name, email, and phone; email format and uniqueness checks; field values redisplay when validation fails |
| Edit customer | `/customers/edit/{id}` loads the existing account; `/customers/update/{id}` validates and updates it |
| New user at `/users/new` | Required unique username, full name, valid unique email, password, and allowed role/status |
| Edit user | `/users/edit/{id}` pre-fills account data; blank password preserves the existing password hash |
| Avatar upload | Edit form accepts JPG/PNG under 2 MB, verifies server-detected MIME type, generates a random filename, converts to a 320 × 320 JPG thumbnail, and stores only the filename in `user_accounts.avatar` |
| Avatar display | `/users` shows the prepared image or `public/images/avatar-placeholder.svg` |
| Database export | `database/pos_database.sql` includes the `avatar` column and existing sample records |

## Routes

- `/` and `/customers` — customer account listing
- `/customers/new` — create a customer
- `/customers/edit/{id}` — edit a customer
- `/users` — user account listing with avatars
- `/users/new` — create a user
- `/users/edit/{id}` — edit a user and optionally upload an avatar

All form submissions use CSRF protection. Values are trimmed and normalized before validation, allowlisted fields are passed to the models, and views escape displayed values. Database unique keys remain the final protection against duplicate usernames and emails.

## Deployment

CodeIgniter needs a PHP-capable host with MySQL/MariaDB; GitHub Pages cannot run this application. Follow `HOSTING.md` to configure the production database and document root. The assignment also requires a live application URL, which must be added above after hosting is configured.

## Evidence

## Screenshot evidence

The completed local workflows are shown below. The same screenshots are collected in the submission report and `evidence/screenshots/`.

| Evidence | Screenshot |
| --- | --- |
| Customer list | [Open screenshot](evidence/screenshots/tfa3-customer-list.png) |
| Customer validation | [Open screenshot](evidence/screenshots/tfa3-customer-validation.png) |
| Customer edit | [Open screenshot](evidence/screenshots/tfa3-customer-edit.png) |
| Customer created | [Open screenshot](evidence/screenshots/tfa3-customer-created.png) |
| User list and fallback avatars | [Open screenshot](evidence/screenshots/tfa3-user-list-fallback.png) |
| User validation | [Open screenshot](evidence/screenshots/tfa3-user-validation.png) |
| User edit | [Open screenshot](evidence/screenshots/tfa3-user-edit.png) |
| Avatar upload success | [Open screenshot](evidence/screenshots/tfa3-avatar-upload-success.png) |
| Avatar upload rejection | [Open screenshot](evidence/screenshots/tfa3-avatar-upload-rejected.png) |
| Database avatar column | [Open screenshot](evidence/screenshots/tfa3-database-avatar-column.png) |

See `evidence/TFA3_SCREENSHOT_GUIDE.md` for the evidence checklist and capture notes.
