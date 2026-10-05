<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DemoUserPasswordSeeder extends Seeder
{
    public function run()
    {
        // Upgrade only the five TFA2/TFA3 sample placeholders, preserving real passwords.
        foreach ($this->db->table('user_accounts')->get()->getResultArray() as $user) {
            if (preg_match('/^hashed_password_[1-5]$/', $user['password_hash']) === 1) {
                $this->db->table('user_accounts')->where('user_id', $user['user_id'])->update([
                    'password_hash' => password_hash('SimplePOS!2026', PASSWORD_DEFAULT),
                ]);
            }
        }
    }
}
