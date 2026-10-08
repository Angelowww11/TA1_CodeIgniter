<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class HostedAdminSeeder extends Seeder
{
    public function run(): void
    {
        $password = (string) getenv('POS_ADMIN_PASSWORD');
        if (strlen($password) < 12) {
            throw new \RuntimeException('Set POS_ADMIN_PASSWORD to at least 12 characters before initializing the hosted app.');
        }
        $existing = $this->db->table('user_accounts')->where('username', 'admin01')->get()->getRowArray();
        if ($existing !== null) {
            if (getenv('POS_ADMIN_PASSWORD_ROTATE') === 'true') {
                $this->db->table('user_accounts')->where('username', 'admin01')->update([
                    'password_hash' => password_hash($password, PASSWORD_DEFAULT),
                ]);
            }
            return;
        }
        if ($this->db->table('user_accounts')->countAllResults() > 0) return;
        $this->db->table('user_accounts')->insert([
            'username' => 'admin01',
            'password_hash' => password_hash($password, PASSWORD_DEFAULT),
            'first_name' => 'Store', 'last_name' => 'Admin',
            'email' => 'admin@example.invalid', 'role' => 'Admin', 'account_status' => 'Active',
        ]);
    }
}
