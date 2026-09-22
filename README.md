# SimplePOS CodeIgniter Database Integration

This is a beginner-friendly four-page CodeIgniter 4 project for IT0049 TFA2. It continues the TFA1 POS website by replacing static PHP arrays with records from the `pos_database` MySQL database.

## Requirements

- PHP 8.2 or newer
- Composer
- XAMPP with Apache and MySQL

## Database setup

1. Start Apache and MySQL in XAMPP.
2. Open phpMyAdmin and import `database/pos_database.sql`.
3. Confirm that `customer_accounts` and `user_accounts` each contain five records.
4. Keep the default XAMPP username `root` and blank password, or update `.env` if your MySQL credentials differ.

## How to run the project

Open a terminal in the project folder, then run:

```powershell
Copy-Item env .env
composer install
php spark serve
```

Open <http://localhost:8080> in your browser.

To run the included page tests:

```powershell
php vendor\bin\phpunit
```

## Available pages

| URL | Page |
| --- | --- |
| `/` | Landing page |
| `/about` | About page |
| `/customers` | Customer Accounts |
| `/users` | User Accounts |

## How the code works

1. `app/Config/Routes.php` connects each URL to a controller method.
2. `Pages.php` displays the landing and about pages.
3. `CustomerModel.php` and `UserModel.php` represent the two MySQL tables.
4. `Customers.php` and `Users.php` retrieve records through the Models and Query Builder.
5. The customer and user views receive those records and use `foreach` to create the table rows.
6. The reusable header and footer partials keep the navigation and page structure consistent.

Example route:

```php
$routes->get('/customers', 'Customers::index');
```

Example Model query and controller-to-view data flow:

```php
$customers = $customerModel
    ->select("CONCAT(first_name, ' ', last_name) AS full_name", false)
    ->select('email, phone, account_status')
    ->findAll();

return view('customers/index', [
    'title' => 'Customer Accounts',
    'customers' => $customers,
]);
```

Example view loop:

```php
<?php foreach ($customers as $customer): ?>
    <tr>
        <td><?= esc($customer['full_name']) ?></td>
        <td><?= esc($customer['email']) ?></td>
        <td><?= esc($customer['phone']) ?></td>
    </tr>
<?php endforeach ?>
```

`esc()` safely displays text in HTML. The account records now remain available after the web server restarts because they are stored in MySQL.
