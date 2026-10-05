<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class HostedAdminSeeder extends Seeder
{
    public function run(): void
    {
        if ($this->db->table('user_accounts')->countAllResults() > 0) return;
        $password = (string) getenv('POS_ADMIN_PASSWORD');
        if (strlen($password) < 12) {
            throw new \RuntimeException('Set POS_ADMIN_PASSWORD to at least 12 characters before initializing the hosted app.');
        }
        $this->db->table('user_accounts')->insert([
            'username' => 'admin01',
            'password_hash' => password_hash($password, PASSWORD_DEFAULT),
            'first_name' => 'Store', 'last_name' => 'Admin',
            'email' => 'admin@example.invalid', 'role' => 'Admin', 'account_status' => 'Active',
        ]);
    }
}
