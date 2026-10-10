<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TaskDemoPasswordSeeder extends Seeder
{
    public function run(): void
    {
        $password = getenv('TASK_DEMO_PASSWORD');
        if (! is_string($password) || strlen($password) < 8) {
            throw new \RuntimeException('Set TASK_DEMO_PASSWORD to at least eight characters before seeding.');
        }
        $this->db->table('users')->where('username', 'angelowww11')->update([
            'password_hash' => password_hash($password, PASSWORD_DEFAULT),
        ]);
    }
}
