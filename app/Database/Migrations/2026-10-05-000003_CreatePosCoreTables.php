<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePosCoreTables extends Migration
{
    public function up(): void
    {
        // The earlier assessments used a SQL export. Preserve those records when upgrading.
        $this->db->query("CREATE TABLE IF NOT EXISTS customer_accounts (
            customer_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
            first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE, phone VARCHAR(20) NOT NULL,
            address VARCHAR(255) NULL, account_status VARCHAR(20) NOT NULL DEFAULT 'Active',
            created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
        $this->db->query("CREATE TABLE IF NOT EXISTS user_accounts (
            user_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL UNIQUE, password_hash VARCHAR(255) NOT NULL,
            first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE, role VARCHAR(20) NOT NULL,
            account_status VARCHAR(20) NOT NULL DEFAULT 'Active', avatar VARCHAR(255) NULL,
            created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
        $this->db->query("CREATE TABLE IF NOT EXISTS products (
            id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL, sku VARCHAR(40) NOT NULL UNIQUE,
            price DECIMAL(10,2) NOT NULL, stock_quantity INT UNSIGNED NOT NULL DEFAULT 0,
            image VARCHAR(255) NULL, is_archived TINYINT(1) NOT NULL DEFAULT 0,
            created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
        $this->db->query("CREATE TABLE IF NOT EXISTS sales (
            id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
            product_id INT UNSIGNED NOT NULL, customer_id INT UNSIGNED NULL,
            sold_by INT UNSIGNED NOT NULL, quantity INT UNSIGNED NOT NULL,
            unit_price DECIMAL(10,2) NOT NULL, total_price DECIMAL(10,2) NOT NULL,
            created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            INDEX idx_sales_date (created_at),
            CONSTRAINT fk_sales_product FOREIGN KEY (product_id) REFERENCES products(id),
            CONSTRAINT fk_sales_customer FOREIGN KEY (customer_id) REFERENCES customer_accounts(customer_id),
            CONSTRAINT fk_sales_staff FOREIGN KEY (sold_by) REFERENCES user_accounts(user_id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
    }

    public function down(): void
    {
        $this->db->query('DROP TABLE IF EXISTS sales');
        $this->db->query('DROP TABLE IF EXISTS products');
    }
}
