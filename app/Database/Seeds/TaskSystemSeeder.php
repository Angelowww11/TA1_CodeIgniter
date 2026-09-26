<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TaskSystemSeeder extends Seeder
{
    public function run(): void
    {
        $now = date('Y-m-d H:i:s');

        $this->db->table('tasks')->insertBatch([
            ['title' => 'Review today\'s priorities', 'status' => 'completed', 'task_date' => date('Y-m-d'), 'created_at' => $now],
            ['title' => 'Finish the dashboard views', 'status' => 'in progress', 'task_date' => date('Y-m-d'), 'created_at' => $now],
            ['title' => 'Test the database filters', 'status' => 'pending', 'task_date' => date('Y-m-d'), 'created_at' => $now],
            ['title' => 'Update the project documentation', 'status' => 'pending', 'task_date' => date('Y-m-d'), 'created_at' => $now],
            ['title' => 'Create the database schema', 'status' => 'completed', 'task_date' => date('Y-m-d', strtotime('-1 day')), 'created_at' => $now],
            ['title' => 'Set up CodeIgniter routing', 'status' => 'completed', 'task_date' => date('Y-m-d', strtotime('-1 day')), 'created_at' => $now],
            ['title' => 'Prepare the GitHub submission', 'status' => 'pending', 'task_date' => date('Y-m-d', strtotime('+1 day')), 'created_at' => $now],
            ['title' => 'Deploy and verify the live website', 'status' => 'pending', 'task_date' => date('Y-m-d', strtotime('+2 days')), 'created_at' => $now],
        ]);

        $this->db->table('users')->insert([
            'username'   => 'angelowww11',
            'full_name'  => 'Angelo Kacey N. Pineda',
            'email'      => 'angelowww11@example.com',
            'created_at' => $now,
        ]);
    }
}
