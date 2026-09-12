# SimplePOS CodeIgniter Foundations

This is a beginner-friendly four-page CodeIgniter 4 project for IT0049 TFA1. It uses routes, controllers, views, and static PHP arrays. A database is not used yet.

## Requirements

- PHP 8.2 or newer
- Composer

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
3. `Customers.php` and `Users.php` each create an array containing five sample records.
4. The customer and user views receive those arrays and use `foreach` to create the table rows.
5. The reusable header and footer partials keep the navigation and page structure consistent.

Example route:

```php
$routes->get('/customers', 'Customers::index');
```

Example controller-to-view data flow:

```php
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

`esc()` safely displays text in HTML. The sample records are temporary; they can be replaced with database results in a later activity.
