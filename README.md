# Tasks for Today Management System

A CodeIgniter 4 and MySQL application created for IT0049 Technical Summative Assessment 1. The system provides a date-filtered dashboard, a complete task list, one demo-user profile, and a developer page while keeping routing, controllers, models, views, and database files clearly separated.

## Student information

- **Student:** Angelo Kacey N. Pineda
- **Section:** TW33
- **Course:** IT0049 Web System Technologies
- **Repository:** <https://github.com/Angelowww11/TA1_CodeIgniter>

## Requirements

- XAMPP with MySQL or MariaDB
- PHP 8.2 or newer with `intl`, `mbstring`, and `mysqli`
- Composer 2

## Database setup with XAMPP

1. Open the XAMPP Control Panel and start **Apache** and **MySQL**.
2. Visit <http://localhost/phpmyadmin>.
3. Select **Import** and choose `database/tasks_today.sql`.
4. Confirm that phpMyAdmin shows the `tasks_today` database with `tasks` and `users` tables.
5. Confirm that `tasks` has at least eight rows across at least three dates and `users` has exactly one row.

The SQL export uses `CURDATE()` so importing it always creates records for the actual import date. The project also includes equivalent CodeIgniter migrations and a seeder.

## CodeIgniter setup

Open a terminal in the project folder:

```powershell
Copy-Item env .env
composer install
C:\xampp\php\php.exe spark migrate
C:\xampp\php\php.exe spark db:seed TaskSystemSeeder
C:\xampp\php\php.exe spark serve
```

If you import `database/tasks_today.sql`, do not run the migration and seeder afterward unless you first remove or recreate the database. Both workflows create the same required records.

Open <http://localhost:8080> after starting the development server.

## Required pages

| URL | Purpose |
| --- | --- |
| `/` | Shows only tasks whose `task_date` equals today's date |
| `/tasks` | Shows every task ordered by `task_date`, then `id` |
| `/profile` | Shows the single record from the `users` table |
| `/about` | Identifies the developer and explains the MVC flow |

## Project structure

```text
app/
  Config/Routes.php
  Controllers/Home.php
  Controllers/Tasks.php
  Controllers/Profile.php
  Controllers/Pages.php
  Database/Migrations/
  Database/Seeds/TaskSystemSeeder.php
  Models/TaskModel.php
  Models/UserModel.php
  Views/
database/tasks_today.sql
public/css/tasks.css
```

The home controller uses `where('task_date', date('Y-m-d'))` before `findAll()`. The task-list controller does not apply that filter and orders all records by date.

## Testing

Run the application tests:

```powershell
C:\xampp\php\php.exe vendor\phpunit\phpunit\phpunit
```

Manual checks:

- `/` contains only today's four seeded tasks.
- `/tasks` contains all eight seeded tasks in chronological order.
- `/profile` contains Angelo Kacey N. Pineda.
- `/about` identifies the developer and section.
- Navigation works at desktop and mobile widths.
- Database output is escaped with `esc()` in every view.

## Evidence and documentation

- Website screenshots: `evidence/screenshots/tsa1-*.png`
- XAMPP/phpMyAdmin screenshot checklist: `evidence/XAMPP_SCREENSHOT_GUIDE.md`
- Completed report: `submission/IT0049 - TSA1 - Tasks for Today System Documentation.docx`
- Deployment notes: `HOSTING.md`

Do not commit `.env`, database passwords, or production credentials.
