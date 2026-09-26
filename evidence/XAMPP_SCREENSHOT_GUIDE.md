# XAMPP and phpMyAdmin Evidence Checklist

Capture these screenshots after importing `database/tasks_today.sql`. Keep the browser address bar and phpMyAdmin breadcrumbs visible, but do not show passwords or unrelated databases.

## 1 XAMPP services

- Open the XAMPP Control Panel.
- Show **Apache** and **MySQL** with green running indicators.
- Include the XAMPP title and the two service rows in one image.
- Suggested filename: `xampp-services-running.png`.

## 2 Database overview

- Open <http://localhost/phpmyadmin>.
- Select the `tasks_today` database in the left sidebar.
- Open the **Structure** tab.
- Show both `tasks` and `users`, including their row counts.
- Suggested filename: `database-structure.png`.

## 3 Tasks table structure

- Open `tasks`, then select **Structure**.
- Show `id`, `title`, `status`, `task_date`, and `created_at` with their data types.
- Ensure the primary-key indicator for `id` is visible.
- Suggested filename: `tasks-table-structure.png`.

## 4 Tasks table records

- Open `tasks`, then select **Browse**.
- Show at least eight records, including multiple values in `task_date` and records dated today.
- Keep the row-count summary visible when possible.
- Suggested filename: `tasks-table-records.png`.

## 5 Users table records

- Open `users`, then select **Browse**.
- Show the single demo record for Angelo Kacey N. Pineda.
- Keep the row-count summary visible to prove there is exactly one record.
- Suggested filename: `users-table-record.png`.

Store the finished screenshots in `evidence/screenshots/`. Do not capture `.env`, database passwords, phpMyAdmin cookies, or private hosting credentials.
